<?php

namespace Nulisec\XmlImporter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessXmlFile;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;
use Nulisec\XmlImporter\Services\XmlProductProcessor;
use Prewk\XmlStringStreamer;
use Storage;

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

    public function validateParser(Request $request)
    {
        $filePath = Storage::disk('local')->putFileAs("xml_importer", $request->file('xmlfile'), 'uploaded.xml');
        $filePath = Storage::disk('local')->path($filePath);

        $config = Setting::loadConfiguration('xml_importer');
        $settings = Setting::loadConfiguration('xml_importer_settings');

        $streamer = XmlStringStreamer::createStringWalkerParser($filePath, ['captureDepth' => intval($settings['tag_depth']), 'expectGT' => true]);
        $product = null;

        while ($node = $streamer->getNode()) {
            if (XmlProductProcessor::validateElement($node, $settings['tag_name'])) {
                $product = (object) XmlProductProcessor::processNode(XmlProductProcessor::convertToUtf8(XmlProductProcessor::detectFileEncoding($filePath), $node), $config);
                break;
            }
        }

        return $this->ajaxWithPayload(compact('product'));
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