<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SubAdminSocietyController;
use App\Http\Controllers\SocietyController;
use App\Http\Controllers\ResidentController;
use App\Http\Controllers\GateKeeperController;
use App\Http\Controllers\NoticeBoardController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PreApproveEntryController;
use App\Http\Controllers\PhaseController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\StreetController;
use App\Http\Controllers\HouseController;









Route::middleware(['auth:sanctum'])->group(function () {

  // Society

  Route::post('society/addsociety', [SocietyController::class, 'addsociety']);
  Route::put('society/updatesociety', [SocietyController::class, 'updatesociety']);
  Route::get('society/viewallsocieties/{userid}', [SocietyController::class, 'viewallsocieties']);

  Route::get('society/deletesociety/{id}', [SocietyController::class, 'deletesociety']);

  Route::get('society/viewsociety/{societyid}', [SocietyController::class, 'viewsociety']);
  Route::get('society/searchsociety/{q?}', [SocietyController::class, 'searchsociety']);
  Route::get('society/filtersocietybuilding/{id}/{q?}', [SocietyController::class, 'filtersocietybuilding']);
  Route::get('society/viewsocietiesforresidents', [SocietyController::class, 'viewsocietiesforresidents']);





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


  //Residents Reort To Admin
  Route::post('reporttoadmin', [ReportController::class, 'reporttoadmin']);
  Route::post('updatereportstatus', [ReportController::class, 'updatereportstatus']);
  Route::get('deletereport/{id}', [ReportController::class, 'deletereport']);
  Route::get('reportedresidents', [ReportController::class, 'reportedresidents']);


  //Events
  Route::post('event/addevent', [EventController::class, 'addevent']);
  Route::post('event/addeventimages', [EventController::class, 'addeventimages']);
  Route::post('event/updateevent', [EventController::class, 'updateevent']);
  Route::get('event/events/{userid}', [EventController::class, 'events']);
  Route::get('event/deleteevent/{id}', [EventController::class, 'deleteevent']);


  // Reports
  Route::post('reporttoadmin', [ReportController::class, 'reporttoadmin']);
  Route::get('adminreports/{residentid}', [ReportController::class, 'adminreports']);
  Route::post('updatereportstatus', [ReportController::class, 'updatereportstatus']);
  Route::get('deletereport/{id}', [ReportController::class, 'deletereport']);
  Route::get('reportedresidents/{subadminid}', [ReportController::class, 'reportedresidents']);

  Route::get('reports/{subadminid}/{userid}', [ReportController::class, 'reports']);

  Route::get('pendingreports/{subadminid}', [ReportController::class, 'pendingreports']);
  Route::get('historyreportedresidents/{subadminid}', [ReportController::class, 'historyreportedresidents']);
  Route::get('historyreports/{subadminid}/{userid}', [ReportController::class, 'historyreports']);


  // Preapproveentry
  Route::get('getgatekeepers/{subadminid}', [PreApproveEntryController::class, 'getgatekeepers']);
  Route::get('getvisitorstypes', [PreApproveEntryController::class, 'getvisitorstypes']);
  Route::post('addvisitorstypes', [PreApproveEntryController::class, 'addvisitorstypes']);
  Route::post('addpreapproventry', [PreApproveEntryController::class, 'addpreapproventry']);
  Route::post('updatepreapproveentrystatus', [PreApproveEntryController::class, 'updatepreapproveentrystatus']);
  Route::get('viewpreapproveentryreports/{userid}', [PreApproveEntryController::class, 'viewpreapproveentryreports']);
  Route::get('preapproveentryresidents/{userid}', [PreApproveEntryController::class, 'preapproveentryresidents']);
  Route::get('preapproventrynotifications/{userid}', [PreApproveEntryController::class, 'preapproventrynotifications']);
  Route::get('preapproveentries/{userid}', [PreApproveEntryController::class, 'preapproveentries']);


  // Phases
  Route::post('addphases', [PhaseController::class, 'addphases']);
  Route::get('phases/{subadminid}', [PhaseController::class, 'phases']);

  Route::get('distinctphases/{subadminid}', [PhaseController::class, 'distinctphases']);
  Route::get('viewphasesforresidents/{societyid}', [PhaseController::class, 'viewphasesforresidents']);


  

  // Blocks
  Route::post('addblocks', [BlockController::class, 'addblocks']);
  Route::get('blocks/{pid}', [BlockController::class, 'blocks']);
  Route::get('distinctblocks/{bid}', [BlockController::class, 'distinctblocks']);
  Route::get('viewblocksforresidents/{phaseid}', [BlockController::class, 'viewblocksforresidents']);
  


  // Streets
  Route::post('addstreets', [StreetController::class, 'addstreets']);
  Route::get('streets/{bid}', [StreetController::class, 'streets']);
  Route::get('viewstreetsforresidents/{blockid}', [StreetController::class, 'viewstreetsforresidents']);
  

  

  // Houses
  Route::post('addhouses', [HouseController::class, 'addhouses']);
  Route::get('viewhousesforresidents/{streetid}', [HouseController::class, 'viewhousesforresidents']);
  
  
});




// Authentications

Route::post('login', [RoleController::class, 'login']);
Route::post('register', [RoleController::class, 'register']);
