<?php

use Illuminate\Support\Facades\Route;
use Nulisec\GoogleSheetsImporter\Http\Controllers\GoogleSheetsImporterController;

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

Route::get('/settings', [GoogleSheetsImporterController::class, 'settings']);
Route::post('/save-configuration', [GoogleSheetsImporterController::class, 'saveConfiguration']);
Route::post('/sync', [GoogleSheetsImporterController::class, 'sync']);
