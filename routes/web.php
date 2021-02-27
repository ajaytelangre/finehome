<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;


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
});

Route::post('/services',[AdminController ::class,'services']);
Route::get('/service_list',[AdminController ::class,'service_list']);
Route::get('/test1',[UserController::class,'test']);
Route::get('/logout1',[UserController::class,'logout']);
Route::view('/add_services','AddServices');
Route::post('/upload',[AdminController ::class,'upload']);

Route::post('/login1',[UserController::class,'login']);
Route::post('/service_type',[UserController::class,'service_type']);
Route::post('/otp',[UserController::class,'otp']);
Auth::routes();

Route::view('/image1','image1');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/delete_service/{id}',[AdminController ::class,'delete_service']);
Route::get('/edit_service/{id}',[AdminController ::class,'edit_service']);
Route::get('/sub_service/{id}',[AdminController ::class,'sub_service']);
Route::post('/add_sub_service',[AdminController ::class,'add_sub_service']);
Route::get('/sub_service_type/{id}/{service_id}',[AdminController ::class,'sub_service_type']);
Route::post('add_sub_service_type',[AdminController ::class,'add_sub_service_type']);
Route::post('/edit_service',[AdminController ::class,'edit_service_info']);
Route::post('/update_sub_service',[AdminController::class,'update_sub_service']);
Route::post('/delete_sub_service',[AdminController::class,'delete_sub_service']);
Route::post('/update_sub_service_type',[AdminController::class,'update_sub_service_type']);
Route::get('/delete_service_type/{id}',[AdminController::class,'delete_service_type']);
Route::get('/booking_incomplete',[AdminController::class,'booking_incomplete']);
Route::post('/getmsg',[AdminController::class,'getmsg']);
Route::get('/booking_complete',[AdminController::class,'booking_complete']);
Route::get('/booking_reasigne',[AdminController::class,'booking_reasigne']);
Route::get('/partner_list',[AdminController::class,'partner_list']);
Route::get('/delete_partner/{id}',[AdminController::class,'delete_partner']);
Route::post('/edit_partner',[AdminController::class,'edit_partner']);
Route::get('/user_list',[AdminController::class,'user_list']);
Route::get('/ui',[AdminController::class,'ui']);
Route::get('/job_history',[AdminController::class,'job_history']);
Route::get('/view_history/{id}',[AdminController::class,'view_history']);
Route::get('/ui-form',[AdminController::class,'ui_form']);
Route::post('/upload_slider',[AdminController::class,'upload_slider']);
Route::get('/remove_slider/{id}',[AdminController::class,'remove_slider']);

