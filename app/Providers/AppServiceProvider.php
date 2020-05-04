<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use DB;
use Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

            view()->composer('partials.*', function($view){

                if(Auth::check() == 'true'){
                    $userID = Auth::id();
                    $userRole = Auth::user()->user_role;
        
                    //Get basic information of Super Admin User
                    if($userRole == 1){
                        $users = DB::table('users')
                            ->join('super_admin_infos', 'super_admin_infos.users_id', '=', 'users.id')
                            ->select('email', 'user_role', 'firstname', 'lastname', 'profile_avatar')->where('users.id', $userID)->first();
                    }
                    //Get basic information of Admin User
                    if($userRole == 2){
                        $users = DB::table('users')
                            ->join('admin_infos', 'admin_infos.users_id', '=', 'users.id')
                            ->select('email', 'user_role', 'firstname', 'lastname', 'profile_avatar')->where('users.id', $userID)->first();
                    }
                    //Get basic information of HR User
                    if($userRole == 3){
                        $users = DB::table('users')
                        ->join('human_resource_infos', 'human_resource_infos.users_id', '=', 'users.id')
                        ->select('email', 'user_role', 'firstname', 'lastname', 'profile_avatar')->where('users.id', $userID)->first();
                    }

                    //Get basic information of HR User
                    if($userRole == 4){
                        $users = DB::table('users')
                        ->join('students', 'students.users_id', '=', 'users.id')
                        ->select('email', 'user_role', 'firstname', 'lastname', 'profile_avatar')->where('users.id', $userID)->first();
                    }
        
                    $view->with('user', $users);
            }else{
                return redirect()->route('logout');
            }
            });        

    }
}
