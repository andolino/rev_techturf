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
Route::post('/get-teachers-details', [HomeController::class,'getTeachersDetails']);


Route::group(['middleware' => 'auth:students'], function () {
    // Route::view('/students', 'students');
    Route::get('/students', [HomeController::class, 'studentsDashboard']);
    Route::get('/teachers-profile/{any}', [HomeController::class, 'teachersProfile']);
});

Route::group(['middleware' => 'auth:teachers'], function () {
    // Route::view('/teachers', 'teachers');
    Route::get('/teachers', [HomeController::class, 'teachersDashboard']);
    Route::get('/teachers-account-settings', [HomeController::class, 'teachersAccountSettings']);
    
});

Route::get('logout', [LoginController::class,'logout']);