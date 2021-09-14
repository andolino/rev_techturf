<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
use App\Models\Teachers;
use App\Models\Students;


class LoginController extends Controller{
    
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
   
    public function __construct(){
            $this->middleware('guest')->except('logout');
            $this->middleware('guest:teachers')->except('logout');
            $this->middleware('guest:students')->except('logout');
            $this->middleware('guest:admins')->except('logout');
    }

     public function showTeachersLoginForm(){
        $logged_in = true;
        $objT = Auth::guard('teachers')->user();
        $objS = Auth::guard('students')->user();
        if (is_null($objT) && is_null($objS)) {
            $logged_in = false;
        }
        return view('auth.login', ['url' => 'teachers', 'logged_in' => $logged_in]);
    }

    public function teachersLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('teachers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/teachers');
        }
        // return back()->withInput($request->only('email', 'remember'));
        return [ 'errors' => [
            'email' => ['Invalid Credentials']
        ]];
    }

    public function showStudentsLoginForm(){
        $logged_in = true;
        $objT = Auth::guard('teachers')->user();
        $objS = Auth::guard('students')->user();
        if (is_null($objT) && is_null($objS)) {
            $logged_in = false;
        }
        return view('auth.login', ['url' => 'students', 'logged_in' => $logged_in]);
    }
    
    public function showAdminsLoginForm(){
        $logged_in = true;
        $objS = Auth::guard('admins')->user();
        if (is_null($objS)) {
            $logged_in = false;
        }
        return view('auth.admin-login', ['url' => 'admins', 'logged_in' => $logged_in]);
    }

    public function adminsLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('admins')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/admins');
        }
        // return back()->withInput($request->only('email', 'remember'));
        // return [ 
        //     'errors' => [
        //         'email' => ['Invalid Credentials']
        //     ]
        // ];
    }
    
    public function studentsLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('students')->attempt([
                                        'email' => $request->email, 
                                        'password' => $request->password,
                                        'is_verified' => 1
                                    ], $request->get('remember'))) {
            return redirect()->intended('/students');
        }
        // return back()->withInput($request->only('email', 'remember'));
        $students = Students::where('email', $request->email)->first();
        return [ 'errors' => [
            'email' => [($students->is_verified == 0 ? 'Your Account is not verified' : 'Invalid Credentials')]
        ]];
    }
}