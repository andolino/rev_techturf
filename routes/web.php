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

Route::get('/', function () {
    return view('index');
});

Route::get('/teacher-dashboard', function () {
    return view('teacher-dashboard');
});


Auth::routes();


Route::get('/login/teachers', [LoginController::class, 'showTeachersLoginForm']);
Route::get('/login/students', [LoginController::class,'showStudentsLoginForm']);
Route::get('/register/teachers', [RegisterController::class, 'showTeachersRegisterForm']);
Route::get('/register/students', [RegisterController::class,'showStudentsRegisterForm']);

Route::post('/login/teachers', [LoginController::class,'teachersLogin']);
Route::post('/login/students', [LoginController::class,'studentsLogin']);
Route::post('/register/teachers', [RegisterController::class,'createTeachers']);
Route::post('/register/students', [RegisterController::class,'createStudents']);

Route::group(['middleware' => 'auth:students'], function () {
    Route::view('/students', 'students');
});

Route::group(['middleware' => 'auth:teachers'], function () {
    Route::view('/teachers', 'teachers');
});

Route::get('logout', [LoginController::class,'logout']);