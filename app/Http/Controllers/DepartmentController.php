<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\College;

class DepartmentController extends Controller
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
        $departments = Department::orderBy('department_name', 'ASC')->get();

        $data = compact('departments');

        return view('departments.department-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $data = compact('colleges');

        return view('departments.department-create', $data);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validateRequest();

        //INSERT INTO `users` table
        $createDepartment = Department::create([
            'colleges_id'                =>   $request->input('colleges_id'),
            'department_name'            =>   $request->input('department_name'),
            'department_description'     =>   $request->input('department_description'),
        ]);

        //If successfully created go to login page
        if($createDepartment){
            return redirect()->route('departments.index')->with('success', $request->input('department_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'colleges_id'                     =>   'required',
            'department_name'                 =>   'required|unique:departments,department_name',
            'department_description'          =>   'required', 
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
        $departmentExists = Department::findOrFail($id);

        $department = Department::select('id', 'colleges_id', 'department_name', 'department_description')->where('id', $id)->first();

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $data = compact('department', 'colleges');

        return view('departments.department-edit', $data);
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
        $updateDepartment = Department::where('id', $id)->update([
            'colleges_id'                    =>   $request->input('colleges_id'),
            'department_name'                =>   $request->input('department_name'),
            'department_description'         =>   $request->input('department_description'),
        ]);


        if( $updateDepartment){

            return redirect('/departments')->with('success', 'Updated '.$request->input('department_name').' details.');
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
        $departmentExists = Department::findOrFail($id);

        $deleteDepartment = Department::where('id', $id)->delete();

        if($deleteDepartment){
            return back()->with('success', 'Profile deleted.');
        }
    }
}
