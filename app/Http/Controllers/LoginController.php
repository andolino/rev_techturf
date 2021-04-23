<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;


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

    public function studentsLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);
        if (Auth::guard('students')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
            return redirect()->intended('/students');
        }
        // return back()->withInput($request->only('email', 'remember'));
        return [ 'errors' => [
            'email' => ['Invalid Credentials']
        ]];
    }
}