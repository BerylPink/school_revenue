<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Academic;
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
        $academicStaffs = Academic::select('id', 'firstname', 'lastname', 'email', 'employee_number')->get();

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

        $states = State::select('StateID', 'StateName')->get();

        $courses = Course::select('id', 'colleges_id', 'departments_id', 'course_name', 'course_description')
        ->orderBy('course_name', 'ASC')->get();

        $countries = Country::select('CountryID', 'CountryName')->get();

        $data = compact('states', 'courses', 'countries');

        return view('academics.academics-registration', $data);
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

            'country_id'                =>   $request->input('country_id'),
            'state_id'                  =>   $request->input('state_id'),
            'employee_no'               =>   $request->input('employee_number'),
            'courses_id'                =>   $request->input('course_id'),
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'email'                     =>   $request->input('email'),
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
            'country_id'                =>   'required',
            'state_id'                  =>   'required',
            'employee_no'               =>   'required',
            'courses_id'                =>   'required',
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'email'                     =>   'required|email|unique:users,email', 
            'gender'                    =>   'required',
            'marital_status'            =>   'required',
            'DOB     '                  =>   'required',
            'date_joined'               =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:super_admin_infos,phone_no',
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
        $academicStaffs = Academic::select('id', 'firstname', 'lastname', 'email', 'employee_number')->get();

        $data = compact('academic_staffs');

        return view('academics.academics-list', $data)->with('i');
        
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
