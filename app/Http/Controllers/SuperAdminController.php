<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Auth\LoginController;
use Auth;
use App\User;
use App\SuperAdmin;
use App\Student;
use App\Academic;
use App\NonAcademic;
use App\StaffPayment;
use App\StudentPaymentHistory;

class SuperAdminController extends Controller
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
        $totalStudents = Student::count();

        $totalAcademicStaffs = Academic::count();

        $totalNonAcademicStaffs = NonAcademic::count();

        $finances = DB::table('finances')->select('school_fund', 'expenses_budget')->first();

        $expenses = DB::table('expenses')->sum('amount');

        $balance = $finances->expenses_budget - $expenses;

        $totalAcademicStaffPayment = StaffPayment::where('academic_staff_id', '>', 0)->count();

        $totalNonAcademicStaffPayment = StaffPayment::where('non_academic_staff_id', '>', 0)->count();

        $totalStudentPayment = StudentPaymentHistory::count();

        $studentPayments = StudentPaymentHistory::sum('amount_paid');

        
        $data = compact('totalStudents', 'totalAcademicStaffs', 'totalNonAcademicStaffs', 'finances', 'expenses', 'balance', 'totalAcademicStaffPayment', 'totalNonAcademicStaffPayment', 'totalStudentPayment', 'studentPayments');

        return view('superadmin.dashboard', $data);
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
        
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $userExists = User::findOrFail($id);

        $userRole = User::select('user_role')->where('id', $id)->first();

        if($userRole->user_role === 1){

            $superAdmin = DB::table('users')
            ->join('super_admin_infos', 'super_admin_infos.users_id', '=', 'users.id')
            ->select('users.id', 'email', 'firstname', 'lastname', 'phone_no', 'address', 'profile_avatar', 'users.created_at')
            ->where('users.id', $id)->first();
    
            $usersCreated = User::where('created_by', $id)->count();
    
            $data = compact('superAdmin', 'usersCreated');
            // return response()->json($data);
            
            return view('superadmin.sa-show', $data);
        }else{
            return back()->with('error', 'This User is not a Super Admin');
        }
        
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

    public function superAdminList(){

        // dd('Here');

        $superAdmins = DB::table('users')
        ->join('super_admin_infos', 'super_admin_infos.users_id', '=', 'users.id')
        ->select('users.id', 'email', 'firstname', 'lastname',  'users.created_at')
        ->orderBy('users.created_at', 'DESC')->get();

        $data = compact('superAdmins');

        return view('superadmin.sa-list', $data)->with('i');
    }

    public function changePassword(){

        return view('superadmin.change-password');
    }

    public function updatePassword(Request $request){

        // return $request;

        request()->validate([
            'password'                  =>   'required',
            'confirm_password'          =>   'required|same:password', 
        ]);

        $updatePassword = User::where('id', $this->loggedUserID())->update([
            'password'            =>   Hash::make($request->input('password')),
        ]);

        if($updatePassword){
            if(Auth::user()->user_role === 4){

                return redirect()->route('students.dashboard')->with('success', 'Password has been updated.');
            }else{

                return redirect()->route('superadmins.index')->with('success', 'Password has been updated.');
            }
        }
            
        return back()->withInput();

    }

    public function loggedUserID(){
        $this->userID = new LoginController();

        return $this->userID->userID();
    }
}
