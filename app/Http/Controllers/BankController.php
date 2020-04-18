<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Bank;

class BankController extends Controller
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
        $banks = Bank::orderBy('account_name', 'ASC')->get();

        $data = compact('banks');

        return view('banks.bank-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $banks = Bank::select('id', 'bank_name', 'account_name', 'account_number')
        ->orderBy('account_name', 'ASC')->get();

        $data = compact('banks');

        return view('banks.bank-create', $data);
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
        $createBank = Bank::create([
            'bank_name'                  =>   $request->input('bank_name'),
            'account_name'               =>   $request->input('account_name'),
            'account_number'             =>   $request->input('account_number'),
        ]);

        //If successfully created go to login page
        if($createDepartment){
            return redirect()->route('banks.index')->with('success', $request->input('account_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'bank_name'                    =>   'required',
            'account_name'                 =>   'required|unique:banks,account_name',
            'account_number'               =>   'required', 
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
        $bankExists = Bank::findOrFail($id);

        $bank = Bank::select('id', 'bank_name', 'account_name', 'account_number')->where('id', $id)->first();

        $data = compact('bank');

        return view('banks.bank-edit', $data);
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
        //UPDATE `colleges` tabble
        $updateBank = Bank::where('id', $id)->update([
            'bank_name'             =>   $request->input('bank_name'),
            'account_name'          =>   $request->input('account_name'),
            'account_number'        =>   $request->input('account_number'),
        ]);


        if( $updateCollege){

            return redirect('/banks')->with('success', 'Updated '.$request->input('account_name').' details.');
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
        $bankExists = Bank::findOrFail($id);

        $deleteBank = Bank::where('id', $id)->delete();

        if($deleteBank){
            return back()->with('success', 'Profile deleted.');
        }
    }
}
