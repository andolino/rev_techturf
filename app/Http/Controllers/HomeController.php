<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(){   
        $logged_in = true;
        $objT = Auth::guard('teachers')->user();
        $objS = Auth::guard('students')->user();
        if (is_null($objT) && is_null($objS)) {
            $logged_in = false;
        }
        return view('index', [
                                'logged_in' => $logged_in,
                            ]);
    }

    public function teachersDashboard(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        return view('teachers', ['data' => $data]);
    }
    
    public function teachersAccountSettings(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        return view('teachers-account-settings', ['data' => $data]);
    }
    
    public function studentsDashboard(){
        $data = DB::table('students')->where('id', '=', Auth::id())->get();
        return view('students', ['data' => $data]);
    }
}
