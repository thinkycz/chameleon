<?php

use Illuminate\Support\Facades\Route;
use Nulisec\XmlImporter\Http\Controllers\XmlImporterController;

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
