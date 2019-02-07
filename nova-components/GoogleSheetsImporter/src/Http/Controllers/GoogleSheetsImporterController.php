<?php

namespace Nulisec\GoogleSheetsImporter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Nulisec\GoogleSheetsImporter\Jobs\SyncFromGoogleSheets;

class GoogleSheetsImporterController extends Controller
{
    public function settings(Request $request)
    {
        $settings = Setting::loadConfiguration('google_sheets_importer');

        return $this->ajaxWithPayload($settings);
    }

    public function saveConfiguration(Request $request)
    {
        Setting::saveConfiguration('google_sheets_importer', $request->only('link', 'identifier'));

        return $this->ajaxWithPayload([]);
    }

    public function sync()
    {
        Validator::make(Setting::loadConfiguration('google_sheets_importer') ?? [], [
            'link'       => 'required',
            'identifier' => 'required',
        ])->validate();

        $this->dispatch(new SyncFromGoogleSheets());

        return $this->ajaxWithPayload([]);
    }

    public function status()
    {
        $status = SyncStatus::get('google_sheets_status');

        return $this->ajaxWithPayload([
            'lastUpdate' => $status->lastUpdate(),
            'duration' => $status->duration(),
            'status' => $status->status()
        ]);
    }
}
