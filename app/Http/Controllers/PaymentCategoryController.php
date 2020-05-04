<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PaymentCategory;

class PaymentCategoryController extends Controller
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
        $paymentCategories = PaymentCategory::orderBy('payment_category_name', 'ASC')->get();
       
        $data = compact('paymentCategories');

        return view('paymentcategories.payment-cat-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paymentcategories.payment-cat-create');
        
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

        //INSERT INTO `payment_categories` table
        $createPaymentCategory = PaymentCategory::create([
            'payment_category_name'               =>   $request->input('payment_category_name'),
            'payment_category_description'        =>   $request->input('payment_category_description'),
        ]);

        //If successfully created go to login page
        if($createPaymentCategory){
            return redirect()->route('payment-categories.index')->with('success', $request->input('payment_category_name').' has been created!');
        }

        //If errors occur, return back to payment categories create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'payment_category_name'                 =>   'required|unique:payment_categories,payment_category_name',
            'payment_category_description'          =>   'required', 
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
        $paymentCategoryExists = PaymentCategory::findOrFail($id);

        $paymentCategory = PaymentCategory::select('id', 'payment_category_name', 'payment_category_description')->where('id', $id)->first();

        $data = compact('paymentCategory');

        return view('paymentcategories.payment-cat-edit', $data);
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
        $updatePaymentCategory = PaymentCategory::where('id', $id)->update([
            'payment_category_name'                =>   $request->input('payment_category_name'),
            'payment_category_description'         =>   $request->input('payment_category_description'),
        ]);


        if( $updatePaymentCategory){

            return redirect('/payment-categories')->with('success', 'Updated '.$request->input('payment_category_name').' details.');
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
        $paymentCategoryExists = PaymentCategory::findOrFail($id);

        $deletePaymentCategory = PaymentCategory::where('id', $id)->delete();

        if($deletePaymentCategory){
            return back()->with('success', 'Payment category has been deleted.');
        }
    }
}
