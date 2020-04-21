<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Auth\LoginController;
use DB;
use App\StudentPaymentHistory;

class PaymentController extends Controller
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
        //
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
}
