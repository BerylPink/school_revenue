<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Auth\LoginController;
use App\User;
use App\Admin;
use App\College;

class AdminController extends Controller
{
    //Variable to hold user id in all methods
    var $userID;

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
        $admins = DB::table('users')
        ->join('admin_infos', 'admin_infos.users_id', '=', 'users.id')
        ->join('colleges', 'colleges.id', '=', 'admin_infos.college_id')
        ->select('users.id', 'email', 'firstname', 'lastname', 'college_name', 'users.created_at')
        ->orderBy('users.created_at', 'DESC')->get();

        $data = compact('admins');
        return view('admin.admin-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = DB::table('states')->get();

        $colleges = College::select('id', 'college_name', 'college_description')->orderBy('college_name', 'ASC')->get();

        $data = compact('states', 'colleges');

        return view('admin.admin-registration', $data);
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
            'user_role'        =>   '2',
            'created_by'       =>   $this->loggedUserID(),
        ]);

        //INSERT INTO `admin_infos` tabble
        $adminInfos = Admin::create([
            'users_id'                  =>   $users->id,
            'college_id'                =>   $request->input('college_id'),
            'state_id'                  =>   $request->input('state_id'),
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'gender'                    =>   $request->input('gender'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),
            'profile_avatar'            =>   $avatarName,            
        ]);

        //Role back transaction if something went wrong
        DB::commit();

        //If successfully created go to login page
        if($users AND $adminInfos){
            return redirect()->route('admins.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
        }

        //If errors occur, return back to  admin registration page
        return back()->withInput();
    }

    /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:super_admin_infos,phone_no',
            'gender'                    =>   'required',
            'email'                     =>   'required|email|unique:users,email', 
            'password'                  =>   'required',
            'confirm_password'          =>   'required|same:password', 
            'college_id'                =>   'required',
            'state_id'                  =>   'required',
            'profile_avatar'            =>   'image|mimes:jpeg,png,jpg,gif|max:2048',
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

        if($userRole->user_role === 2){

            $admin = DB::table('users')
            ->join('admin_infos', 'admin_infos.users_id', '=', 'users.id')
            ->join('colleges', 'colleges.id', '=', 'admin_infos.college_id')
            ->join('states', 'states.StateID', '=', 'admin_infos.state_id')
            ->select('users.id', 'email', 'firstname', 'lastname', 'college_name', 'college_id', 'state_id', 'StateName', 'gender', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
            ->where('users.id', $id)->first();

            $data = compact('admin');
            // return response()->json($data);

            return view('admin.admin-show', $data);
        }else{
            return back()->with('error', 'This User is not an Admin');
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

        $admin = DB::table('users')
        ->join('admin_infos', 'admin_infos.users_id', '=', 'users.id')
        ->join('colleges', 'colleges.id', '=', 'admin_infos.college_id')
        ->join('states', 'states.StateID', '=', 'admin_infos.state_id')
        ->select('users.id', 'email', 'firstname', 'lastname', 'college_name', 'college_id', 'state_id', 'StateName', 'gender', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
        ->where('users.id', $id)->first();

        $states = DB::table('states')->get();

        $colleges = College::select('id', 'college_name', 'college_description')->orderBy('college_name', 'ASC')->get();

        $data = compact('admin', 'states', 'colleges');

        return view('admin.admin-edit', $data);
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
        $adminInfos = Admin::where('users_id', $id)->update([
            'college_id'                =>   $request->input('college_id'),
            'state_id'                  =>   $request->input('state_id'),
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'gender'                    =>   $request->input('gender'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),
            'profile_avatar'            =>   $avatarName,            
        ]);

       

        if($users AND $adminInfos){

            return redirect('/admins')->with('success', 'Updated '.$fullname.' profile.');
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

        $deleteImage = Admin::select('profile_avatar')->where('users_id', $id)->first();

        $deleteFromAdmin = Admin::where('users_id', $id)->delete();

        $deleteFromUser = User::where('id', $id)->delete();

        if($deleteFromUser AND $deleteFromAdmin){
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
