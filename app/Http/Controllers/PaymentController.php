<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use DB;
use App\StudentPaymentHistory;
use App\PaymentGateway;
use App\PaymentCategory;
use App\Academic;
use App\NonAcademic;
use App\StaffPayment;

class PaymentController extends Controller
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $paymentGateways = PaymentGateway::select('id', 'payment_gateway_name')
        ->orderBy('payment_gateway_name', 'ASC')->get();

        $paymentCategories = PaymentCategory::orderBy('payment_category_name', 'ASC')->get();

        $academicStaffs = Academic::select('id', 'firstname', 'lastname', 'employee_number', 'date_joined')
        ->orderBy('firstname', 'ASC')->get();

        $nonAcademicStaffs = NonAcademic::select('id', 'firstname', 'lastname','employee_number')
        ->orderBy('firstname', 'ASC')->get();

        $data = compact('paymentGateways', 'paymentCategories', 'academicStaffs', 'nonAcademicStaffs');

        return view('payments.payment-create', $data);
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

        $makePayment = StaffPayment::create([
            'staff_category'                   =>   $request->input('staff_category'),
            'academic_staff_id'                =>   $request->input('academic_staff_id'),
            'non_academic_staff_id'            =>   $request->input('non_academic_staff_id'),
            'payment_category'                 =>   $request->input('payment_category'),
            'payment_gateway'                  =>   $request->input('payment_gateway'),
            'amount'                           =>   $request->input('amount'),
            'created_by'                       =>   $this->loggedUserID(),
        ]);
        
        if($makePayment){
            return back()->with('success', 'Payment has been made.');
        }
        
        return back()->withInput();

    }

    private function validateRequest(){
        return request()->validate([
            'staff_category'                    =>   'required',
            'academic_staff_id'                 =>   '', 
            'non_academic_staff_id'             =>   '', 
            'payment_category'                  =>   'required',
            'payment_gateway'                   =>   'required',
            'amount'                            =>   'required',
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

    public function studentMakePayment(Request $request){

        //Validate request
        $this->validateStudentPaymentRequest();

        //INSERT INTO `users` table
        $makePayment = StudentPaymentHistory::create([
            'user_id'             =>   $this->loggedUserID(),
            'fee_type'            =>   $request->input('fee_type'),
            'fee_category'        =>   $request->input('fee_category'),
            'payment_gateway'     =>   $request->input('payment_gateway'),
            'amount_paid'         =>   $request->get('amount_paid'),
        ]);

        //If successfully created go to payment history page
        if($makePayment){
            return redirect()->route('students.payment_history')->with('success', 'Payment was successful!');
        }
    }

     /**
     * Validate user input fields
     */
    private function validateStudentPaymentRequest(){
        return request()->validate([
            'fee_type'          =>   'required',
            'fee_category'      =>   'required',
            'payment_gateway'   =>   'required',
            'amount_paid'       =>   'required',
        ]);
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }

    public function fullName($id){
        $this->userFullName = new LoginController();

        return $this->userFullName->getFullName($id);
    }

    public function academicStaffPaymentsList(){
        $academicPaymentLists = DB::table('staff_payments')
        ->join('academic_staffs', 'academic_staffs.id', '=', 'staff_payments.academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'staff_payments.created_at')
        ->orderBy('staff_payments.created_at', 'DESC')->get();

        $data = compact('academicPaymentLists');

        return view('payments.payment-academic-list', $data)->with('i');
    }

    public function academicStaffPaymentShow($id){

        $academicPayment = DB::table('staff_payments')
        ->join('academic_staffs', 'academic_staffs.id', '=', 'staff_payments.academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->join('payment_gateways', 'payment_gateways.id', '=', 'staff_payments.payment_gateway')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'payment_gateway_name', 'staff_payments.created_by', 'staff_payments.created_at', 'staff_payments.updated_by', 'staff_payments.updated_at')
        ->where('staff_payments.id', $id)
        ->orderBy('staff_payments.created_at', 'DESC')->first();

        $createdBy = $this->fullName($academicPayment->created_by);

        $updatedBy = $this->fullName($academicPayment->updated_by);

        $data = compact('academicPayment', 'createdBy', 'updatedBy');

        return view('payments.payment-academic-show', $data)->with('i');
    }


    public function nonAcademicStaffPaymentsList(){
        $paymentLists = DB::table('staff_payments')
        ->join('non_academic_staffs', 'non_academic_staffs.id', '=', 'staff_payments.non_academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'staff_payments.created_at')
        ->orderBy('staff_payments.created_at', 'DESC')->get();

        $data = compact('paymentLists');

        return view('payments.payment-non-academic-list', $data)->with('i');
    }

    public function nonAcademicStaffPaymentShow($id){

        $academicPayment = DB::table('staff_payments')
        ->join('non_academic_staffs', 'non_academic_staffs.id', '=', 'staff_payments.non_academic_staff_id')
        ->join('payment_categories', 'payment_categories.id', '=', 'staff_payments.payment_category')
        ->join('payment_gateways', 'payment_gateways.id', '=', 'staff_payments.payment_gateway')
        ->select('staff_payments.id','firstname', 'lastname', 'payment_category_name', 'amount', 'payment_gateway_name', 'staff_payments.created_by', 'staff_payments.created_at', 'staff_payments.updated_by', 'staff_payments.updated_at')
        ->where('staff_payments.id', $id)
        ->orderBy('staff_payments.created_at', 'DESC')->first();

        $createdBy = $this->fullName($academicPayment->created_by);

        $updatedBy = $this->fullName($academicPayment->updated_by);

        $data = compact('academicPayment', 'createdBy', 'updatedBy');

        return view('payments.payment-non-academic-show', $data)->with('i');
    }

    public function StudentPaymentsList(){

        $paymentHistories = DB::table('student_payment_histories')
        ->join('students', 'students.users_id', '=', 'student_payment_histories.user_id')
        ->join('fee_types', 'fee_types.id', '=', 'student_payment_histories.fee_type')
        ->join('fee_categories', 'fee_categories.id', '=', 'student_payment_histories.fee_category')
        ->join('payment_gateways', 'payment_gateways.id', '=', 'student_payment_histories.payment_gateway')
        ->select('students.id', 'firstname', 'lastname', 'fee_type_name', 'fee_name', 'payment_gateway_name', 'amount_paid', 'student_payment_histories.created_at')
        ->orderBy('student_payment_histories.created_at', 'ASC')->get();

        $data = compact('paymentHistories');

        return view('payments.payment-student-list', $data)->with('i');
    }
}
