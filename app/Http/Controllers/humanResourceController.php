<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\User;
use App\HumanResource;

class HumanResourceController extends Controller
{
    /**
     * This method will redirect users back to the login page if not properly authenticated
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:web');
     }
     
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hrs = DB::table('users')
        ->join('human_resource_infos', 'human_resource_infos.users_id', '=', 'users.id')
        ->join('states', 'states.StateID', '=', 'human_resource_infos.states_id')
        ->select('users.id', 'email', 'firstname', 'lastname', 'StateName',  'users.created_at')
        ->orderBy('users.created_at', 'DESC')->get();

        $data = compact('hrs');

        return view('humanresource.hr-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = DB::table('states')->get();

        $data = compact('states');

        return view('humanresource.hr-registration', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validate request
        $this->validateRequest();

        //Validate if an image filewas selected 
        if($request->hasFile('profile_avatar')){
            $image = $request->file('profile_avatar');
            $avatarName = rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $avatarName);
        } else{
            //If image wasn't selected, set a default image for profile avatar
            $avatarName = 'default_avatar.png';
        }
        
        //Begin database transaction
        DB::beginTransaction();

        //INSERT INTO `users` table
        $users = User::create([
            'email'            =>   $request->input('email'),
            'password'         =>   Hash::make($request->input('password')),
            'user_role'        =>   '3',
            'created_by'       =>   $this->loggedUserID(),
        ]);

        //INSERT INTO `human_resource_infos` tabble
        $humanresourceInfos = HumanResource::create([
            'users_id'                  =>   $users->id,
            'states_id'                 =>   $request->input('state_id'),
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'phone_no'                  =>   $request->input('phone_no'),
            'gender'                    =>   $request->input('gender'),
            'address'                   =>   $request->input('address'),
            'profile_avatar'            =>   $avatarName,            
        ]);

        //Role back transaction if something went wrong
        DB::commit();

        //If successfully created go to login page
        if($users AND $humanresourceInfos){
            return redirect()->route('human-resource.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
        }

        //If errors occur, return back to human resources registration page
        return back()->withInput();
    }

    /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:human_resource_infos,phone_no',
            'gender'                    =>   'required',
            'email'                     =>   'required|email|unique:users,email', 
            'password'                  =>   'required',
            'confirm_password'          =>   'required|same:password', 
            'state_id'                  =>   'required',
            'avatar'                    =>   'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'                   =>   'required',
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userExists = User::findOrFail($id);

        $userRole = User::select('user_role')->where('id', $id)->first();

        if($userRole->user_role === 3){

            $hr = DB::table('users')
            ->join('human_resource_infos', 'human_resource_infos.users_id', '=', 'users.id')
            ->join('states', 'states.StateID', '=', 'human_resource_infos.states_id')
            ->select('users.id', 'email', 'firstname', 'lastname', 'StateName', 'gender', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
            ->where('users.id', $id)->first();

            $data = compact('hr');
            // return response()->json($data);
            
            return view('humanresource.hr-show', $data);
        }else{
            return back()->with('error', 'This User is not a Human Resources personnel');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userExists = User::findOrFail($id);

        $hr = DB::table('users')
        ->join('human_resource_infos', 'human_resource_infos.users_id', '=', 'users.id')
        ->join('states', 'states.StateID', '=', 'human_resource_infos.states_id')
        ->select('users.id', 'email', 'firstname', 'lastname', 'states_id', 'StateID', 'StateName', 'gender', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
        ->where('users.id', $id)->first();

        $states = DB::table('states')->get();

        $data = compact('hr', 'states');

        return view('humanresource.hr-edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //Validate if an image filewas selected 
        if($request->hasFile('profile_avatar')){
            $image = $request->file('profile_avatar');
            $avatarName = rand() .'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $avatarName);
        } else{
            //If image wasn't selected, set a default image for profile avatar
            $avatarName = $request->input('old_profile_avatar');
        }

        $fullname = $request->input('firstname').' '.$request->input('lastname');

       //UPDATE `users` table
       $users = User::where('id', $id)->update([
           'email'            =>   $request->input('email'),
       ]);

       //UPDATE `admin_infos` tabble
       $hrInfos = HumanResource::where('users_id', $id)->update([
           'states_id'                 =>   $request->input('state_id'),
           'firstname'                 =>   $request->input('firstname'),
           'lastname'                  =>   $request->input('lastname'),
           'gender'                    =>   $request->input('gender'),
           'phone_no'                  =>   $request->input('phone_no'),
           'address'                   =>   $request->input('address'),
           'profile_avatar'            =>   $avatarName,            
       ]);

      

       if($users AND $hrInfos){

           return redirect('/human-resource')->with('success', 'Updated '.$fullname.' profile.');
       }
           
       return back()->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $userExists = User::findOrFail($id);

        $deleteImage = HumanResource::select('profile_avatar')->where('users_id', $id)->first();

        $deleteFromHr = HumanResource::where('users_id', $id)->delete();

        $deleteFromUser = User::where('id', $id)->delete();

        if($deleteFromUser AND $deleteFromHr){
            if(\File::exists(public_path('uploads/'.$deleteImage->profile_avatar))){

                $deleted =  \File::delete(public_path('uploads/'.$deleteImage->profile_avatar));

                if($deleted){
                    return back()->with('success', 'Profile deleted.');
                }
            }else{
                return back()->with('success', 'Profile deleted.');

            }
        }
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }
    
}
