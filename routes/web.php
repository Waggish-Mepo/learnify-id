<?php

use App\Http\Controllers\Admin\SubjectController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin;
use App\Http\Controllers\Teacher;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UploadController;

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
            return view('admin.statistik.accounts')->with('grades', config('constant.grades'));
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
        Route::get('/export-excel-student', [Admin\ManageAccountController::class, 'exportStudent']);
        Route::get('/export-excel-teacher', [Admin\ManageAccountController::class, 'exportTeacher']);
        Route::get('/download-excel-student', [Admin\ManageAccountController::class, 'downloadExcelStudent']);
        Route::get('/download-excel-teacher', [Admin\ManageAccountController::class, 'downloadExcelTeacher']);
        Route::post('/import-excel-student', [Admin\ManageAccountController::class, 'importStudent']);
        Route::post('/import-excel-teacher', [Admin\ManageAccountController::class, 'importTeacher']);
    });
});

// Teacher
Route::group(['middleware' => ['auth', 'role:TEACHER']], function(){
    Route::post('/upload-image', [UploadController::class, 'store'])->name('upload-image');
    Route::name('teacher.')->group(function() {

        Route::prefix('subject')->group(function () {
            Route::get('/course', [Teacher\CourseController::class, 'getCourse']);
            Route::post('/course', [Teacher\CourseController::class, 'createCourse']);

            
            
            Route::prefix('/course/topic')->name('content')->group(function () {
                Route::get('/', [Teacher\CourseController::class, 'getCourseTopic']);
                Route::post('/', [Teacher\CourseController::class, 'createCourseTopic']);

                Route::get('/content', [Teacher\TopicController::class, 'getContent']);
                Route::post('/content', [Teacher\TopicController::class, 'createContent']);
                Route::patch('/content', [Teacher\TopicController::class, 'updateContent']);
                Route::get('/contents', [Teacher\TopicController::class, 'getContents']);

                Route::get('/activity', [Teacher\ActivityController::class, 'getActivity']);
                Route::post('/activity', [Teacher\ActivityController::class, 'createActivity']);
                Route::patch('/activity', [Teacher\ActivityController::class, 'updateActivity']);

                Route::get('/question', [Teacher\ActivityController::class, 'getQuestion']);
                Route::post('/question', [Teacher\ActivityController::class, 'createQuestion']);
                Route::patch('/question', [Teacher\ActivityController::class, 'updateQuestion']);
            });

            Route::prefix('/{subject_id}')->group(function () {
                Route::get('/course', [Teacher\CourseController::class, 'index'])->name('subject');
                Route::prefix('/course/{course_id}')->group(function () {
                    Route::get('/', [Teacher\CourseController::class, 'detail'])->name('subject.course');

                    // Topic
                    Route::prefix('/topic/{topic_id}')->name('subject.topic.')->group(function () {
                        Route::get('/', [Teacher\TopicController::class, 'index'])->name('subject.topic');

                        // Content
                        Route::prefix('/content/{content_id}')->name('content')->group(function () {
                            Route::get('/', [Teacher\TopicController::class, 'index']);
                            Route::get('/publish/{status}', [Teacher\TopicController::class, 'publishContent']);
                        });

                        Route::prefix('/activity/{activity_id}')->name('content')->group(function () {
                            Route::get('/', [Teacher\ActivityController::class, 'index']);
                        });
                    });
                });
            });
        });
    });
});

// Student
Route::group(['middleware' => ['auth', 'role:STUDENT']], function(){
    // Route::name('student.')->group(function() {
        //
    // });
});

