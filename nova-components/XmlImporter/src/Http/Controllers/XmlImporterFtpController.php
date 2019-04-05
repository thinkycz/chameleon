<?php

namespace Nulisec\XmlImporter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;
use Nulisec\XmlImporter\Jobs\SyncXmlFromFtp;

class XmlImporterFtpController extends Controller
{
    public function settings(Request $request)
    {
        $settings = Setting::loadConfiguration('xml_importer_ftp_settings');

        return $this->ajaxWithPayload($settings);
    }

    public function saveConfiguration(Request $request)
    {
        Setting::saveConfiguration('xml_importer_ftp_settings', $request->only('ftp_host', 'ftp_username', 'ftp_password', 'ftp_filepath', 'run_daily'));

        return $this->ajaxWithPayload([]);
    }

    public function sync()
    {
        $this->dispatch(new SyncXmlFromFtp());

        return $this->ajaxWithPayload([]);
    }

    public function status()
    {
        $status = SyncStatus::get('xml_importer_ftp_status');
        $run_daily = Setting::fetch('xml_importer_ftp_settings', 'run_daily');

        return $this->ajaxWithPayload([
            'lastUpdate' => $status->lastUpdate(),
            'duration' => $status->duration(),
            'status' => $status->status(),
            'job' => $status->job(),
            'run_daily' => $run_daily
        ]);
    }
}