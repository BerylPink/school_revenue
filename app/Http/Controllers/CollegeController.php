<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\College;

class CollegeController extends Controller
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
        $colleges = College::orderBy('college_name', 'ASC')->get();

        $data = compact('colleges');

        return view('colleges.college-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('colleges.college-create');
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
        $createCollege = College::create([
            'college_name'            =>   $request->input('college_name'),
            'college_description'     =>   $request->input('college_description'),
        ]);

        //If successfully created go to login page
        if($createCollege){
            return redirect()->route('colleges.index')->with('success', $request->input('college_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

     /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'college_name'                 =>   'required|unique:colleges,college_name',
            'college_description'          =>   'required', 
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
        $collegeExists = College::findOrFail($id);

        $college = College::select('id', 'college_name', 'college_description')->where('id', $id)->first();

        $data = compact('college');

        return view('colleges.college-edit', $data);
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
        $updateCollege = College::where('id', $id)->update([
            'college_name'                =>   $request->input('college_name'),
            'college_description'         =>   $request->input('college_description'),
        ]);


        if( $updateCollege){

            return redirect('/colleges')->with('success', 'Updated '.$request->input('college_name').' details.');
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
        $collegeExists = College::findOrFail($id);

        $deleteCollege = College::where('id', $id)->delete();

        if($deleteCollege){
            return back()->with('success', 'Profile deleted.');
        }
    }
}
