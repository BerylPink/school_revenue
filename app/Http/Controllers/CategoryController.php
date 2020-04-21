<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
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
        $categories = Category::orderBy('category_name', 'ASC')->get();

        $data = compact('categories');

        return view('categories.cat-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.cat-create');
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
        $createCategory = Category::create([
            'category_name'            =>   $request->input('category_name'),
            'category_description'     =>   $request->input('category_description'),
        ]);

        //If successfully created go to login page
        if($createCategory){
            return redirect()->route('categories.index')->with('success', $request->input('category_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

     /**
     * Validate user input fields
     */
    private function validateRequest(){
        return request()->validate([
            'category_name'                 =>   'required|unique:categories,category_name',
            'category_description'          =>   'required', 
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
        $categoryExists = Category::findOrFail($id);

        $category = Category::select('id', 'category_name', 'category_description')->where('id', $id)->first();

        $data = compact('category');

        return view('categories.cat-edit', $data);
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
        $updateCategory = Category::where('id', $id)->update([
            'category_name'                =>   $request->input('category_name'),
            'category_description'         =>   $request->input('category_description'),
        ]);


        if( $updateCategory){

            return redirect('/categories')->with('success', 'Updated '.$request->input('category_name').' details.');
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
        $categoryExists = Category::findOrFail($id);

        $deleteCategory = Category::where('id', $id)->delete();

        if($deleteCategory){
            return back()->with('success', 'Non-Academic Staff category has been deleted.');
        }
    }
}
