<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Teachers;
use App\Models\Students;
use Auth;
use DB;

class HomeController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(){
        // $this->middleware('auth');
    }

    public  $teacher_availability_status = [ 0 => 'Open', 1 => 'Requested', 2 => 'Booked', 3 => 'Closed' ];

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
    
    public function displayTeacherCalendar(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        return view('teachers-calendar', ['data' => $data]);
    }
    
    public function getTeachersAvailability(){
        // $data = DB::table('teacher_availability')->where('teacher_id', '=', Auth::id())->get();
        $teacher_id = Auth::id();
        $data = DB::select(DB::raw("SELECT 
                                        ta.*,
                                        lp.body
                                    FROM teacher_availability ta
                                    LEFT JOIN lesson_plan lp on lp.id = ta.lesson_plan_id
                                    WHERE ta.teacher_id = $teacher_id
                                    ORDER BY ta.id asc"));
        $obj = array();
        $dlp = [];
        foreach ($data as $trow) {
            $dlp[] = array(
                'title'=>$trow->body,
                'start'=>str_replace(' ', 'T', date('Y-m-d H:i:s', strtotime($trow->start_time))),
                'end'=>str_replace(' ', 'T', date('Y-m-d H:i:s', strtotime($trow->end_time))),
                'id'=>$trow->id,
                'status'=>$trow->status,
                'lesson_plan_id'=>$trow->lesson_plan_id,
                'status_text' => $this->teacher_availability_status[$trow->status]
            );
        }
        $obj[] = $dlp;
        return response()->json($obj);
    }

    public function saveTeacherAvailability(){
        
        $q = DB::table('teacher_availability')->updateOrInsert([
                'teacher_id' => Request::post('user_id'),
                'id' => Request::post('teacher_availability_id'),
            ], [
                'teacher_id' => Request::post('user_id'),
                'lesson_plan_id' => Request::post('lesson_plan_id'),
                'start_time' => date('Y-m-d H:i:s', strtotime(Request::post('time_start'))),
                'end_time' => date('Y-m-d H:i:s', strtotime(Request::post('time_end'))),
                'status' => Request::post('selected_status')
            ]);
        if ($q) {
            $teacher_id = Auth::id();
            $data = DB::select(DB::raw("SELECT 
                                            ta.*,
                                            lp.body
                                        FROM teacher_availability ta
                                        LEFT JOIN lesson_plan lp on lp.id = ta.lesson_plan_id
                                        WHERE ta.teacher_id = $teacher_id
                                        ORDER BY ta.id asc"));
            $obj = array();
            $dlp = [];
            foreach ($data as $trow) {
                $dlp[] = array(
                    'title'=>$trow->body,
                    'start'=>str_replace(' ', 'T', date('Y-m-d H:i:s', strtotime($trow->start_time))),
                    'end'=>str_replace(' ', 'T', date('Y-m-d H:i:s', strtotime($trow->end_time))),
                    'id'=>$trow->id,
                    'status'=>$trow->status,
                    'lesson_plan_id'=>$trow->lesson_plan_id,
                    'status_text' => $this->teacher_availability_status[$trow->status]
                );
            }
            $obj[] = $dlp;
            return response()->json($obj);
        } else {
            return response()->json(['message'=>'error']);
        }
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
            'rate_per_hr'      => 'required|numeric',
            'lesson_plan_id'      => 'required',
            'lesson_rate_type_id'      => 'required',
            'currency_rate_id'      => 'required',
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
        $teachers->lesson_plan_id = Request::post('lesson_plan_id');
        $teachers->lesson_rate_type_id = Request::post('lesson_rate_type_id');
        $teachers->currency_rate_id = Request::post('currency_rate_id');
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
            'about_me'      => 'required',
        ]);
        $teachers = Students::find(Request::post('user_id'));
        $teachers->email = Request::post('email');
        $teachers->lastname = Request::post('lastname');
        $teachers->firstname = Request::post('firstname');
        $teachers->contact_no = Request::post('contact_no');
        $teachers->country_id = Request::post('country_id');
        $teachers->about_me = Request::post('about_me');
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
    public function getLessonTypeRate(){
        $data = DB::table('lesson_rate_type')
                    ->select('*')
                    ->get();
        return response()->json($data);
    }
    public function getLessonPlan(){
        $tol = DB::table('type_of_lesson')->select('*')->get();
        $obj = array();
        foreach ($tol as $trow) {
            $dlp = [];
            $lp = DB::table('lesson_plan')->where('type_of_lesson_id', '=', $trow->id)->get();
            if (!empty($lp)) {
                foreach ($lp as $lprow) {
                    $dlp[] = array(
                        'id'=>$lprow->id,
                        'body'=>$lprow->body
                    );
                }
                $obj[$trow->lesson_type] = $dlp;
            }
        }
        return response()->json($obj);
    }
    public function getCurrenyRate(){
        $data = DB::table('currency_rate')
                    ->select('*')
                    ->get();
        return response()->json($data);
    }
    public function getTeacherBookedLesson(){
        $students_id = Request::post('students_id');
        $data = DB::select(DB::raw("SELECT 
                                        ls.id as lesson_id,
                                        t.*, 
                                        DATE_FORMAT(min(lsd.lesson_date), '%Y-%m-%d %H:%i') as start_date,
                                        DATE_FORMAT(max(lsd.lesson_date), '%Y-%m-%d %H:%i') as end_date,
                                        concat(DATE_FORMAT(min(lsd.lesson_date), '%H:%i %p'), ' - ', DATE_FORMAT(max(lsd.lesson_date), '%H:%i %p')) as time_sched,
                                        lrt.type,
                                        lp.title,
                                        concat(t.lastname, ', ', t.firstname) as fullname
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    WHERE s.id = $students_id
                                    AND (ls.status = 1 OR ls.status = 3)
                                    GROUP BY ls.id
                                    ORDER BY ls.id desc"));
        return response()->json($data);
    }  
    public function getBookedTeacherInfo(){
        $lesson_date = date('Y-m-d', strtotime(Request::post('lesson_date')));
        $lesson_schedule_id = Request::post('lesson_schedule_id');
        $data = DB::select(DB::raw("SELECT 
                                        ls.id as lesson_id,
                                        t.*, 
                                        DATE_FORMAT(min(lsd.lesson_date), '%Y-%m-%d %H:%i') as start_date,
                                        DATE_FORMAT(max(lsd.lesson_date), '%Y-%m-%d %H:%i') as end_date,
                                        concat(DATE_FORMAT(min(lsd.lesson_date), '%H:%i %p'), ' - ', DATE_FORMAT(max(lsd.lesson_date), '%H:%i %p')) as time_sched,
                                        lrt.type,
                                        lp.title,
                                        concat(t.lastname, ', ', t.firstname) as fullname,
                                        ca.app_name,
                                        ls.app_id,
                                        ls.lesson_option_id
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    LEFT JOIN communication_app ca on ca.id = ls.communication_app_id
                                    WHERE ls.id = $lesson_schedule_id 
                                    GROUP BY DATE_FORMAT(ls.lesson_date, '%Y-%m-%d')
                                    ORDER BY ls.id desc"));
        return response()->json($data);
    }    
    public function approveStudentBooking(){
        $approval_type = Request::post('approval_type');
        $is_confirm = 1;
        if ($approval_type == 'confirm') {
            $is_confirm = 3;
        } else {
            $is_confirm = 0;
        }
        $lesson_schedule_id = Request::post('lesson_schedule_id');
        DB::table('lesson_schedule')
            ->where('id', '=', $lesson_schedule_id)
            ->update(['status' => $is_confirm]);
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
        $teachers = DB::table('teachers')
                        ->leftJoin('currency_rate', 'currency_rate.id', '=', 'teachers.currency_rate_id')
                        ->leftJoin('lesson_rate_type', 'lesson_rate_type.id', '=', 'teachers.lesson_rate_type_id')
                        ->select('teachers.*', 'currency_rate.currency', 'lesson_rate_type.type')
                        // , 'currency_rate.*', 'lesson_rate_type.type'
                        ->get();
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
    public function saveBookedSchedule(){
        $lesson_date = explode(',', Request::post('lesson_date'));
        $m = array();
        $d = array();
        array_push($m, array(
            'teachers_id'           => Request::post('teachers_id'),
            'lesson_plan_id'        => Request::post('lesson_plan_id'),
            'lesson_option_id'      => Request::post('lesson_option_id'),
            'communication_app_id'  => Request::post('communication_app_id'),
            'app_id'                => Request::post('app_id'),
            'students_id'           => Request::post('user_id')
        ));
        DB::table('lesson_schedule')->insert($m);
        $lesson_schedule_id = DB::getPdo()->lastInsertId();
        for ($i=0; $i < count($lesson_date); $i++) { 
            array_push($d, array(
                'lesson_schedule_id' => $lesson_schedule_id,
                'lesson_date'        => date('Y-m-d h:i:s', strtotime($lesson_date[$i])),
            ));
        }
        $q = DB::table('lesson_schedule_details')->insert($d);
        if ($q) {
            return redirect()->intended('students');
        }
    }
    public function getStudentBookedLesson() {
        $teachers_id = Request::post('teachers_id');
        $data = DB::select(DB::raw("SELECT 
                                        ls.id as lesson_id,
                                        t.*, 
                                        DATE_FORMAT(min(lsd.lesson_date), '%Y-%m-%d %H:%i') as start_date,
                                        DATE_FORMAT(max(lsd.lesson_date), '%Y-%m-%d %H:%i') as end_date,
                                        concat(DATE_FORMAT(min(lsd.lesson_date), '%H:%i %p'), ' - ', DATE_FORMAT(max(lsd.lesson_date), '%H:%i %p')) as time_sched,
                                        lrt.type,
                                        lp.title,
                                        concat(s.lastname, ', ', s.firstname) as fullname,
                                        s.id as students_id
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    WHERE t.id = $teachers_id
                                    AND (ls.status = 1 OR ls.status = 3)
                                    GROUP BY ls.id
                                    ORDER BY ls.id desc"));
        return response()->json($data);
    }
    public function getBookedStudentInfo(){
        $lesson_date = date('Y-m-d', strtotime(Request::post('lesson_date')));
        $students_id = Request::post('students_id');
        $lesson_schedule_id = Request::post('lesson_schedule_id');
        $data = DB::select(DB::raw("SELECT 
                                        ls.id as lesson_id,
                                        t.*, 
                                        DATE_FORMAT(min(lsd.lesson_date), '%Y-%m-%d %H:%i') as start_date,
                                        DATE_FORMAT(max(lsd.lesson_date), '%Y-%m-%d %H:%i') as end_date,
                                        concat(DATE_FORMAT(min(lsd.lesson_date), '%H:%i %p'), ' - ', DATE_FORMAT(max(lsd.lesson_date), '%H:%i %p')) as time_sched,
                                        lrt.type,
                                        lp.title,
                                        concat(s.lastname, ', ', s.firstname) as fullname,
                                        ca.app_name,
                                        ls.app_id,
                                        ls.lesson_option_id
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    LEFT JOIN communication_app ca on ca.id = ls.communication_app_id
                                    WHERE s.id = $students_id
                                    AND ls.id = $lesson_schedule_id
                                    AND (ls.status = 1 OR ls.status = 3)
                                    GROUP BY DATE_FORMAT(ls.lesson_date, '%Y-%m-%d')
                                    ORDER BY ls.id desc"));
        return response()->json($data);
    }  
    
    public function getStudentsInfo($id){
        $data = DB::table('students')->where('id', '=', $id)->get();
        return response()->json($data);
    }

    /*
    * get countries *
    */
    public function getCountries(){
        return DB::table('countries')
                    ->select('id', 'iso', 'country_name', 'iso3', 'phonecode')
                    ->get();
    }
    
    /*
    * get com app *
    */
    public function getCommunicationApp(){
        $data = DB::table('communication_app')
                    ->select('id', 'app_name', 'created_at', 'updated_at', 'icon')
                    ->get();
        return response()->json($data);
    }
    
    public function getAWeekCalendar(){
        $id = Request::post('teachers_id');
        $q = DB::table('teacher_availability')
                    ->where('teacher_id', '=', $id)
                    ->groupBy(DB::raw("DATE_FORMAT(start_time, '%Y-%m-%d')"))
                    ->select('id', 'start_time', 'end_time', 'status')
                    ->get();
        // // set current date
        // $date = date('m/d/Y');
        // // parse about any English textual datetime description into a Unix timestamp 
        // $ts = strtotime($date);
        // // calculate the number of days since Monday
        // $dow = date('w', $ts);
        // $offset = $dow - 1;
        // if ($offset < 0) {
        //     $offset = 6;
        // }
        // // calculate timestamp for the Monday
        // $ts = $ts - $offset*86400;
        // // loop from Monday till Sunday 
        $currWeek = [];
        // for ($i = 0; $i < 7; $i++, $ts += 86400){
        //     // $currWeek[] = date("m/d/Y l", $ts);
        //     array_push($currWeek, array(
        //         'key' => date("D", $ts),
        //         'value' => date("d", $ts),
        //         'w_date' => date("m/d/Y", $ts),
        //         'teachers_id' => Request::post('teachers_id')
        //     ));
        // }
        foreach ($q as $r) {
            // $currWeek[] = date("m/d/Y l", $ts);
            array_push($currWeek, array(
                'key' => date("D", strtotime($r->start_time)),
                'value' => date("d", strtotime($r->start_time)),
                'w_date' => date("m/d/Y", strtotime($r->start_time)),
                'teachers_id' => Request::post('teachers_id')
            ));
        }
        return $currWeek;
    }

    public function getATimeAvailablePerDay(){
        $id = Request::post('teachers_id');
        $q = DB::table('teacher_availability')
                    ->where('teacher_id', '=', $id)
                    ->select('id', 'start_time', 'end_time', 'status')
                    ->get();
        $time = array();            
        foreach ($q as $r) {
            // $currWeek[] = date("m/d/Y l", $ts);
            array_push($time, array(
                'w_date' => date("m/d/Y", strtotime($r->start_time)),
                'time' => date('H:i A', strtotime($r->start_time))
            ));
        }
        return $time; 

        // $timePerDay = array();
        // $time = [
        //     '01:00 AM',
        //     '01:30 AM',
        //     '02:00 AM',
        //     '02:30 AM',
        //     '03:00 AM',
        //     '03:30 AM',
        //     '04:00 AM',
        //     '04:30 AM',
        //     '05:00 AM'
        // ];
        // for ($i=0; $i < count($time); $i++) {
        //     array_push($timePerDay, array(
        //         array(
        //             'time'=>$time[$i]
        //         )
        //     ));
        // }
        // return $timePerDay;
    }




}


