<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\Academic;
use App\College;
use App\Department;
use App\Course;
use App\Country;
use App\State;

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
        $academicStaffs = Academic::select('id', 'firstname', 'lastname', 'email', 'employee_number', 'date_joined')
        ->orderBy('date_joined', 'DESC')->get();

        $data = compact('academicStaffs');

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

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $departments = Department::select('id', 'department_name', 'department_description')->get();

        $data = compact('states', 'courses', 'countries', 'colleges', 'departments');

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
        //Validate user inputs
        $this->validateRequest();
        
        //Begin database transaction
        DB::beginTransaction();

        // if($request->has($request->input('courses_id')))
        // {
            $courses_id = implode(',', $request->input('courses_id'));

        // }else{
        //     $courses_id = '';
        // }

        //INSERT INTO `academic_staffs` table
        $academic = Academic::create([

            'country_id'                =>   $request->input('country_id'),
            'states_id'                 =>   $request->input('states_id'),
            'employee_number'           =>   $request->input('employee_number'),
            'courses_id'                =>   $courses_id,
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'email'                     =>   $request->input('email'),
            'gender'                    =>   $request->input('gender'),
            'marital_status'            =>   $request->input('marital_status'),
            'dob'                       =>   $request->input('dob'),
            'date_joined'               =>   $request->input('date_joined'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),   
            'created_by'                =>   $this->loggedUserID(),

        ]);

        //Role back transaction if something went wrong
        DB::commit();

        //If successfully created go to Non Academic Staff list page
        if($academic){
            return redirect()->route('academics.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
        }

        //If errors occur, return back to  Non Academic Staff registration page
        return back()->withInput();
    }

      /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'firstname'                 =>   'required',
            'lastname'                  =>   'required',
            'country_id'                =>   'required',
            'states_id'                 =>   'required',
            'employee_number'           =>   'required|Numeric|unique:academic_staffs,employee_number',
            'courses_id'                =>   'required',
            'email'                     =>   'required|email|unique:academic_staffs,email', 
            'gender'                    =>   'required',
            'marital_status'            =>   'required',
            'dob'                       =>   'required',
            'date_joined'               =>   'required', 
            'phone_no'                  =>   'required|unique:academic_staffs,phone_no',
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
        $academicStaffExists = Academic::findOrFail($id);

        $academicStaff = Academic::where('id', $id)->first();

        //Explode tag user Agency list
        $coursesArray = array_map('intval', explode(',', trim($academicStaff->courses_id)));

        //Get tag names from `tags` table
        $courses = Course::select('course_name', 'course_code')
        ->where(function($courses) use($coursesArray) {
            foreach($coursesArray as $item) {
                $courses->orWhere('id', 'like', "%$item%");
            };
        })->get();

        $academicPaymentLists = DB::table('staff_payments')
        ->join('academic_staffs', 'academic_staffs.id', '=', 'staff_payments.academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'staff_payments.created_at')->where('staff_payments.id', $id)
        ->orderBy('staff_payments.created_at', 'DESC')->get();


        $data = compact('academicStaff', 'courses', 'academicPaymentLists');

        return view('academics.academics-show', $data)->with('i');
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $academicStaffExists = Academic::findOrFail($id);

        $academicStaff = Academic::where('id', $id)->first();

        $states = State::select('StateID', 'StateName')->get();

        $courses = Course::select('id', 'colleges_id', 'departments_id', 'course_name', 'course_description')
        ->orderBy('course_name', 'ASC')->get();

        $countries = Country::select('CountryID', 'CountryName')->get();

        //Explode tag user Agency list
        $coursesArray = array_map('intval', explode(',', trim($academicStaff->courses_id)));

        $data = compact('academicStaff', 'coursesArray', 'courses', 'states', 'countries');

        return view('academics.academics-edit', $data);
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
        //Validate request
        request()->validate([
            'country_id'                =>   'required',
            'states_id'                 =>   'required',
            'employee_number'           =>   'required',
            'courses_id'                =>   'required',
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:academic_staffs,phone_no,'.$id.',id',
            'gender'                    =>   'required',
            'marital_status'            =>   'required',
            'dob'                       =>   'required',
            'date_joined'               =>   'required',
            'email'                     =>   'required|email|unique:academic_staffs,email,'.$id.',id',
            'address'                   =>   'required',
        ]);

        $courses_id = implode(',', $request->input('courses_id'));

        //UPDATE `academic_staffs` table
        $academicStaffUpdate = Academic::where('id', $id)->update([
            'country_id'                =>   $request->input('country_id'),
            'states_id'                 =>   $request->input('states_id'),
            'employee_number'           =>   $request->input('employee_number'),
            'courses_id'                =>   $courses_id,
            'firstname'                 =>   $request->input('firstname'),
            'lastname'                  =>   $request->input('lastname'),
            'email'                     =>   $request->input('email'),
            'gender'                    =>   $request->input('gender'),
            'marital_status'            =>   $request->input('marital_status'),
            'dob'                       =>   $request->input('dob'),
            'date_joined'               =>   $request->input('date_joined'),
            'phone_no'                  =>   $request->input('phone_no'),
            'address'                   =>   $request->input('address'),   
            'updated_by'                =>   $this->loggedUserID(),
        ]);

        if($academicStaffUpdate){

            return redirect()->route('academics.index')->with('success', 'Updated '.$request->input('firstname').' '.$request->input('lastname').' profile');
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
        $academicStaffExists = Academic::findOrFail($id);

        $deleteAcademicStaff = Academic::where('id', $id)->delete();

        if($deleteAcademicStaff){
            return back()->with('success', 'Profile has been deleted.');
        }
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }
}
