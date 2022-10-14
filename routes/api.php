<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubAdminSocietyController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\GateKeeperController;
use App\Http\Controllers\NoticeBoardController;

Route::middleware(['auth:sanctum'])->group(function () {

  // Society

  Route::post('society/addsociety', [SocietyController::class, 'addsociety']);
  Route::put('society/updatesociety', [SocietyController::class, 'updatesociety']);
  Route::get('society/viewallsocieties/{userid}', [SocietyController::class, 'viewallsocieties']);
  Route::get('society/deletesociety/{id}', [SocietyController::class, 'deletesociety']);

  Route::get('society/viewsociety/{societyid}', [SocietyController::class, 'viewsociety']);
  Route::get('society/searchsociety/{q?}', [SocietyController::class, 'searchsociety']);


  //User
  Route::post('logout', [RoleController::class, 'logout']);
  Route::get('allusers', [RoleController::class, 'allusers']);

  // SubAdminSocieties
  Route::post('registersubadmin', [SubAdminSocietyController::class, 'registersubadmin']);
  Route::get('viewsubadmin/{id}', [SubAdminSocietyController::class, 'viewsubadmin']);


  Route::get('deletesubadmin/{id}', [SubAdminSocietyController::class, 'deletesubadmin']);
  Route::post('updatesubadmin', [SubAdminSocietyController::class, 'updatesubadmin']);

  // Residents

  Route::post('registerresident', [ResidentController::class, 'registerresident']);

  Route::get('viewresidents/{id}', [ResidentController::class, 'viewresidents']);

  Route::get('deleteresident/{id}', [ResidentController::class, 'deleteresident']);

  Route::post('updateresident', [ResidentController::class, 'updateresident']);



  // GateKeeper

  Route::post('registergatekeeper', [GateKeeperController::class, 'registergatekeeper']);
  Route::get('viewgatekeepers/{id}', [GateKeeperController::class, 'viewgatekeepers']);
  Route::get('deletegatekeeper/{id}', [GateKeeperController::class, 'deletegatekeeper']);
  Route::post('updategatekeeper', [GateKeeperController::class, 'updategatekeeper']);


  //Notice Board

  Route::post('addnoticeboarddetail', [NoticeBoardController::class, 'addnoticeboarddetail']);
  Route::get('viewallnotices/{id}', [NoticeBoardController::class, 'viewallnotices']);
  Route::get('deletenotice/{id}', [NoticeBoardController::class, 'deletenotice']);
  Route::post('updatenotice', [NoticeBoardController::class, 'updatenotice']);
  
});




// Authentications

Route::post('login', [RoleController::class, 'login']);
Route::post('register', [RoleController::class, 'register']);
