<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Academics;
use App\College;
use App\Department;
use App\Courses;

class AcademicController extends Controller
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
        $academics = Academics::orderBy('department_name', 'ASC')->get();

        $data = compact('academics');

        return view('academics.academics-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $country = DB::table('country')->get();

        $states = DB::table('states')->get();

        $colleges = College::select('id', 'college_name', 'college_description')->orderBy('college_name', 'ASC')->get();

        $departments = Department::select('id', 'department_name', 'department_description')->orderBy('department_name', 'ASC')->get();

        $courses = Course::select('id', 'course_name', 'course_description')->orderBy('course_name', 'ASC')->get();


        $data = compact('country', 'states', 'colleges', 'departments', 'courses',);

        return view('academic.academic-registration', $data);
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
        
        //Begin database transaction
        DB::beginTransaction();

        //INSERT INTO `academic_staffs` tabble
        $academic = Academic::create([
            'college_id'                =>   $request->input('college_id'),
            'departments_id'            =>   $request->input('department_id'),
            'courses_id'                =>   $request->input('course_id'),
            'country_id'                =>   $request->input('country_id'),
            'state_id'                  =>   $request->input('state_id'),
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'email'                     =>   $request->input('email'),
            'employee_no'               =>   $request->input('employee_no'),
            'gender'                    =>   $request->input('gender'),
            'marital_status'            =>   $request->input('marital_status'),
            'DOB     '                  =>   $request->input('DOB'),
            'date_joined'               =>   $request->input('date_joined'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),          
        ]);

        //Role back transaction if something went wrong
        DB::commit();

        //If successfully created go to login page
        if($academic){
            return redirect()->route('academics.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
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
            'employee_no'               =>   'required',
            'marital_status'            =>   'required',
            'DOB     '                  =>   'required',
            'date_joined'               =>   'required',
            'college_id'                =>   'required',
            'departments_id'            =>   'required',
            'courses_id'                =>   'required',
            'country_id'                =>   'required',
            'state_id'                  =>   'required',
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
}
