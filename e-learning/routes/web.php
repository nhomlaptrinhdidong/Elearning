<?php

use App\Http\Controllers\DangNhapController;
use App\Http\Controllers\MailerController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SocialController;

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

Route::get('/', [DangNhapController::class, 'login'])->name('login');
Route::post('/', [DangNhapController::class, 'handleLogin'])->name('handle-login');
Route::get('/logout', [DangNhapController::class, 'logout'])->name('logout');

Route::get('/forget-password', [MailerController::class, "forgetPassword"])->name("forget-password");
Route::post('/forget-password', [MailerController::class, "sendEmail"])->name("send-email");
Route::get('/reset-password', [MailerController::class, "resetPassword"])->name("reset-password");
Route::post('/reset-password', [MailerController::class, "handelResetPassword"])->name("handle-reset-password");


Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin-index');
    Route::get('/add-account', [AdminController::class, 'addAccount'])->name('add-account');
    Route::post('/add-account', [AdminController::class, 'saveAccount'])->name('save-account');
    Route::prefix('student')->group(function () {
        Route::get('/all-students', [AdminController::class, 'allStudent'])->name('all-students');
        Route::get('student-detail/{username}', [AdminController::class, 'studentDetail'])->name('admin-student-detail');
        Route::get('edit-student-profile/{username}', [AdminController::class, 'editStudentProfile'])->name('edit-student-profile');
        Route::post('edit-student-profile/{username}', [AdminController::class, 'saveEditStudentProfile'])->name('save-edit-student-profile');
    });
    Route::prefix('classroom')->group(function () {
        Route::get('/all-classrooms', [AdminController::class, 'allClassroom'])->name('all-classrooms');
        Route::get('/all-members/{ma_lop}', [AdminController::class, 'allMembers'])->name('all-members');
        Route::get('/classroom-detail/{ma_lop}', [AdminController::class, 'classroomDetail'])->name('classroom-detail');
        Route::get('/add-classroom', [AdminController::class, 'addClasroom'])->name('add-classroom');
        Route::post('/add-classroom', [AdminController::class, 'saveAddClasroom'])->name('save-add-classroom');
        Route::get('/delete-classroom/{ma_lop}', [AdminController::class, 'deleteClasroom'])->name('detete-classroom');
    });
    Route::prefix('teacher')->group(function () {
        Route::get('/all-teacher', [AdminController::class, 'allTeacher'])->name('all-teachers');
        Route::get('teacher-detail/{username}', [AdminController::class, 'teacherDetail'])->name('admin-teacher-detail');
        Route::get('edit-teacher-profile/{username}', [AdminController::class, 'editTeacherProfile'])->name('edit-teacher-profile');
        Route::post('edit-teacher-profile/{username}', [AdminController::class, 'saveEditTeacherProfile'])->name('save-edit-teacher-profile');
    });

    Route::get('delete-student/{username}', [AdminController::class, 'deleteAccount'])->name('delete-account');
    Route::get('/detail', [AdminController::class, 'adminDetail'])->name('admin-detail');
    Route::get('/edit-profile',  [AdminController::class, 'editProfile'])->name('edit-profile');
    Route::post('/edit-profile',  [AdminController::class, 'saveEditProfile'])->name('save-edit-profile');
    Route::get('/reset-password', [AdminController::class, 'resetPassword'])->name('reset-admin-password');
    Route::post('/reset-password', [AdminController::class, 'savePassword'])->name('save-admin-password');
});

