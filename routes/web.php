<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\Auth\Reg_SuccessControlller;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\DistrictController;



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
    return view('welcome');
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/logout',[HomeController::class,'Logout']);

// ============================= Division ======================================
Route::get('division_datatable', [App\Http\Controllers\Admin\DivisionController::class,'index']);
Route::post('store-division', [App\Http\Controllers\Admin\DivisionController::class,'store']);
Route::post('edit-division', [App\Http\Controllers\Admin\DivisionController::class,'edit']);
Route::post('delete-division', [App\Http\Controllers\Admin\DivisionController::class,'destroy']);
Route::get('view-division',  [App\Http\Controllers\Admin\DivisionController::class,'view']);

// ============================= Distric ======================================
Route::get('district_datatable', [App\Http\Controllers\Admin\DistrictController::class,'index']);
Route::post('store-distric', [App\Http\Controllers\Admin\DistrictController::class,'store']);
Route::post('edit-distric', [App\Http\Controllers\Admin\DistrictController::class,'edit']);
Route::post('delete-district', [App\Http\Controllers\Admin\DistrictController::class,'destroy']);
Route::get('view-distric', [App\Http\Controllers\Admin\DistrictController::class,'view']);

// API routes
Route::get('get-districts/{id}', function($id){
    return json_encode(App\Models\District::where('division_id', $id)->get());
});

// ============================= Multiple Authentication ======================================
Route::group(['prefix'=>'admin','middleware'=>['admin','auth'],'namespace'=>'admin'],function(){
    Route::get('dashboard',[App\Http\Controllers\Admin\AdminController::class,'index'])->name('admin.dashboard');
});
Route::get('/logout',[AdminController::class,'Logout']);

Route::group(['prefix'=>'doctor','middleware'=>['doctor','auth'],'namespace'=>'doctor'],function(){
    Route::get('dashboard',[App\Http\Controllers\Doctor\DoctorController::class,'index'])->name('doctor.dashboard');
});
Route::group(['prefix'=>'patient','middleware'=>['patient','auth'],'namespace'=>'patient'],function(){
    Route::get('dashboard',[App\Http\Controllers\Patient\PatientController::class,'index'])->name('patient.dashboard');
});

// User Routes
Route::get('user/token/{token}', [VerificationController::class,'verify'])->name('user.verification');
// Registration Success Message

Route::get('registration/verify/check',[Reg_SuccessControlller::class,'index'])->name('verification');

