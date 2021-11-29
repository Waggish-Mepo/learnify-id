<?php

use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;

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

// Test
Route::get('/test-layout', function () {
    return view('example.index');
});

// Auth
Route::get('/', [LoginController::class, 'check']);
Route::get('/login', [LoginController::class, 'check'])->name('login');
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('auth');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:ADMIN,TEACHER,STUDENT']], function(){
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
});

// Admin
Route::group(['middleware' => ['auth', 'role:ADMIN']], function(){
    Route::name('admin.')->group(function() {
        Route::get('/statistik/accounts/{role}', function () {
            return view('admin.statistik.accounts');
        })->name('statistik.accounts');

        Route::get('/subjects', [SubjectController::class, 'index'])
        ->name('subjects');
        Route::post('/subjects', [SubjectController::class, 'create']);
        Route::post('/assign-subject', [SubjectController::class, 'assign']);
        Route::patch('/subjects', [SubjectController::class, 'update']);
        
        Route::get('/account', [Admin\ManageAccountController::class, 'getAccount']);
        Route::post('/account', [Admin\ManageAccountController::class, 'createAccount']);
        Route::patch('/account', [Admin\ManageAccountController::class, 'updateAccount']);
        Route::get('/account-reset', [Admin\ManageAccountController::class, 'resetPassword']);
    });
});

// Teacher
Route::group(['middleware' => ['auth', 'role:TEACHER']], function(){
    Route::get('/subject', function () {
            return view('teacher.subject');
    })->name('subject');
    Route::get('/subjects/course', function () {
            return view('teacher.course');
    })->name('subject.course');
});

// Student
Route::group(['middleware' => ['auth', 'role:STUDENT']], function(){
    // Route::name('student.')->group(function() {
        // 
    // });
});

