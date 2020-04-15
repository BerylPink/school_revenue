<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserRoleController extends Controller
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
        $userRoles = UserRole::orderBy('userRole_name', 'ASC')->get();

        $data = compact('userRoles');

        return view('userRoles.userRole-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userRoles.userRole-create');
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

        //INSERT INTO `users` table
        $createUserRole = UserRole::create([
            'userRole_name'            =>   $request->input('userRole_name'),
            'userRole_description'     =>   $request->input('userRole_description'),
        ]);

        //If successfully created go to login page
        if($createUserRole){
            return redirect()->route('userRoles.index')->with('success', $request->input('userRole_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'userRole_name'                 =>   'required|unique:userRoles,userRole_name',
            'userRole_description'          =>   'required', 
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
        $userRoleExists = UserRole::findOrFail($id);

        $userRole = UserRole::select('id', 'userRole_name', 'userRole_description')->where('id', $id)->first();

        $data = compact('userRole');

        return view('userRoles.userRole-edit', $data);
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
         //UPDATE `userRoles` tabble
         $updateUserRole = UserRole::where('id', $id)->update([
            'userRole_name'                =>   $request->input('userRole_name'),
            'userRole_description'         =>   $request->input('userRole_description'),
        ]);


        if( $updateUserRole){

            return redirect('/userRoles')->with('success', 'Updated '.$request->input('userRole_name').' details.');
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
        $userRoleExists = UserRole::findOrFail($id);

        $deleteUserRole = UserRole::where('id', $id)->delete();

        if($deleteUserRole){
            return back()->with('success', 'Role deleted.');
        }
    }
}
