<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use App\NonAcademic;
use App\Country;
use App\State;
use App\Category;

class NonAcademicController extends Controller
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
        $nonAcademicStaffs = NonAcademic::select('id', 'firstname', 'lastname', 'email', 'employee_number', 'date_joined')
        ->orderBy('date_joined', 'DESC')->get();

        $data = compact('nonAcademicStaffs');

        return view('nonacademics.nonacademics-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states = State::select('StateID', 'StateName')->get();

        $countries = Country::select('CountryID', 'CountryName')->get();

        $categories = Category::select('id', 'category_name', 'category_description')->get();

        $data = compact('states', 'countries', 'categories');

        return view('nonacademics.nonacademics-register', $data);
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

        //INSERT INTO `non_academic_staffs` table
        $nonAcademicStaff = NonAcademic::create([

            'country_id'                =>   $request->input('country_id'),
            'states_id'                 =>   $request->input('states_id'),
            'category_id'               =>   $request->input('category_id'),
            'employee_number'           =>   $request->input('employee_number'),
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

        //If successfully created go to Non Academic Staff list page
        if($nonAcademicStaff){
            return redirect()->route('nonacademics.index')->with('success', $request->input('firstname').' '.$request->input('lastname').'\'s profile has been created!');
        }

        //If errors occur, return back to  Non Academic Staff registration page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'firstname'                 =>   'required',
            'lastname'                  =>   'required',
            'category_id'               =>   'required',
            'country_id'                =>   'required',
            'states_id'                 =>   'required',
            'employee_number'           =>   'required|Numeric|unique:non_academic_staffs,employee_number',
            'email'                     =>   'email|unique:non_academic_staffs,email', 
            'gender'                    =>   'required',
            'marital_status'            =>   'required',
            'dob'                       =>   'required',
            'date_joined'               =>   'required', 
            'phone_no'                  =>   'required|unique:non_academic_staffs,phone_no',
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
        $nonAcademicStaffExists = NonAcademic::findOrFail($id);

        $nonAcademicStaff = NonAcademic::where('id', $id)->first();

        $paymentLists = DB::table('staff_payments')
        ->join('non_academic_staffs', 'non_academic_staffs.id', '=', 'staff_payments.non_academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'staff_payments.created_at')->where('non_academic_staffs.id', $id)
        ->orderBy('staff_payments.created_at', 'DESC')->get();

        $data = compact('nonAcademicStaff', 'paymentLists');

        return view('nonacademics.nonacademics-show', $data)->with('i');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $nonAcademicStaffExists = NonAcademic::findOrFail($id);

        $nonacademic = NonAcademic::where('id', $id)->first();

        $countries = Country::select('CountryID', 'CountryName')->get();

        $states = State::select('StateID', 'StateName')->get();

        $categories = Category::select('id', 'category_name', 'category_description')->get();

        $data = compact('nonacademic', 'states', 'countries', 'categories');

        return view('nonacademics.nonacademics-edit', $data);
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
            'category_id'               =>   'required',
            'firstname'                 =>   'required',
            'lastname'                  =>   'required', 
            'phone_no'                  =>   'required|Numeric|unique:non_academic_staffs,phone_no,'.$id.',id',
            'gender'                    =>   'required',
            'marital_status'            =>   'required',
            'dob'                       =>   'required',
            'date_joined'               =>   'required',
            'email'                     =>   'email|unique:non_academic_staffs,email,'.$id.',id',
            'address'                   =>   'required',
        ]);


        //UPDATE `non_academic_staffs` table
        $nonAcademicStaffUpdate = NonAcademic::where('id', $id)->update([
            'country_id'                =>   $request->input('country_id'),
            'states_id'                 =>   $request->input('states_id'),
            'employee_number'           =>   $request->input('employee_number'),
            'category_id'               =>   $request->input('category_id'),
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

        if($nonAcademicStaffUpdate){

            return redirect()->route('nonacademics.index')->with('success', 'Updated '.$request->input('firstname').' '.$request->input('lastname').' profile');
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
        $nonAcademicStaffExists = NonAcademic::findOrFail($id);

        $deleteNonAcademicStaff = NonAcademic::where('id', $id)->delete();

        if($deleteNonAcademicStaff){
            return back()->with('success', 'Profile has been deleted.');
        }
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }
}
