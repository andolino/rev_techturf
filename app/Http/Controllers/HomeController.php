<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Teachers;
use App\Models\Students;
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

    /*
    * teachers *
    */
    public function teachersDashboard(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        
        return view('teachers', ['data' => $data]);
    }

    public function getTeachersDetails(){
        return Teachers::where('id', '=', Request::post('user_id'))->get();
    }
    
    public function getStudentsDetails(){
        return Students::where('id', '=', Request::post('user_id'))->get();
    }
    
    public function teachersAccountSettings(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        return view('teachers-account-settings', ['data' => $data]);
    }
    
    public function getFetchTeacher(){
       return Teachers::latest()->get();
    }

    public function updateTeacherSettings(){
        Request::validate([
            'email'           => 'required|string|email|max:255',
            'lastname'        => 'required|string',
            'firstname'       => 'required|string',
            'country_id'      => 'required',
            'contact_no'      => 'required',
            'rate_per_hr'      => 'required|numeric',
            'objective_title' => 'required|string',
            'objective_text'  => 'required|string'
        ]);
        $teachers = Teachers::find(Request::post('user_id'));
        $teachers->email = Request::post('email');
        $teachers->lastname = Request::post('lastname');
        $teachers->firstname = Request::post('firstname');
        $teachers->contact_no = Request::post('contact_no');
        $teachers->rate_per_hr = Request::post('rate_per_hr');
        $teachers->country_id = Request::post('country_id');
        $teachers->objective_title = Request::post('objective_title');
        $teachers->objective_text  = Request::post('objective_text');
        $teachers->save();
        
        return redirect()->intended('teachers-account-settings');
    }
    
    public function updateStudentSettings(){
        Request::validate([
            'email'           => 'required|string|email|max:255',
            'lastname'        => 'required|string',
            'firstname'       => 'required|string',
            'country_id'      => 'required',
            'contact_no'      => 'required',
        ]);
        $teachers = Students::find(Request::post('user_id'));
        $teachers->email = Request::post('email');
        $teachers->lastname = Request::post('lastname');
        $teachers->firstname = Request::post('firstname');
        $teachers->contact_no = Request::post('contact_no');
        $teachers->country_id = Request::post('country_id');
        $teachers->save();
        
        return redirect()->intended('students-account-settings');
    }
    
    public function saveStudentBankAcct(){
        Request::validate([
            'account_name'           => 'required|string',
            'card_number'        => 'required|string',
            'expiry_date'       => 'required|string',
            'cvv_code'      => 'required',
            'card_name'      => 'required'
        ]);

        DB::table('student_banks')->insert([
            'student_id' => Request::post('user_id'),
            'bank' => Request::post('card_name'),
            'acct_no' => Request::post('card_number')
        ]);
        
        return redirect()->intended('students-payment-methods');
    }

    public function teachersProfile($id){
        $data = DB::table('teachers')->where('id', '=', $id)->first();
        $teachersRow = DB::table('teachers')->where('id', '=', $id)->get();
        return view('students', ['data' => $data, 'teachers' => [], 'teachersprofile' => $teachersRow]);
    }
    
    public function getTeachersInfo($id){
        $data = DB::table('teachers')->where('id', '=', $id)->get();
        return response()->json($data);
    }
    
    /*
    * get lesson option *
    */
    public function getLessonOption(){
        $data = DB::table('lesson_option')
                    ->leftJoin('currency_rate', 'currency_rate.id', '=', 'lesson_option.currency_rate_id')
                    ->select('lesson_option.*', 'currency_rate.currency')
                    ->get();
        return $data;//response()->json();
    }
    
    /*
    * students *
    */
    public function studentsDashboard(){
        $data = DB::table('students')->where('id', '=', Auth::id())->first();
        $teachers = DB::table('teachers')->get();
        if (isset($_GET['q'])) {
            $q = $_GET['q'];
            $teachers = Teachers::where('firstname','LIKE','%'.$q.'%')
                                ->orWhere('middlename','LIKE','%'.$q.'%')
                                ->orWhere('lastname','LIKE','%'.$q.'%')
                                ->orWhere('email','LIKE','%'.$q.'%')
                                ->get();
        }
        return view('students', ['data' => $data, 'teachers' => $teachers]);
    }
    public function studentsAccountSettings(){
        $data = DB::table('students')->where('id', '=', Auth::id())->first();
        return view('students-account-settings', ['data' => $data]);
    }
    public function studentsPaymentMethods(){
        $data = DB::table('students')->where('id', '=', Auth::id())->first();
        return view('students-payment-methods', ['data' => $data]);
    }

    /*
    * get countries *
    */
    public function getCountries(){
        return DB::table('countries')
                    ->select('id', 'iso', 'country_name', 'iso3', 'phonecode')
                    ->get();
    }
    
    public function getAWeekCalendar(){
        // set current date
        $date = date('m/d/Y');
        // parse about any English textual datetime description into a Unix timestamp 
        $ts = strtotime($date);
        // calculate the number of days since Monday
        $dow = date('w', $ts);
        $offset = $dow - 1;
        if ($offset < 0) {
            $offset = 6;
        }
        // calculate timestamp for the Monday
        $ts = $ts - $offset*86400;
        // loop from Monday till Sunday 
        $currWeek = [];
        for ($i = 0; $i < 7; $i++, $ts += 86400){
            // $currWeek[] = date("m/d/Y l", $ts);
            array_push($currWeek,array(
                'key' => date("D", $ts),
                'value' => date("d", $ts),
                'w_date' => date("m/d/Y", $ts)
            ));
        }
        return $currWeek;
    }

    public function getATimeAvailablePerDay(){
        $timePerDay = array();
        $time = [
            '8:00',
            '8:30',
            '9:00',
            '9:30',
            '10:00',
            '10:30',
            '11:00',
            '11:30',
            '12:00'
        ];
        for ($i=0; $i < count($time); $i++) {
            array_push($timePerDay, array(
                array(
                    'time'=>$time[$i]
                )
            ));
        }
        return $timePerDay;
    }




}


