<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
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
Route::get('/',[DangNhapController::class, 'login'])->name('login');
Route::post('/',[DangNhapController::class, 'handleLogin'])->name('handle-login');
Route::get('/logout',[DangNhapController::class, 'logout'])->name('logout');

Route::get('/forget-password', [MailerController::class, "forgetPassword"])->name("forget-password");
Route::post('/forget-password', [MailerController::class, "sendEmail"])->name("send-email");

Route::get('/reset-password', [MailerController::class, "resetPassword"])->name("reset-password");
Route::post('/reset-password', [MailerController::class, "handelResetPassword"])->name("handle-reset-password");


Route::middleware('auth')->prefix('admin')->group(function(){
    Route::get('/', [AdminController::class, 'index'] )->name('admin-index');  
    Route::get('/add-account', [AdminController::class, 'addAccount'] )->name('add-account');
    Route::post('/add-account', [AdminController::class, 'saveAccount'] )->name('save-account');   
    Route::prefix('student')->group(function(){
        Route::get('/all-students', [AdminController::class, 'allStudent'])->name('all-students');
        Route::get('student-detail/{username}', [AdminController::class, 'studentDetail'])->name('student-detail');
        Route::get('edit-student-profile/{username}', [AdminController::class, 'editStudentProfile'])->name('edit-student-profile');
        Route::post('edit-student-profile/{username}', [AdminController::class, 'saveEditStudentProfile'])->name('save-edit-student-profile');
        Route::get('delete-student/{username}', [AdminController::class, 'deleteStudent'])->name('delete-student');
        Route::get('search-student', function () {
            return view('admin/students/search-student');
        })->name('search-student');
    });
    Route::prefix('classroom')->group(function(){
        Route::get('/all-classrooms', [AdminController::class, 'allClassroom'])->name('all-classrooms'); 
        Route::get('/all-members/{ma_lop}', [AdminController::class, 'allMembers'])->name('all-members');       
        Route::get('/classroom-detail/{ma_lop}', [AdminController::class, 'classroomDetail'])->name('classroom-detail');        
    });
    Route::prefix('teacher')->group(function(){
        Route::get('/all-teacher', [AdminController::class, 'allTeacher'])->name('all-teachers');
        Route::get('teacher-detail/{username}', [AdminController::class, 'teacherDetail'])->name('teacher-detail');
        Route::get('edit-teacher-profile/{username}', [AdminController::class, 'editTeacherProfile'])->name('edit-teacher-profile');
        Route::post('edit-teacher-profile/{username}', [AdminController::class, 'saveEditTeacherProfile'])->name('save-edit-teacher-profile');
        Route::get('search-teacher', function () {
            return view('admin/teachers/search-teacher');
        })->name('search-teacher');
    });
    


    
    Route::get('/detail', function () {
        return view('admin/admin-detail');
    })->name('admin-detail');
    Route::get('/edit-profile', function () {
        return view('admin/edit-profile');
    })->name('edit-profile');
    
});

Route::prefix('student')->group(function(){
    Route::get('/',[StudentController::class, 'index'])->name('student-index');
    
    // Route::get('/all-students', function () {
    //     return view('admin/students/all-students');
    // })->name('all-students');
    // Route::get('student-detail', function () {
    //     return view('admin/students/student-detail');
    // })->name('student-detail');
    // Route::get('add-student', function () {
    //     return view('admin/students/add-student');
    // })->name('add-student');
    // Route::get('search-student', function () {
    //     return view('admin/students/search-student');
    // })->name('search-student');
    
});

