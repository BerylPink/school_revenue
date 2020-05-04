<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Auth\LoginController;
use App\Expense;
use App\ExpenseCategory;

class ExpenseController extends Controller
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
        $expenses = Expense::orderBy('expense_name', 'ASC')->get();

        $data = compact('expenses');

        return view('expenses.expense-list', $data)->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expenseCategories = ExpenseCategory::select('id', 'expense_cat_name', 'expense_cat_description')
        ->orderBy('expense_cat_name', 'ASC')->get();

        $finances = DB::table('finances')->select('school_fund', 'expenses_budget')->first();

        $expenses = DB::table('expenses')->sum('amount');

        $balance = $finances->expenses_budget - $expenses;

        $data = compact('expenseCategories', 'finances', 'expenses', 'balance');

        return view('expenses.expense-create', $data);
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
        $createExpense = Expense::create([
            'expense_categories_id'   =>   $request->input('expense_categories_id'),
            'expense_name'            =>   $request->input('expense_name'),
            'amount'                  =>   $request->input('amount'),
            'expense_description'     =>   $request->input('expense_description'),
            'created_by'              =>   $this->loggedUserID(),
        ]);

        //If successfully created go to login page
        if($createExpense){
            return redirect()->route('expenses.index')->with('success', $request->input('expense_name').' has been created!');
        }

        //If errors occur, return back to college create page
        return back()->withInput();
    }

    private function validateRequest(){
        return request()->validate([
            'expense_categories_id'        =>   'required',
            'expense_name'                 =>   'required|unique:expenses,expense_name',
            'amount'                       =>   'required', 
            'expense_description'          =>   'required',
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
        $expenseExists = Expense::findOrFail($id);

        $expense = Expense::where('id', $id)->first();

        $expenseCategories = ExpenseCategory::select('id', 'expense_cat_name', 'expense_cat_description')
        ->orderBy('expense_cat_name', 'ASC')->get();

        $createdBy = $this->fullName($expense->created_by);

        $updatedBy = $this->fullName($expense->updated_by);

        $data = compact('expense', 'expenseCategories', 'createdBy', 'updatedBy');

        return view('expenses.expense-show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expenseExists = Expense::findOrFail($id);

        $expense = Expense::select('id', 'expense_categories_id', 'expense_name', 'amount', 'expense_description')->where('id', $id)->first();

        $expenseCategories = ExpenseCategory::select('id', 'expense_cat_name', 'expense_cat_description')
        ->orderBy('expense_cat_name', 'ASC')->get();

        $data = compact('expense', 'expenseCategories');

        return view('expenses.expense-edit', $data);
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
        $updateExpense = Expense::where('id', $id)->update([
            'expense_categories_id'   =>   $request->input('expense_categories_id'),
            'expense_name'            =>   $request->input('expense_name'),
            'amount'                  =>   $request->input('amount'),
            'expense_description'     =>   $request->input('expense_description'),
            'updated_by'              =>   $this->loggedUserID(),

        ]);


        if( $updateExpense){

            return redirect('/expenses')->with('success', 'Updated '.$request->input('expense_name').' details.');
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
        $expenseExists = Expense::findOrFail($id);

        $deleteExpense = Expense::where('id', $id)->delete();

        if($deleteExpense){
            return back()->with('success', 'Expense has been deleted.');
        }
    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }

    public function fullName($id){
        $this->userFullName = new LoginController();

        return $this->userFullName->getFullName($id);
    }
}
