<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Admins;
use Auth;
use DB;
use Cartalyst\Stripe\Laravel\Facades\Stripe;

class AdminController extends Controller{
    
    public function adminsDashboard(){
        $data = DB::table('admins')->where('id', '=', Auth::id())->first();
        return view('admin-dashboard', [ 'data' => $data ]);
    }

    public function studentPayment(){
        $data = DB::table('admins')->where('id', '=', Auth::id())->first();
        $paymentTransaction = DB::select(DB::raw("SELECT 
                        concat(s.lastname, ', ', s.firstname) as student_name, 
                        concat(t.lastname, ', ', t.firstname) as teacher_name,
                        lpl.*, 
                        lo.title 
                    from lesson_schedule ls 
                    left join lesson_option lo on lo.id = ls.lesson_option_id
                    left join students s on s.id = ls.students_id
                    left join teachers t on t.id = ls.teachers_id
                    left join students_payment_log lpl on ls.id = lpl.lesson_schedule_id"));
        return view('admin.student-payment', [ 'data' => $data, 'paymentTransaction' => $paymentTransaction ]);
    }
    
    public function heygoWallet(){
        $data = DB::table('admins')->where('id', '=', Auth::id())->first();
        $paymentTransaction = DB::select(DB::raw("SELECT concat(s.lastname, ', ', s.firstname) as student_name, concat(t.lastname, ', ', t.firstname) as teacher_name,
                                                    spl.trans_id, spl.currency, spl.response_date, hw.* from heygo_wallet hw
                                                    LEFT JOIN students_payment_log spl on hw.students_payment_log_id = spl.id
                                                    LEFT JOIN lesson_schedule ls on ls.id = spl.lesson_schedule_id
                                                    LEFT JOIN teachers t on t.id = ls.teachers_id
                                                    LEFT JOIN students s on s.id = ls.students_id"));
        return view('admin.heygo-wallet', [ 'data' => $data, 'paymentTransaction' => $paymentTransaction ]);
    }
    
    public function teacherWallet(){
        $data = DB::table('admins')->where('id', '=', Auth::id())->first();
        $paymentTransaction = DB::select(DB::raw("SELECT 
                                                    concat(s.lastname, ', ', s.firstname) as student_name, concat(t.lastname, ', ', t.firstname) as teacher_name, 
                                                    spl.trans_id, spl.currency, spl.response_date, hw.* 
                                                    from teachers_wallet hw
                                                    LEFT JOIN students_payment_log spl on hw.students_payment_log_id = spl.id
                                                    LEFT JOIN lesson_schedule ls on ls.id = spl.lesson_schedule_id
                                                    LEFT JOIN teachers t on t.id = ls.teachers_id
                                                    LEFT JOIN students s on s.id = ls.students_id"));
        return view('admin.teachers-wallet', [ 'data' => $data, 'paymentTransaction' => $paymentTransaction ]);
    }
}
