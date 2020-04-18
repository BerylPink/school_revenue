<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gateway;

class GatewayController extends Controller
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
        $gateways = Gateway::orderBy('gateway_name', 'ASC')->get();

        $data = compact('gateways');

        return view('gateways.gateway-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gateways.gateway-create');
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
         $createGateway = Gateway::create([
             'gateway_name'            =>   $request->input('gateway_name'),
         ]);
 
         //If successfully created go to login page
         if($createGateway){
             return redirect()->route('gateways.index')->with('success', $request->input('gateway_name').' has been created!');
         }
 
         //If errors occur, return back to college create page
         return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'gateway_name'                 =>   'required|unique:gateways,gateway_name', 
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
        $gatewayExists = Gateway::findOrFail($id);

        $gateway = Gateway::select('id', 'gateway_name')->where('id', $id)->first();

        $data = compact('gateway');

        return view('gateways.gateway-edit', $data);
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
        $updateGateway = Gateway::where('id', $id)->update([
            'gateway_name'                =>   $request->input('gateway_name'),
        ]);


        if( $updateGateway){

            return redirect('/gateways')->with('success', 'Updated '.$request->input('gateway_name').' details.');
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
        $gatewayExists = Gateways::findOrFail($id);

        $deleteGateway = Gateways::where('id', $id)->delete();

        if($deleteGateways){
            return back()->with('success', 'Profile deleted.');
        }
    }
}
