<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Teachers;
use App\Models\Students;
use App\Models\Admins;
use Auth;
use DB;
use Cartalyst\Stripe\Laravel\Facades\Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\RegisterMail;


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
    
    public function teachersPurchaseHistory(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        $purchases = DB::select(DB::raw("SELECT 
                                            concat(s.lastname, ', ', s.firstname) as student_name, 
                                            concat(t.lastname, ', ', t.firstname) as teacher_name, 
                                            spl.trans_id, spl.currency, spl.response_date, spl.amount as gross_amount, hw.*,
                                            sl.level,
                                            ltd.title
                                        from teachers_wallet hw
                                        left join students_payment_log spl on hw.students_payment_log_id = spl.id
                                        left join lesson_schedule ls on ls.id = spl.lesson_schedule_id
                                        LEFT JOIN students_pref sp on sp.lesson_schedule_id = ls.id
                                        LEFT JOIN students_level sl ON sl.id = sp.students_level_id
                                        LEFT JOIN lesson_type_details ltd ON ltd.id = sp.lesson_type_details_id
                                        left join teachers t on t.id = ls.teachers_id
                                        left join students s on s.id = ls.students_id
                                        WHERE t.id = " . Auth::id()));
        return view('teacher-purchase-history', ['data' => $data, 'purchases' => $purchases]);
    }
    
    public function studentsPurchaseHistory(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        $purchases = DB::select(DB::raw("SELECT 
                                            concat(s.lastname, ', ', s.firstname) as student_name, 
                                            concat(t.lastname, ', ', t.firstname) as teacher_name, 
                                            spl.trans_id, spl.currency, spl.response_date, spl.amount as gross_amount, hw.*,
                                            sl.level,
                                            ltd.title
                                        from teachers_wallet hw
                                        left join students_payment_log spl on hw.students_payment_log_id = spl.id
                                        left join lesson_schedule ls on ls.id = spl.lesson_schedule_id
                                        LEFT JOIN students_pref sp on sp.lesson_schedule_id = ls.id
                                        LEFT JOIN students_level sl ON sl.id = sp.students_level_id
                                        LEFT JOIN lesson_type_details ltd ON ltd.id = sp.lesson_type_details_id
                                        left join teachers t on t.id = ls.teachers_id
                                        left join students s on s.id = ls.students_id
                                        WHERE s.id = " . Auth::id()));
        return view('student-purchase-history', ['data' => $data, 'purchases' => $purchases]);
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
        $student_id = Auth::id();
        $has_pref = DB::table('students_pref')
                        ->where([
                            ['students_id', '=', $student_id],
                            ['teachers_id', '=', $id]
                        ])
                        ->get();
        return response()->json(['data'=>$data, 'has_pref'=> count($has_pref) == 0 ? false : true]); //(count($has_pref) > 0 ? true : false)
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
                                        concat(t.lastname, ', ', t.firstname) as fullname,
                                        ls.status
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    WHERE s.id = $students_id
                                    -- AND (ls.status = 1 OR ls.status = 3)
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
                                        ls.lesson_option_id,
                                        ls.status,
                                        s.email as student_email,
                                        t.email as teacher_email,
                                        sl.level,
                                        ltd.title
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    LEFT JOIN communication_app ca on ca.id = ls.communication_app_id
                                    LEFT JOIN students_pref sp on sp.lesson_schedule_id = ls.id
                                    LEFT JOIN students_level sl ON sl.id = sp.students_level_id
                                    LEFT JOIN lesson_type_details ltd ON ltd.id = sp.lesson_type_details_id
                                    WHERE ls.id = $lesson_schedule_id 
                                    GROUP BY DATE_FORMAT(ls.lesson_date, '%Y-%m-%d')
                                    ORDER BY ls.id desc"));
        return response()->json($data);
    }

    public function approveStudentBooking(){
        $approval_type = Request::post('approval_type');
        $lesson_schedule_id = Request::post('lesson_schedule_id');
        $is_confirm = 1;

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
                                    WHERE ls.id = '$lesson_schedule_id'
                                    GROUP BY ls.id"));

        if ($approval_type == 'confirm') {
            $is_confirm = 3;
            DB::table('lesson_schedule')
                    ->where('id', '=', $lesson_schedule_id)
                    ->update(['status' => $is_confirm]);

            $email = $lsData[0]->email;
            $details = [
                'dest'=>'teacher_confirmed_lesson',
                'data' => [
                    'teacher_name' => $lsData[0]->lastname . ', ' . $lsData[0]->firstname,
                    'date' => date('Y-m-d H:i:s', strtotime($lsData[0]->start_time)),
                    'time' => date('h:i:s', strtotime($lsData[0]->start_time)) . ' - ' . date('h:i:s', strtotime($lsData[0]->end_time)),
                    'type_of_lesson' => $lsData[0]->level . ' - ' . $lsData[0]->title,
                ],
                'body' => ''
            ];
            Mail::to($email)->send(new RegisterMail($details));
        } else {
            try {
                $paymentLogs = DB::table('students_payment_log')->where('lesson_schedule_id', $lesson_schedule_id)->first();
                $stripe = Stripe::refunds()->create($paymentLogs->user_id);

                DB::table('students_payment_log')->insert([
                    'lesson_schedule_id' => $lesson_schedule_id,
                    'response_date' => date('Y-m-d H:i:s', $stripe['created']),
                    'is_invalid' => $stripe['status'] != 'succeeded' ? 1 : 0,
                    'trans_id' => $stripe['balance_transaction'],
                    'user_id' => $stripe['id'],
                    'charge_id' => $stripe['charge'],
                    'amount' => 0,
                    'refund_amount' => $paymentLogs->amount,
                    'trans_type' => $stripe['object'],
                    'currency' => strtoupper($stripe['currency'])
                ]);
                // update status of lesson schedule
                $is_confirm = 0;
                DB::table('lesson_schedule')
                    ->where('id', '=', $lesson_schedule_id)
                    ->update(['status' => $is_confirm]);
                
                

                $email = $lsData[0]->email;

                $details = [
                'dest'=>'teacher_cancelled_lesson',
                'data' => [
                    'teacher_name' => $lsData[0]->lastname . ', ' . $lsData[0]->firstname,
                    'date' => date('Y-m-d H:i:s', strtotime($lsData[0]->start_time)),
                    'time' => date('h:i:s', strtotime($lsData[0]->start_time)) . ' - ' . date('h:i:s', strtotime($lsData[0]->end_time)),
                    'type_of_lesson' => $lsData[0]->level . ' - ' . $lsData[0]->title,
                ],
                'body' => 'This is a body'
                ];
                
                Mail::to($email)->send(new RegisterMail($details));

                return response()->json($stripe);
            } catch (Exception $e) {
                return response()->json($e->getMesssage());
            }
        }
    }

    /*
    * get lesson option *
    */
    public function getLessonOption(){
        $teachers_id = Request::post('teachers_id');
        $students_id = Request::post('students_id');
        $data = DB::table('lesson_option')
                    ->leftJoin('currency_rate', 'currency_rate.id', '=', 'lesson_option.currency_rate_id')
                    ->select('lesson_option.*', 'currency_rate.currency', DB::raw("(SELECT GROUP_CONCAT(DISTINCT ls.lesson_option_id
                    ORDER BY ls.lesson_option_id DESC SEPARATOR ',') AS lesson_option_id FROM lesson_schedule ls
                    WHERE ls.lesson_option_id = lesson_option.id AND ls.students_id = $students_id
                    AND ls.teachers_id = $teachers_id) AS lesson_option_id"), DB::raw("(SELECT lrt.rate
                                                        FROM teachers t
                                                        left join lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                                        WHERE t.id = $teachers_id) AS trial_lesson_rate"))
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
                        ->leftJoin('lesson_schedule', 'lesson_schedule.teachers_id', '=', 'teachers.id')
                        ->select('teachers.*', 
                                'currency_rate.currency', 
                                'lesson_rate_type.type', 
                                DB::raw("GROUP_CONCAT(DISTINCT lesson_schedule.lesson_option_id
                                ORDER BY lesson_schedule.lesson_option_id DESC SEPARATOR ',') as lesson_option_id"))
                        // , 'currency_rate.*', 'lesson_rate_type.type'
                        ->groupBy('teachers.id')
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
    public function teachersPaymentMethods(){
        $data = DB::table('teachers')->where('id', '=', Auth::id())->first();
        return view('teachers-payment-methods', ['data' => $data]);
    }
    public function saveEmailCommunication(){
        $lesson_schedule_id = Request::post('lesson_schedule_id');
        $m = array();
        $d = array();
        array_push($m, array(
            'communication_app_id'  => Request::post('communication_app_id'),
            'app_id'                => Request::post('app_id'),
        ));
        DB::table('lesson_schedule')    
            ->where('id', $lesson_schedule_id)    
            ->update([
                'communication_app_id'  => Request::post('communication_app_id'),
                'app_id'                => Request::post('app_id'),
            ]);
        return redirect()->intended('students');
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
                                        s.id as students_id,
                                        ls.status
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    WHERE t.id = $teachers_id
                                    -- AND (ls.status = 1 OR ls.status = 3)
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
                                        ls.lesson_option_id,
                                        ls.status
                                    FROM teachers t
                                    LEFT JOIN lesson_schedule ls ON ls.teachers_id = t.id
                                    LEFT JOIN lesson_schedule_details lsd ON lsd.lesson_schedule_id = ls.id
                                    LEFT JOIN lesson_rate_type lrt on lrt.id = t.lesson_rate_type_id
                                    LEFT JOIN lesson_plan lp on lp.id = t.lesson_plan_id
                                    LEFT JOIN students s on s.id = ls.students_id
                                    LEFT JOIN communication_app ca on ca.id = ls.communication_app_id
                                    WHERE s.id = $students_id
                                    AND ls.id = $lesson_schedule_id
                                    -- AND (ls.status = 1 OR ls.status = 3)
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
    * get students level *
    */
    public function getStudentsLevel(){
        $data = DB::table('students_level')
                    ->select('id', 'level', 'age_range_from', 'age_range_to')
                    ->get();
        return response()->json($data);
    }
    
    /*
    * get Lesson Type Details *
    */
    public function getLessonTypeDetails(){
        $data = DB::table('lesson_type_details')
                    ->select('id', 'title', 'body')
                    ->get();
        $d = [];
        foreach ($data as $row) {
            array_push($d, array(
                'text'=>$row->body,
                'value'=>$row->id
            ));
        }
        return response()->json($d);
    }
    
    /*
    * get Student Test Preparation *
    */
    public function getTestStudentPreparation(){
        $data = DB::table('students_test_preparation')
                    ->select('id', 'title', 'body')
                    ->get();
        return response()->json($data);
    }
    
    /*
    * get Student English Level *
    */
    public function getStudentsEnglishLevel(){
        $data = DB::table('students_english_level')
                    ->select('id', 'level')
                    ->get();
        $d = array();
        foreach ($data as $row) {
            array_push($d, array(
                'text'=>$row->level,
                'value'=>$row->id
            ));
        }
        return response()->json($d);
    }
    
    /*
    * get Student Date Plan *
    */
    public function getStudentsDatePlan(){
        $data = DB::table('students_date_plan')
                    ->select('id', 'text')
                    ->get();
        $d = array();
        foreach ($data as $row) {
            array_push($d, array(
                'text'=>$row->text,
                'value'=>$row->id
            ));
        }
        return response()->json($d);
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
    
    /*
    * save students pref *
    */
    public function saveStudentPref(){
        $q = DB::table('students_pref')->updateOrInsert([
            'students_id' => Request::post('students_id'),
            'teachers_id' => Request::post('teachers_id'),
            'lesson_schedule_id' => null
        ], [
            // 'id' => Request::post('id'),
            'students_id' => Request::post('students_id'),
            'students_level_id' => Request::post('students_level_id'),
            'lesson_type_details_id' => implode(',', Request::post('lesson_type_details_id')),
            'students_test_preparation_id' => Request::post('students_test_preparation_id'),
            'test_prep_message' => Request::post('test_prep_message'),
            'students_english_level_id' => Request::post('students_english_level_id'),
            'students_date_plan_id' => Request::post('students_date_plan_id'),
            'teachers_id' => Request::post('teachers_id')
        ]); 
        if($q){
            return response()->json(['message'=>'success']);
        } else {
            return response()->json(['message'=>'error']);
        }
        return response()->json(Request::all());

        // return response()->json($data);
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
                'time' => date('H:i', strtotime($r->start_time))
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

    public function studentPaymentCharge(){
        try {
            /** 
             * Input Stripe Gateway
             */
            $stripe = Stripe::charges()->create([
                'amount' => Request::post('amount'),
                'currency' => 'USD',
                'source' => Request::post('stripeToken'),
                'receipt_email' => Request::post('email'),
                'description' => Request::post('book_description')
            ]);

            /** 
             * Input Backend
             */
            $lesson_date = Request::post('lesson_date');
            $m = array();
            $d = array();
            array_push($m, array(
                'teachers_id'           => Request::post('teachers_id'),
                'lesson_plan_id'        => Request::post('lesson_plan_id'),
                'lesson_option_id'      => Request::post('lesson_option_id'),
                // 'communication_app_id'  => Request::post('communication_app_id'),
                // 'app_id'                => Request::post('app_id'),
                'students_id'           => Request::post('user_id'),
                'created_at'            => date('Y-m-d H:i:s')
            ));
            DB::table('lesson_schedule')->insert($m);
            $lesson_schedule_id = DB::getPdo()->lastInsertId();
            for ($i=0; $i < count($lesson_date); $i++) { 
                array_push($d, array(
                    'lesson_schedule_id' => $lesson_schedule_id,
                    'lesson_date'        => date('Y-m-d H:i:s', strtotime($lesson_date[$i])),
                    'created_at'        => date('Y-m-d H:i:s')
                ));
            }
            DB::table('lesson_schedule_details')->insert($d);
            DB::table('students_payment_log')->insert([
                'lesson_schedule_id' => $lesson_schedule_id,
                'response_date' => date('Y-m-d H:i:s', $stripe['created']),
                'is_invalid' => $stripe['status'] != 'succeeded' ? 1 : 0,
                'trans_id' => $stripe['balance_transaction'],
                'user_id' => $stripe['id'],
                'amount' => Request::post('amount'),
                'trans_type' => $stripe['object'],
                'currency' => strtoupper($stripe['currency'])
            ]);
            /**
             * heygo wallet
             */
            $students_payment_log_id = DB::getPdo()->lastInsertId();
            DB::table('heygo_wallet')->insert([
                'students_payment_log_id' => $students_payment_log_id,
                'amount' => (Request::post('amount') * 0.15),
                'created_at' => date('Y-m-d H:i:s', $stripe['created'])
            ]);
            /**
             * teachers wallet
             */
            DB::table('teachers_wallet')->insert([
                'students_payment_log_id' => $students_payment_log_id,
                'amount' => Request::post('amount') - (Request::post('amount') * 0.15),
                'created_at' => date('Y-m-d H:i:s', $stripe['created'])
            ]);

            //update students pref
            $q = DB::table('students_pref')
                    ->where([
                        ['students_id', '=', Request::post('user_id')],
                        ['teachers_id', '=', Request::post('teachers_id')],
                        ['lesson_schedule_id', '=', null],
                    ])->update(
                        [
                            'lesson_schedule_id' => $lesson_schedule_id, 
                            'lesson_option_id' => Request::post('lesson_option_id')
                        ]
                    );
        
            if ($q) {
                // Trial Lesson
                $students_pref = DB::table('students_pref')
                            ->where([
                                ['students_id', '=', Request::post('user_id')],
                                ['teachers_id', '=', Request::post('teachers_id')],
                                ['lesson_schedule_id', '=', $lesson_schedule_id],
                            ])->first();

                $students_level = DB::table('students_level')
                                ->where('id', $students_pref->students_level_id)->first();
                $lessonTypeDetailsID = explode(',', $students_pref->lesson_type_details_id);
                $lesson_type_details = DB::table('lesson_type_details')
                                ->whereIn('id', $lessonTypeDetailsID)->first();

                $teacherData = Teachers::where('id', Request::post('teachers_id'))->first();


                $email = Request::post('email');
                $details = [
                    'dest'=>'student_booked_lesson',
                    'data' => [
                        'teacher_name' => $teacherData->lastname . ', ' . $teacherData->firstname,
                        'date' => date('Y-m-d H:i:s', strtotime($d[0]['lesson_date'])),
                        'time' => date('h:i:s', strtotime($d[0]['lesson_date'])) . ' - ' . date('h:i:s', strtotime($d[1]['lesson_date'])),
                        'type_of_lesson' => $students_level->level . ' - ' . $lesson_type_details->title,
                    ],
                    'body' => 'This is a body'
                ];
                Mail::to($email)->send(new RegisterMail($details));
            } else {
                // Any Lesson
                $teacherData = Teachers::where('id', Request::post('teachers_id'))->first();
                $email = Request::post('email');
                $details = [
                    'dest'=>'student_booked_lesson',
                    'data' => [
                        'teacher_name' => $teacherData->lastname . ', ' . $teacherData->firstname,
                        'date' => date('Y-m-d H:i:s', strtotime($d[0]['lesson_date'])),
                        'time' => date('h:i:s', strtotime($d[0]['lesson_date'])) . ' - ' . date('h:i:s', strtotime($d[1]['lesson_date'])),
                        'type_of_lesson' => ''
                    ],
                    'body' => 'This is a body'
                ];
                Mail::to($email)->send(new RegisterMail($details));
            }

            return response()->json(['stripe_date'=>$stripe,'lesson_schedule_id'=>$lesson_schedule_id]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

    }
    
    public function studentBookFreeTrial(){
        try {
            /** 
             * Input Backend
             */
            $lesson_date = Request::post('lesson_date');
            $m = array();
            $d = array();
            array_push($m, array(
                'teachers_id'           => Request::post('teachers_id'),
                'lesson_plan_id'        => Request::post('lesson_plan_id'),
                'lesson_option_id'      => Request::post('lesson_option_id'),
                // 'communication_app_id'  => Request::post('communication_app_id'),
                // 'app_id'                => Request::post('app_id'),
                'students_id'           => Request::post('user_id'),
                'created_at'            => date('Y-m-d H:i:s')
            ));
            DB::table('lesson_schedule')->insert($m);
            $lesson_schedule_id = DB::getPdo()->lastInsertId();
            for ($i=0; $i < count($lesson_date); $i++) { 
                array_push($d, array(
                    'lesson_schedule_id' => $lesson_schedule_id,
                    'lesson_date'        => date('Y-m-d H:i:s', strtotime($lesson_date[$i])),
                    'created_at'        => date('Y-m-d H:i:s')
                ));
            }
            DB::table('lesson_schedule_details')->insert($d);
            //update students pref
            $q = DB::table('students_pref')
                    ->where([
                        ['students_id', '=', Request::post('user_id')],
                        ['teachers_id', '=', Request::post('teachers_id')],
                        ['lesson_schedule_id', '=', null],
                    ])->update(
                        [
                            'lesson_schedule_id' => $lesson_schedule_id, 
                            'lesson_option_id' => Request::post('lesson_option_id')
                        ]
                    );
            if ($q) {
                // Trial Lesson
                $students_pref = DB::table('students_pref')
                            ->where([
                                ['students_id', '=', Request::post('user_id')],
                                ['teachers_id', '=', Request::post('teachers_id')],
                                ['lesson_schedule_id', '=', $lesson_schedule_id],
                            ])->first();

                $students_level = DB::table('students_level')
                                ->where('id', $students_pref->students_level_id)->first();
                $lessonTypeDetailsID = explode(',', $students_pref->lesson_type_details_id);
                $lesson_type_details = DB::table('lesson_type_details')
                                ->whereIn('id', $lessonTypeDetailsID)->first();

                $teacherData = Teachers::where('id', Request::post('teachers_id'))->first();
                $email = Request::post('email');
                $details = [
                    'dest'=>'student_booked_lesson',
                    'data' => [
                        'teacher_name' => $teacherData->lastname . ', ' . $teacherData->firstname,
                        'date' => date('Y-m-d H:i:s', strtotime($d[0]['lesson_date'])),
                        'time' => date('h:i:s', strtotime($d[0]['lesson_date'])) . ' - ' . date('h:i:s', strtotime($d[1]['lesson_date'])),
                        'type_of_lesson' => $students_level->level . ' - ' . $lesson_type_details->title,
                    ],
                    'body' => 'This is a body'
                ];
                Mail::to($email)->send(new RegisterMail($details));
            } else {
                // Any Lesson
                $teacherData = Teachers::where('id', Request::post('teachers_id'))->first();
                $email = Request::post('email');
                $details = [
                    'dest'=>'student_booked_lesson',
                    'data' => [
                        'teacher_name' => $teacherData->lastname . ', ' . $teacherData->firstname,
                        'date' => date('Y-m-d H:i:s', strtotime($d[0]['lesson_date'])),
                        'time' => date('h:i:s', strtotime($d[0]['lesson_date'])) . ' - ' . date('h:i:s', strtotime($d[1]['lesson_date'])),
                        'type_of_lesson' => ''
                    ],
                    'body' => 'This is a body'
                ];
                Mail::to($email)->send(new RegisterMail($details));
            }

            return response()->json(['lesson_schedule_id'=>$lesson_schedule_id]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }

    }
    
    public function teacherCreateStripe(){
        try {
            /** 
             * Input Stripe Gateway
             */
            $stripe = Stripe::customers()->create([
                'name' => Request::post('account_name'),
                'source' => Request::post('stripeToken'),
                'email' => Request::post('email'),
                'description' => 'Account Creation'
            ]);

            /** 
             * Input Backend
             */
            // $lesson_date = Request::post('lesson_date');
            // $m = array();
            // $d = array();
            // array_push($m, array(
            //     'teachers_id'           => Request::post('teachers_id'),
            //     'lesson_plan_id'        => Request::post('lesson_plan_id'),
            //     'lesson_option_id'      => Request::post('lesson_option_id'),
            //     // 'communication_app_id'  => Request::post('communication_app_id'),
            //     // 'app_id'                => Request::post('app_id'),
            //     'students_id'           => Request::post('user_id'),
            //     'created_at'            => date('Y-m-d H:i:s')
            // ));
            // DB::table('lesson_schedule')->insert($m);
            // $lesson_schedule_id = DB::getPdo()->lastInsertId();
            // for ($i=0; $i < count($lesson_date); $i++) { 
            //     array_push($d, array(
            //         'lesson_schedule_id' => $lesson_schedule_id,
            //         'lesson_date'        => date('Y-m-d h:i:s', strtotime($lesson_date[$i])),
            //         'created_at'        => date('Y-m-d H:i:s')
            //     ));
            // }
            // DB::table('lesson_schedule_details')->insert($d);
            DB::table('teachers')
                    ->where('id', Request::post('teachers_id'))
                    ->update(['stripe_id' => $stripe['id']]);

            // return response()->json(['stripe_date'=>$stripe,'lesson_schedule_id'=>$lesson_schedule_id]);
            return response()->json($stripe);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function updateStudentSchedule(){
        try {
            DB::table('lesson_schedule_details')->where('lesson_schedule_id', Request::post('lesson_schedule_id'))->delete();
            $d = [];
            for ($i=0; $i < count(Request::post('lesson_date')); $i++) { 
                array_push($d, array(
                    'lesson_schedule_id' => Request::post('lesson_schedule_id'),
                    'lesson_date' => date('Y-m-d H:i:s', strtotime(Request::post('lesson_date')[$i])),
                    'created_at' => date('Y-m-d H:i:s'),
                ));
            }
            DB::table('lesson_schedule_details')->insert($d);

            // email notification for students
            $student_email = Request::post('student_email');
            $details = [
                'dest'=>'student_reschedule_booked',
                'data' => [
                    'teacher_name' => Request::post('teacher_name'),
                    'date' => date('Y-m-d H:i:s', strtotime(Request::post('lesson_date')[0])),
                    'time' => date('h:i:s', strtotime(Request::post('lesson_date')[0])) . ' - ' . date('h:i:s', strtotime(Request::post('lesson_date')[1])),
                    'type_of_lesson' => Request::post('lesson_type')
                ],
                'body' => ''
            ];
            Mail::to($student_email)->send(new RegisterMail($details));

            // email notification for teachers
            // $student_email = Request::post('student_email');
            // $details = [
            //     'dest'=>'student_reschedule_booked',
            //     'data' => [
            //         'teacher_name' => Request::post('teacher_name'),
            //         'date' => date('Y-m-d H:i:s', strtotime(Request::post('lesson_date')[0])),
            //         'time' => date('h:i:s', strtotime(Request::post('lesson_date')[0])) . ' - ' . date('h:i:s', strtotime(Request::post('lesson_date')[1])),
            //         'type_of_lesson' => Request::post('lesson_type')
            //     ],
            //     'body' => ''
            // ];
            // Mail::to($student_email)->send(new RegisterMail($details));

            // return response()->json(['stripe_date'=>$stripe,'lesson_schedule_id'=>$lesson_schedule_id]);
            return response()->json(['msg'=>'Schedule Successfully Updated']);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

   



}


