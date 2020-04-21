<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userRole = Auth::user()->user_role;
        
        if($userRole == '1' || $userRole == '2' || $userRole == '3'){
            return redirect()->route('superadmins.index');
        }else{
            return redirect()->route('students.dashboard');
            
        }
    }
}
