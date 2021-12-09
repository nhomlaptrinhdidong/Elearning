<?php

use App\Http\Controllers\GiangVienController;
use App\Http\Controllers\KhoaController;

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
Route::get('/', function () {
    return view('login');
})->name('login');




Route::get('/admin', function () {
    return view('admin/index');
})->name('admin-index');








Route::get('/admin/all-students', function () {
    return view('admin/students/all-students');
})->name('all-students');
Route::get('/student-detail', function () {
    return view('admin/students/student-detail');
})->name('student-detail');
Route::get('/add-student', function () {
    return view('admin/students/add-student');
})->name('add-student');
Route::get('/search-student', function () {
    return view('admin/students/search-student');
})->name('search-student');


