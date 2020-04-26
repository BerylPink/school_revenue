<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\ExpenseCategory;

class ExpenseCategoryController extends Controller
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
        $expenseCategories = ExpenseCategory::orderBy('expense_cat_name', 'ASC')->get();
       
        $data = compact('expenseCategories');

        return view('expensecategories.expense-cat-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('expensecategories.expense-cat-create');
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

        //INSERT INTO `expense categories` table
        $createExpenseCategory = ExpenseCategory::create([
            'expense_cat_name'               =>   $request->input('expense_cat_name'),
            'expense_cat_description'        =>   $request->input('expense_cat_description'),
        ]);

        //If successfully created go to login page
        if($createExpenseCategory){
            return redirect()->route('expense-categories.index')->with('success', $request->input('expense_cat_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'expense_cat_name'                 =>   'required|unique:expense_categories,expense_cat_name',
            'expense_cat_description'          =>   'required', 
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
        $expenseCategoryExists = ExpenseCategory::findOrFail($id);

        $expenseCategory = ExpenseCategory::select('id', 'expense_cat_name', 'expense_cat_description')->where('id', $id)->first();

        $data = compact('expenseCategory');

        return view('expensecategories.expense-cat-edit', $data);
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
        $updateExpenseCategory = ExpenseCategory::where('id', $id)->update([
            'expense_cat_name'                =>   $request->input('expense_cat_name'),
            'expense_cat_description'         =>   $request->input('expense_cat_description'),
        ]);


        if( $updateExpenseCategory){

            return redirect('/expense-categories')->with('success', 'Updated '.$request->input('expense_cat_name').' details.');
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
        $expenseCategoryExists = ExpenseCategory::findOrFail($id);

        $deleteExpenseCategory = ExpenseCategory::where('id', $id)->delete();

        if($deleteExpenseCategory){
            return back()->with('success', 'Expense category has been deleted.');
        }
    }
}
