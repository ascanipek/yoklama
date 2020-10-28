<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard;

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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/', function () {
//     return view('auth.login');
// });
Route::get('/', [App\Http\Controllers\Dashboard::class, 'index'])->name('home');

Route::get('/yoklama', [App\Http\Controllers\Dashboard::class, 'frontEnd'])->name('home')->middleware('auth');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/dashboard', [App\Http\Controllers\Dashboard::class, 'index'])->middleware('auth');
Route::get('adminpanel/get-date-base',[App\Http\Controllers\Dashboard::class, 'getDateBase'])->name('getDateBase')->middleware('auth');
Route::get('adminpanel/get-lesson-base',[App\Http\Controllers\Dashboard::class, 'getLessonBase'])->name('getLessonBase')->middleware('auth');
Route::get('/adminpanel', [App\Http\Controllers\Dashboard::class, 'admin'])->middleware('auth');


Route::get('/admin/add-class', [App\Http\Controllers\Dashboard::class, 'classes'])->middleware('auth');
Route::post('adminpanel/add-class',[App\Http\Controllers\Dashboard::class, 'addClass'])->name('addClass')->middleware('auth');
Route::post('adminpanel/del-class',[App\Http\Controllers\Dashboard::class, 'delClass'])->name('delClass')->middleware('auth');
Route::get('adminpanel/fetch-class',[App\Http\Controllers\Dashboard::class, 'fetchClass'])->name('fetchClass')->middleware('auth');

Route::get('/admin/add-student', [App\Http\Controllers\Dashboard::class, 'addStudent'])->middleware('auth');
Route::get('adminpanel/fetch-students',[App\Http\Controllers\Dashboard::class, 'fetchStudents'])->name('fetchStudents')->middleware('auth');
Route::post('/admin/save-student', [App\Http\Controllers\Dashboard::class, 'saveStudents'])->name('saveStudents')->middleware('auth');
Route::post('adminpanel/del-student',[App\Http\Controllers\Dashboard::class, 'delStudent'])->name('delStudent')->middleware('auth');

Route::get('/admin/add-teacher', [App\Http\Controllers\Dashboard::class, 'teachers'])->middleware('auth');
Route::post('adminpanel/save-teacher',[App\Http\Controllers\Dashboard::class, 'addTeacher'])->name('addTeacher')->middleware('auth');
Route::post('adminpanel/del-teacher',[App\Http\Controllers\Dashboard::class, 'delTeacher'])->name('delTeacher')->middleware('auth');
Route::get('adminpanel/fetch-teacher',[App\Http\Controllers\Dashboard::class, 'fetchTeachers'])->name('fetchTeachers')->middleware('auth');
Route::post('adminpanel/update-teacher',[App\Http\Controllers\Dashboard::class, 'updateTeacher'])->name('updateTeacher')->middleware('auth');

Route::get('/admin/lessons', [App\Http\Controllers\Dashboard::class, 'lessons'])->middleware('auth');
Route::post('adminpanel/add-lesson',[App\Http\Controllers\Dashboard::class, 'addLesson'])->name('addLesson')->middleware('auth');
Route::post('adminpanel/del-lesson',[App\Http\Controllers\Dashboard::class, 'delLesson'])->name('delLesson')->middleware('auth');
Route::get('adminpanel/fetch-lessons',[App\Http\Controllers\Dashboard::class, 'fetchLessons'])->name('fetchLessons')->middleware('auth');
Route::post('adminpanel/update-lesson',[App\Http\Controllers\Dashboard::class, 'updateLesson'])->name('updateLesson')->middleware('auth');

Route::get('/admin/set-lesson', [App\Http\Controllers\Dashboard::class, 'assign'])->middleware('auth');
Route::post('adminpanel/assign-lesson',[App\Http\Controllers\Dashboard::class, 'addAssign'])->name('addAssign')->middleware('auth');
Route::post('adminpanel/del-assign',[App\Http\Controllers\Dashboard::class, 'delAssign'])->name('delAssign')->middleware('auth');
Route::get('adminpanel/fetch-assign',[App\Http\Controllers\Dashboard::class, 'fetchAssign'])->name('fetchAssign')->middleware('auth');
Route::post('adminpanel/update-assign',[App\Http\Controllers\Dashboard::class, 'updateAssign'])->name('updateAssign')->middleware('auth');

Route::post('/set-rollcall',[App\Http\Controllers\Dashboard::class, 'setRollCall'])->name('setRollCall')->middleware('auth');
