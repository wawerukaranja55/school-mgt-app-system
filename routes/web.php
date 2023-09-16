<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sign_up_Controller;
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Pupil_Controller;
use App\Http\Controllers\Teachers_Controller;

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
});

