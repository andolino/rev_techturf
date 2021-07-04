<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/teacher-dashboard', function () {
    return view('teacher-dashboard');
});


Auth::routes();

// GET
Route::get('/login/teachers', [LoginController::class, 'showTeachersLoginForm']);
Route::get('/login/students', [LoginController::class,'showStudentsLoginForm']);
Route::get('/register/teachers', [RegisterController::class, 'showTeachersRegisterForm']);
Route::get('/register/students', [RegisterController::class,'showStudentsRegisterForm']);
Route::get('/get-countries', [HomeController::class,'getCountries']);

// POST
Route::post('/login/teachers', [LoginController::class,'teachersLogin']);
Route::post('/login/students', [LoginController::class,'studentsLogin']);
Route::post('/register/teachers', [RegisterController::class,'createTeachers']);
Route::post('/register/students', [RegisterController::class,'createStudents']);
Route::post('/update-teacher-settings', [HomeController::class,'updateTeacherSettings']);
Route::post('/update-student-settings', [HomeController::class,'updateStudentSettings']);
Route::post('/get-teachers-details', [HomeController::class,'getTeachersDetails']);
Route::post('/get-students-details', [HomeController::class,'getStudentsDetails']);
Route::get('/get-time-available-per-day', [HomeController::class, 'getATimeAvailablePerDay']);
Route::get('/get-week-calendar', [HomeController::class, 'getAWeekCalendar']);
Route::post('/get-booked-student-info', [HomeController::class, 'getBookedStudentInfo']);



Route::group(['middleware' => 'auth:students'], function () {
    // Route::view('/students', 'students');
    Route::get('/students', [HomeController::class, 'studentsDashboard']);
    Route::get('/teachers-profile/{any}', [HomeController::class, 'teachersProfile']);
    Route::get('/get-teachers-info/{any}', [HomeController::class, 'getTeachersInfo']);
    Route::get('/get-lesson-option', [HomeController::class, 'getLessonOption']);
    Route::get('/students-account-settings', [HomeController::class, 'studentsAccountSettings']);
    Route::get('/students-payment-methods', [HomeController::class, 'studentsPaymentMethods']);
    Route::post('/save-student-bank-acct', [HomeController::class, 'saveStudentBankAcct']);
    Route::get('/get-com-app', [HomeController::class, 'getCommunicationApp']);
    Route::post('/save-booked-schedule', [HomeController::class, 'saveBookedSchedule']);
    Route::post('/get-teacher-booked-lesson', [HomeController::class, 'getTeacherBookedLesson']);
    Route::post('/get-booked-teacher-info', [HomeController::class, 'getBookedTeacherInfo']);

});

Route::group(['middleware' => 'auth:teachers'], function () {
    // Route::view('/teachers', 'teachers');
    Route::get('/teachers', [HomeController::class, 'teachersDashboard']);
    Route::get('/teachers-account-settings', [HomeController::class, 'teachersAccountSettings']);
    Route::get('/get-students-info/{any}', [HomeController::class, 'getStudentsInfo']);
    Route::get('/get-lesson-type-rate', [HomeController::class, 'getLessonTypeRate']);
    Route::get('/get-lesson-plan', [HomeController::class, 'getLessonPlan']);
    Route::get('/get-curreny-rate', [HomeController::class, 'getCurrenyRate']);
    Route::post('/get-student-booked-lesson', [HomeController::class, 'getStudentBookedLesson']);
});

Route::get('logout', [LoginController::class,'logout']);