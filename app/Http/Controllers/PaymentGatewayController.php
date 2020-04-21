<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentGateway;

class PaymentGatewayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct() {
        $this->middleware('auth:web');
    }

    public function index()
    {
        $gateways = PaymentGateway::orderBy('payment_gateway_name', 'ASC')->get();

        $data = compact('gateways');

        return view('paymentgateways.gateway-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentgateways.gateway-create');
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
         $createPaymentGateway = PaymentGateway::create([
             'payment_gateway_name'            =>   $request->input('payment_gateway_name'),
         ]);
 
         //If successfully created go to login page
         if($createPaymentGateway){
             return redirect()->route('payment-gateways.index')->with('success', $request->input('payment_gateway_name').' has been created!');
         }
 
         //If errors occur, return back to college create page
         return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'payment_gateway_name'        =>   'required|unique:payment_gateways,payment_gateway_name', 
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
        $paymentGatewayExists = PaymentGateway::findOrFail($id);

        $gateway = PaymentGateway::select('id', 'payment_gateway_name')->where('id', $id)->first();

        $data = compact('gateway');

        return view('paymentgateways.gateway-edit', $data);
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
        //UPDATE `gateway` tabble
        $updatePaymentGateway = PaymentGateway::where('id', $id)->update([
            'payment_gateway_name'                =>   $request->input('payment_gateway_name'),
        ]);


        if( $updatePaymentGateway){

            return redirect('/payment-gateways')->with('success', 'Updated '.$request->input('payment_gateway_name').' details.');
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
        $paymentGatewayExists = PaymentGateway::findOrFail($id);

        $deletePaymentGateway = PaymentGateway::where('id', $id)->delete();

        if($deletePaymentGateway){
            return back()->with('success', 'Payment gateway deleted.');
        }
    }
}
