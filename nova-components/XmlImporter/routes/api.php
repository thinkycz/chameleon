<?php

use Illuminate\Support\Facades\Route;
use Nulisec\XmlImporter\Http\Controllers\XmlImporterController;
use Nulisec\XmlImporter\Http\Controllers\XmlImporterEndpointController;
use Nulisec\XmlImporter\Http\Controllers\XmlImporterFtpController;

/*
|--------------------------------------------------------------------------
| Tool API Routes
|--------------------------------------------------------------------------
|
| Here is where you may register API routes for your tool. These routes
| are loaded by the ServiceProvider of your tool. They are protected
| by your tool's "Authorize" middleware by default. Now, go build!
|
*/

Route::get('settings', [XmlImporterController::class, 'settings']);
Route::get('status', [XmlImporterController::class, 'status']);
Route::post('save-configuration', [XmlImporterController::class, 'saveConfiguration']);
Route::post('sync', [XmlImporterController::class, 'sync']);
Route::post('validate-parser', [XmlImporterController::class, 'validateParser']);

Route::get('ftp/settings', [XmlImporterFtpController::class, 'settings']);
Route::get('ftp/status', [XmlImporterFtpController::class, 'status']);
Route::post('ftp/save-configuration', [XmlImporterFtpController::class, 'saveConfiguration']);
Route::post('ftp/sync', [XmlImporterFtpController::class, 'sync']);

Route::get('endpoint/settings', [XmlImporterEndpointController::class, 'settings']);
Route::get('endpoint/status', [XmlImporterEndpointController::class, 'status']);
Route::post('endpoint/save-configuration', [XmlImporterEndpointController::class, 'saveConfiguration']);
Route::post('endpoint/sync', [XmlImporterEndpointController::class, 'sync']);
