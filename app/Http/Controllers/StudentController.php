<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Auth\LoginController;

use DB;
use App\Student;
use App\College;
use App\Department;
use App\Country;
use App\State;
use App\User;

class StudentController extends Controller
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
        // $students = Student::select('firstname', 'lastname', 'registration_date')
        // ->orderBy('registration_date', 'DESC')->get();

        $students = DB::table('users')
        ->join('students', 'students.users_id', '=', 'users.id')
        ->join('colleges', 'colleges.id', '=', 'students.colleges_id')
        ->join('departments', 'departments.id', '=', 'students.departments_id')
        ->select('users.id', 'firstname', 'lastname', 'registration_number', 'college_name', 'department_name', 'registration_date')
        ->orderBy('registration_date', 'DESC')->get();

        $data = compact('students');

        return view('students.student-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $states = State::select('StateID', 'StateName')->get();

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $countries = Country::select('CountryID', 'CountryName')->get();

        $data = compact('states', 'colleges', 'countries');

        return view('students.student-registration', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // return response()->json($request->all());

        //Begin database transaction
        // DB::beginTransaction();

        // try{

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

            //INSERT INTO `users` table
            $users = User::create([
                'email'            =>   $request->input('email'),
                'password'         =>   Hash::make($request->input('password')),
                'user_role'        =>   '4', //Student Role
                'created_by'       =>   $this->loggedUserID(),
            ]);

            //INSERT INTO `students` tabble
            $studentInfos = Student::create([
                'users_id'                  =>   $users->id,
                'countries_id'              =>   $request->input('countries_id'),
                'states_id'                 =>   $request->input('states_id'),
                'colleges_id'               =>   $request->input('colleges_id'),
                'departments_id'            =>   $request->input('departments_id'),
                'registration_number'       =>   $request->input('registration_number'),
                'firstname'                 =>   $request->input('firstname'),
                'lastname'                  =>   $request->input('lastname'),
                'gender'                    =>   $request->input('gender'),
                'dob'                       =>   $request->input('dob'),
                'phone_no'                  =>   $request->input('phone_no'),
                'address'                   =>   $request->input('address'),
                'profile_avatar'            =>   $avatarName,           
                'registration_date'         =>   $request->input('registration_date'),
            ]);

            //If successfully created go to login page
            if($users AND $studentInfos){
                return redirect()->route('students.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
            }

        //If errors occur, return back to  student registration page
        // }catch(\Exception $e){
        //     // Return some other error, or rethrow as above
        //     DB::rollback();
        //     return back()->withInput()->with('error', 'Make sure all required fields are not empty.');
        //     // return $e->getMessage();

        // }
        
        // //Commit transaction if error count is 0
        // DB::commit();

    }

    /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'countries_id'              =>   'required',
            'states_id'                 =>   'required',
            'colleges_id'               =>   'required',
            'departments_id'            =>   'required',
            'registration_number'       =>   'required',
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:students,phone_no',
            'gender'                    =>   'required',
            'email'                     =>   'required|email|unique:users,email', 
            'password'                  =>   'required',
            'confirm_password'          =>   'required|same:password', 
            'profile_avatar'            =>   'image|mimes:jpeg,png,jpg,gif|max:2048',
            'address'                   =>   'required',
            'updated_by'                =>   '',
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

        if($userRole->user_role === 4){

            $student = DB::table('users')
            ->join('students', 'students.users_id', '=', 'users.id')
            ->join('colleges', 'colleges.id', '=', 'students.colleges_id')
            ->join('departments', 'departments.id', '=', 'students.departments_id')
            ->join('countries', 'countries.CountryID', '=', 'students.countries_id')
            ->join('states', 'states.StateID', '=', 'students.states_id')
            ->select('users.id', 'email', 'firstname', 'lastname', 'college_name', 'department_name', 'StateName', 'gender', 'phone_no', 'address', 'profile_avatar', 'registration_date')
            ->where('users.id', $id)->first();

            $data = compact('student');
            // return response()->json($data);

            return view('students.student-show', $data);

        }else{
            return back()->with('error', 'This User is not a Student');
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

        $student = DB::table('users')
        ->join('students', 'students.users_id', '=', 'users.id')
        ->join('colleges', 'colleges.id', '=', 'students.colleges_id')
        ->join('departments', 'departments.id', '=', 'students.departments_id')
        ->join('states', 'states.StateID', '=', 'students.state_id')
        ->select('users.id', 'email', 'firstname', 'lastname', 'college_name', 'colleges_id', 'state_id', 'StateName', 'departments_id', 'department_name', 'gender', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
        ->where('users.id', $id)->first();

        $states = State::select('StateID', 'StateName')->get();

        $colleges = College::select('id', 'college_name', 'college_description')
        ->orderBy('college_name', 'ASC')->get();

        $countries = Country::select('CountryID', 'CountryName')->get();

        $data = compact('student', 'states', 'colleges', 'countries');

        return view('students.student-edit', $data);
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

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     *
     * This is an ajax call for which give you all the departments in a college
     * present in the selected department
     */
    public function getDepartmentsFromCollege(Request $request){
        if($request->ajax()){
            $college = $request->get('college_id');

            $departments = Department::select('id', 'department_name', 'department_description')
            ->where('id', $college)->get();

            // return response()->json($departments);

            $collegeDepartment = '';
            foreach ($departments as $department ){
                $collegeDepartment .= "
                    <option value='$department->id' title='$department->department_description'>$department->department_name</option>
                    ";
            }

            $data = array(
                'collegeDepartment' => $collegeDepartment
            );

        }

        return response()->json($data);
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }
}
