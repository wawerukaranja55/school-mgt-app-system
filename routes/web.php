<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Exam_Controller;
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Pupil_Controller;
use App\Http\Controllers\Sign_up_Controller;
use App\Http\Controllers\Subject_Controller;
use App\Http\Controllers\Teachers_Controller;
use App\Http\Controllers\Manage_Documents_Controller;
use App\Http\Controllers\Exam_Results_Controller;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', [Sign_up_Controller::class, 'user_create_account'])->name('create_account');

Route::post('/sign-up', [Sign_up_Controller::class, 'user_sign_up'])->name('user.sign_up');

Route::post('/log_in', [Sign_up_Controller::class, 'user_log_in'])->name('user.log_in');

Route::post('/log_out', [Sign_up_Controller::class, 'user_log_out'])->name('user.log_out');

Route::post('/forgot_password',[Sign_up_Controller::class,'user_forgot_password'])->name('user.forgotpassword');

// Admin Routes
Route::group(['prefix'=>'admin','middleware'=>(['auth'])],function(){
    Route::get('/dashboard', [Admin_Controller::class, 'admin_dashboard'])->name('admin.dashboard');

    Route::get('/add_pupil', [Pupil_Controller::class, 'create_new_pupil_page'])->name('admin.create.pupil.page');

    Route::post('/store_pupil', [Pupil_Controller::class, 'create_new_pupil'])->name('admin.store.pupil');

    Route::get('/all_pupils', [Pupil_Controller::class, 'all_pupils_page'])->name('admin.pupils.page');

    Route::get('/get_all_pupils', [Pupil_Controller::class, 'get_pupils'])->name('admin.get_all_pupils');

    Route::get('/all_teachers', [Teachers_Controller::class, 'all_teachers_page'])->name('admin.teachers.page');

    Route::get('/get_all_teachers', [Teachers_Controller::class, 'get_teachers'])->name('admin.get_all_teachers');

    Route::get('get-teacher-class/{id}',[Teachers_Controller::class,'get_teacher_class'])->name('admin.get_teacher_class');

    Route::post('assign-teacher-class/{id}',[Teachers_Controller::class,'assign_class'])->name('admin.assign-class');

    // create subject for each grade
    Route::get('/add_subject', [Subject_Controller::class, 'create_new_subject_page'])->name('admin.create.subject.page');

    Route::post('/store_subject', [Subject_Controller::class, 'create_new_subject'])->name('admin.store.subject');

    Route::get('/all_subjects', [Subject_Controller::class, 'all_subjects_page'])->name('admin.subjects.page');

    Route::get('/get_all_subjects', [Subject_Controller::class, 'all_subjects'])->name('admin.get_all_subjects');

    // manage exams
    Route::get('/add_exam', [Exam_Controller::class, 'create_new_exam_page'])->name('admin.create.exam.page');

    Route::post('/store_exam', [Exam_Controller::class, 'create_new_exam'])->name('admin.store.exam');

    Route::get('/all_exams', [Exam_Controller::class, 'all_exams_page'])->name('admin.exams.page');

    Route::get('/get_all_exams', [Exam_Controller::class, 'all_exams'])->name('admin.get_all_exams');

    // manage exam results 
    Route::get('/add_exam_results', [Exam_Results_Controller::class, 'create_exams_results_page'])->name('admin.create.exams.page');

    Route::get('/find_class_exam', [Exam_Results_Controller::class, 'find_class'])->name('admin.find.class.exam');

    Route::post('/store_results', [Exam_Results_Controller::class, 'create_results'])->name('admin.store.results');

    Route::get('/all_results', [Exam_Results_Controller::class, 'all_results_page'])->name('admin.results.page');

    Route::get('/get_all_results', [Exam_Results_Controller::class, 'all_results'])->name('admin.get_all_exam_results');

    Route::get('view_pupil_results/{id}/{exam_id}', [Manage_Documents_Controller::class,'view_pupil_results'])->name('view_pupil_results.report');

    Route::get('download_pupil_results/{id}/{exam_id}', [Manage_Documents_Controller::class,'generate_pupil_results_pdf'])->name('download_pupil_results.pdf');

    Route::get('get_pupil_results/{id}/edit', [Exam_Results_Controller::class, 'get_pupil_results'])->name('admin.get_pupil_results');
});

