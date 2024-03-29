<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use Auth;
use App\User;
use App\SuperAdmin;

class ViewsOnlyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'user_role'        =>   '1',
            'created_by'       =>   '1'
        ]);

        //INSERT INTO `super_admin_infos` tabble
        $superAdminInfos = SuperAdmin::create([
            'users_id'                  =>   $users->id,
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),
            'profile_avatar'            =>   $avatarName,            
        ]);

        //Role back transaction if something went wrong
        DB::commit();

        //If successfully created go to login page
        if($users AND $superAdminInfos){
            return redirect('/login')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
        }

        //If errors occur, return back to super admin registration page
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
            'email'                     =>   'required|email|unique:users,email', 
            'password'                  =>   'required',
            'password_confirmation'     =>   'required|same:password', 
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showLoginForm(){
        return view('template-login');
    }
}