Route::middleware('student')->prefix('student')->group(function () {
    Route::get('/', [StudentController::class, 'index'])->name('student-index');
    Route::get('/detail', [StudentController::class, 'userDetail'])->name('student-detail');
    Route::get('/edit-profile', [StudentController::class, 'editUserProfile'])->name('edit-user-profile');
    Route::post('/edit-profile', [StudentController::class, 'saveEditUserProfile'])->name('save-edit-user-profile');
    Route::get('/reset-password', [StudentController::class, 'resetPassword'])->name('reset-student-password');
    Route::post('/reset-password', [StudentController::class, 'savePassword'])->name('save-student-password');

    Route::get('/classroom-detail/{ma_lop}', [StudentController::class, 'classroomDetail'])->name('classroom-student-detail');
    Route::get('/all-members/{ma_lop}', [StudentController::class, 'allMembers'])->name('classroom-student-all-members');
    Route::get('/delete-classroom/{ma_lop}', [StudentController::class, 'deleteClassroom'])->name('delete-classroom');
    Route::get('/join-classroom', [StudentController::class, 'joinClassroom'])->name('join-classroom');
    Route::post('/join-classroom', [StudentController::class, 'saveJoinClassroom'])->name('save-join-classroom');
    Route::get('/join-classroom-byEmail/{username}/{ma_lop}', [StudentController::class, 'joinClassroomByEmail'])->name('join-classroom-by-email');
    Route::get('/accept-join-classroom/{ma_lop}', [StudentController::class, 'acceptJoinClass'])->name('accept-join-class');
    Route::get('/delete-join-classroom/{ma_lop}', [StudentController::class, 'deleteJoinClass'])->name('delete-join-class');
});

Route::middleware('teacher')->prefix('teacher')->group(function () {
    Route::get('/', [TeacherController::class, 'index'])->name('teacher-index');
    Route::get('/detail', [TeacherController::class, 'userDetail'])->name('teacher-detail');
    Route::get('/edit-profile', [TeacherController::class, 'editUserProfile'])->name('edit-accteacher-profile');
    Route::post('/edit-profile', [TeacherController::class, 'saveEditUserProfile'])->name('save-edit-accteacher-profile');
    Route::get('/classroom-detail/{ma_lop}', [TeacherController::class, 'classroomDetail'])->name('classroom-teacher-detail');
    Route::get('/list-students/{ma_lop}', [TeacherController::class, 'listStudents'])->name('list-students');
    Route::post('/add-students/{ma_lop}', [TeacherController::class, 'addStudent'])->name('add-student');
    Route::get('/all-members/{ma_lop}', [TeacherController::class, 'allMembers'])->name('classroom-teacher-all-members');
    Route::get('/reset-password', [TeacherController::class, 'resetPassword'])->name('reset-teacher-password');
    Route::post('/reset-password', [TeacherController::class, 'savePassword'])->name('save-teacher-password');
    Route::get('/student-detail/{username}/{ma_lop}', [TeacherController::class, 'studentDetail'])->name('student-detail-class');
    Route::get('/delete-student/{username}/{ma_lop}', [TeacherController::class, 'deleteStudent'])->name('delete-student-class');
    Route::post('/send-email/{ma_lop}', [TeacherController::class, 'sendEmail'])->name('send-email-class');

    //Add Post
    Route::get('/classroom/add-post/{ma_lop}', [TeacherController::class, 'addPost'])->name('classroom-teacher-addPost');
    Route::post('/classroom/add-post/{ma_lop}', [TeacherController::class, 'addPost_POST'])->name('classroom-teacher-addPost_POST');
    //Add Exams
    Route::get('/classroom/add-exams/{ma_lop}', [TeacherController::class, 'addExams'])->name('classroom-teacher-addExams');
    Route::post('/classroom/add-exams/{ma_lop}', [TeacherController::class, 'addExams_POST'])->name('classroom-teacher-addExams_POST');
    //Add Exams
    Route::get('/classroom/add-worls/{ma_lop}', [TeacherController::class, 'addWorks'])->name('classroom-teacher-addWorks');
    Route::post('/classroom/add-worls/{ma_lop}', [TeacherController::class, 'addWorks_POST'])->name('classroom-teacher-addWorks_POST');

    //News (Bài Đăng)
    Route::get('/classroom/news/{ma_lop}', [TeacherController::class, 'news'])->name('classroom-teacher-news');
});
Route::get('auth/redirect/{provider}', [SocialController::class, 'redirect']);
Route::get('callback/{provider}', [SocialController::class, 'callback'])->name('call-back');
Route::get('create-password/{username}', [SocialController::class, 'createPassword'])->name('create-password');
Route::post('save-password/{username}', [SocialController::class, 'savePassword'])->name('save-password-api');
