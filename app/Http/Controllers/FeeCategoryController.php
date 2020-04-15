<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\FeeCategory;
use App\FeeType;

class FeeCategoryController extends Controller
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

        $feeCategories = DB::table('fee_categories')
        ->join('fee_types', 'fee_types.id', '=', 'fee_categories.fee_type')
        ->select('fee_categories.id', 'fee_name', 'fee_type_name', 'amount', 'fee_categories.created_at')
        ->orderBy('fee_name', 'ASC')->get();

        $data = compact('feeCategories');

        return view('feecategories.fee-cat-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $feeTypes = FeeType::select('id', 'fee_type_name')
        ->orderBy('fee_type_name', 'ASC')->get();

        $data = compact('feeTypes');

        return view('feecategories.fee-cat-create', $data);

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
        $createFeeCategory = FeeCategory::create([
            'fee_type'   =>   $request->input('fee_type'),
            'fee_name'   =>   $request->input('fee_name'),
            'amount'     =>   $request->input('amount'),
        ]);

        //If successfully created go to login page
        if($createFeeCategory){
            return redirect()->route('fee-categories.index')->with('success', $request->input('fee_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'fee_type'        =>   'required',
            'fee_name'        =>   'required|unique:fee_categories,fee_name',
            'amount'          =>   'required', 
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
        $feeCategoryExists = FeeCategory::findOrFail($id);

        $feeCategory = DB::table('fee_categories')
        ->join('fee_types', 'fee_types.id', '=', 'fee_categories.fee_type')
        ->select('fee_categories.id', 'fee_types.id', 'fee_name', 'fee_type_name', 'amount')
        ->where('fee_categories.id', $id)->first();

        $feeTypes = FeeType::select('id', 'fee_type_name')
        ->orderBy('fee_type_name', 'ASC')->get();

        $data = compact('feeCategory', 'feeTypes');

        return view('feecategories.fee-cat-edit', $data);
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
        $updateFeeCategory = FeeCategory::where('id', $id)->update([
            'fee_type'       =>   $request->input('fee_type'),
            'fee_name'       =>   $request->input('fee_name'),
            'amount'         =>   $request->input('amount'),
        ]);


        if( $updateFeeCategory){

            return redirect('/fee-categories')->with('success', 'Updated '.$request->input('fee_name').' details.');
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
        $feeCategoryExists = FeeCategory::findOrFail($id);

        $deleteFeeCategory = FeeCategory::where('id', $id)->delete();

        if($deleteFeeCategory){
            return back()->with('success', 'Fee category deleted.');
        }
    }
}
