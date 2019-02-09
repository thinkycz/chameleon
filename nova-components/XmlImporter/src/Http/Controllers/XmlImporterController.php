<?php

namespace Nulisec\XmlImporter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessXmlFile;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;

class XmlImporterController extends Controller
{
    protected $fields = [
        'name',
        'description',
        'details',
        'catalogue_number',
        'barcode',
        'quantity_in_stock',
        'minimum_order_quantity',
        'vatrate',
        'price',
        'category',
        'unit',
        'photo',
    ];

    public function settings(Request $request)
    {
        $config = Setting::loadConfiguration('xml_importer');
        $settings = Setting::loadConfiguration('xml_importer_settings');

        return $this->ajaxWithPayload(compact('config', 'settings'));
    }

    public function saveConfiguration(Request $request)
    {
        Setting::saveConfiguration('xml_importer', $this->generateConfig($request), '', 'object');
        Setting::saveConfiguration('xml_importer_settings', $request->only('tag_name', 'tag_depth', 'identifier', 'price_multiplier'));

        return $this->ajaxWithPayload([]);
    }

    private function generateConfig(Request $request)
    {
        $result = [];

        foreach ($this->fields as $field) {
            $result = array_merge($result, [
                $field => $request->get("{$field}_static") ? $request->get($field) : ['uses' => $request->get($field)],
            ]);
        }

        return $result;
    }

    public function sync()
    {
        $this->dispatch(new ProcessXmlFile());

        return $this->ajaxWithPayload([]);
    }

    public function status()
    {
        $status = SyncStatus::get('xml_importer_status');

        return $this->ajaxWithPayload([
            'lastUpdate' => $status->lastUpdate(),
            'duration' => $status->duration(),
            'status' => $status->status(),
            'job' => $status->job()
        ]);
    }
}