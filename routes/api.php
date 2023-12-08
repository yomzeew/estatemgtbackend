<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TenantUserController;
use App\Http\Controllers\ClientUserController;
use App\Http\Controllers\PropertyController;
use App\Http\Controllers\Propertytotenant;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/addtenant', [TenantUserController::class, 'insertuser']);
Route::post('/selectuser',[TenantUserController::class, 'selectuser'] );
Route::post('/loginuser', [TenantUserController::class, 'loginuser']);
Route::put('/updateuser/{mobileno}',[TenantUserController::class, 'updateuser']);
Route::get('/selectall', [TenantUserController::class, 'selectall']);
Route::delete('/delectuser/{id}',[TenantUserController::class, 'deleteuser']);
Route::post('/forgotpassword',[TenantUserController::class, 'forgotpasscode']);
Route::post('/verifyotp',[TenantUserController::class, 'verifyotp']);
Route::post('/updatepass',[TenantUserController::class, 'updatepass']);

//
Route::post('/addclient', [ClientUserController::class, 'insertclient']);
Route::post('/selectclient',[ClientUserController::class, 'selectclient'] );
Route::post('/loginclient', [ClientUserController::class, 'loginclient']);
Route::put('/updateclient/{mobileno}',[ClientUserController::class, 'updateclient']);
Route::get('/selectallclient', [ClientUserController::class, 'selectallclient']);
Route::delete('/delectclient/{id}',[ClientUserController::class, 'deleteclient']);
Route::post('/forgotpasswordclient',[ClientUserController::class, 'forgotpassclient']);
Route::post('/verifyotpclient',[ClientUserController::class, 'verifyotpclient']);
Route::post('/updatepassclient',[ClientUserController::class, 'updatepassclient']);

Route::post('/addproperty',[PropertyController::class, 'insertproperty']);
Route::post('/selectproperty',[PropertyController::class, 'selectproperty'] );
Route::put('/updateproperty/{id}',[PropertyController::class, 'updateproperty']);
Route::delete('/deleteproperty', [PropertyController::class, 'deleteproperty']);




Route::post('/addrent',[Propertytotenant::class, 'insertrent']);
Route::post('/selectrent',[Propertytotenant::class, 'selectrent'] );
Route::put('/updaterent/{id}',[Propertytotenant::class, 'updaterent']);
Route::delete('/deleterent', [Propertytotenant::class, 'deleterent']);
