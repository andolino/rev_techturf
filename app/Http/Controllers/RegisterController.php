<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teachers;
use App\Models\Students;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;
use Illuminate\Support\Facades\Crypt;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;
    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
        $this->middleware('guest:teachers');
        $this->middleware('guest:students');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showTeachersRegisterForm(){
        $countries = DB::table('countries')->get();
        return view('auth.teachers-registration', ['url' => 'teachers', 'countries' => $countries]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showStudentsRegisterForm(){
        return view('auth.register', ['url' => 'students']);
    }

    /**
     * @param array $data
     *
     * @return mixed
     */
    

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createTeachers(Request $request){
        $request->validate([
            // 'username'        => 'required|string|max:255',
            'email'           => 'required|string|email|max:255|unique:teachers',
            'password'        => 'required|string|min:6'
            // 'password'        => 'required|string|min:6|confirmed'
            // 'lastname'        => 'required|string',
            // 'middlename'      => 'required|string',
            // 'firstname'       => 'required|string',
            // 'rate_per_hr'     => 'required|numeric',
            // 'country_id'      => 'required',
            // 'objective_title' => 'required|string',
            // 'objective_text'  => 'required|string'
        ]);
        Teachers::create([
            // 'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
            // 'lastname' => $request->lastname,
            // 'middlename' => $request->middlename,
            // 'firstname' => $request->firstname,
            // 'rate_per_hr' => $request->rate_per_hr,
            // 'country_id' => $request->country_id,
            // 'objective_title' => $request->objective_title,
            // 'objective_text'  => $request->objective_text
        ]);
        return redirect()->intended('login/teachers');
    }

    

    /**
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    protected function createStudents(Request $request){
        $request->validate([
            // 'username' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'password' => 'required|string|min:6'
            // 'password' => 'required|string|min:6|confirmed'
        ]);
        Students::create([
            // 'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $this->verifyStudentEmail($request);
        return redirect()->intended('login/students');
    }

    public function verifyStudentEmail($req){
        $email = $req->email;
        $details = [
            'dest'=>'registration',
            'title' => 'This is a title',
            'body' => 'This is a body',
            'ver_link' => url('/verifying-student-email') . '/' . Crypt::encryptString($email),
        ];
        Mail::to($email)->send(new RegisterMail($details));
    }

    public function verifyingStudentEmail($encEmail){
        $email = Crypt::decryptString($encEmail);
        $q = Students::where('email', $email)
                    ->update(['is_verified' => 1]);
        if ($q) {
            $logged_in = false;
            return view('index', [
                'is_verified' => true,
                'logged_in' => $logged_in,
                'msg' => 'Your email is already verified!'
            ]);
        } else {
            $logged_in = false;
            return view('index', [
                'is_verified' => false,
                'logged_in' => $logged_in,
                'msg' => 'Error encounter!'
            ]);
        }
    }

    public function viewRegTemplate(){
        $details = [
            'title' => 'This is a title',
            'body' => 'This is a body',
            'ver_link' => '',
        ];
        // return view('emails.student_reg_mail', ['details' => $details]);
        // return view('emails.student_booked_lesson', ['details' => $details]);
        // return view('emails.student_booked_lesson', ['details' => $details]);
        $lsData = DB::select(DB::raw("SELECT 
                                                    t.*,
                                                    s.email,
                                                    min(lsd.lesson_date) as start_time,
                                                    max(lsd.lesson_date) as end_time,
                                                    sl.level,
                                                    ltd.title
                                                FROM teachers t
                                                LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                                LEFT JOIN students s ON s.id = ls.students_id
                                                LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                                LEFT JOIN students_pref sp on sp.lesson_schedule_id = ls.id
                                                LEFT JOIN students_level sl ON sl.id = sp.students_level_id
                                                LEFT JOIN lesson_type_details ltd ON ltd.id = sp.lesson_type_details_id
                                                WHERE ls.id = '87'
                                                GROUP BY ls.id"));
        echo $lsData[0]->email;
    }

    
}