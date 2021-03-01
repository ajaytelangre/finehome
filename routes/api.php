<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PartnerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/testing_sub_service',[UserController::class,'testing_sub_service']);
Route::post('/service_type',[UserController::class,'service_type']);
Route::post('/sub_services_type',[UserController::class,'sub_service_data']);
Route::get('/test',[UserController::class,'test']);
Route::post('/login1',[UserController::class,'login']);
Route::post('/otp',[UserController::class,'otp']);
Route::post('/test',[UserController::class,'test']);
Route::post('/services',[AdminController ::class,'services']);


Route::post('/new_login',[UserController::class,'new_login']);

Route::post('/lead',[AdminController::class,'get_leads']);
Route::post('/partner_login',[PartnerController::class,'partner_login']);
Route::post('/partner_detail',[PartnerController::class,'partner_detail']);
Route::post('/work_list',[PartnerController::class,'work_list']);
Route::post('/upload_identity',[PartnerController::class,'upload_identity']);
Route::post('/partner_lead',[PartnerController::class,'partner_lead']);

Route::post('/bank_details',[PartnerController::class,'bank_details']);
Route::post('/partner_img',[PartnerController::class,'partner_img']);
Route::post('/partner_lead_details',[PartnerController::class,'partner_lead_details']);

Route::post('/partner_lead_complete',[PartnerController::class,'partner_lead_complete']);
Route::post('/partner_lead_update',[PartnerController::class,'partner_lead_update']);
Route::post('/partner_lead_reassign',[PartnerController::class,'partner_lead_reassign']);
Route::post('/reaasign_lead',[PartnerController::class,'reaasign_lead']);
Route::post('/booking_incomplete',[UserController::class,'booking_incomplete']);
Route::post('/accept_lead',[PartnerController::class,'accept_lead']);
Route::post('/booking_complete',[UserController::class,'booking_complete']);
Route::post('/cancel_booking',[UserController::class,'cancel_booking']);
Route::post('/partner_lead_accepted',[PartnerController::class,'partner_lead_accepted']);
Route::post('/reassign_request',[UserController::class,'reassign_request']);
Route::post('/partner_info',[PartnerController::class,'partner_info']);
Route::get('/incomplete',[AdminController::class,'booking_incomplete']);
Route::post('/slider',[AdminController::class,'slider']);
Route::post('/offer_img',[AdminController::class,'offer_img']);