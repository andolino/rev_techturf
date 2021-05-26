<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Request;
use App\Models\Teachers;
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

    public function teachersProfile($id){
        $data = DB::table('teachers')->where('id', '=', $id)->first();
        $teachersRow = DB::table('teachers')->where('id', '=', $id)->get();
        return view('students', ['data' => $data, 'teachers' => [], 'teachersprofile' => $teachersRow]);
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

    /*
    * get countries *
    */
    public function getCountries(){
        return DB::table('countries')
                    ->select('id', 'iso', 'country_name', 'iso3', 'phonecode')
                    ->get();
    }
    




}


