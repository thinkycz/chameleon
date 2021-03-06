<?php

namespace Nulisec\XmlImporter\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;
use Nulisec\XmlImporter\Jobs\ProcessXmlFile;
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

    public function sync(Request $request)
    {
        $request->validate([
            'xmlfile' => 'required|file'
        ]);

        $filePath = Storage::disk('local')->putFileAs("xml_importer", $request->file('xmlfile'), 'uploaded.xml');
        $filePath = Storage::disk('local')->path($filePath);

        $jobId = $this->dispatch(new ProcessXmlFile($filePath));

        SyncStatus::log('xml_importer_status', $jobId);

        return $this->ajaxWithPayload([]);
    }

    public function validateParser(Request $request)
    {
        $request->validate([
            'xmlfile' => 'required|file'
        ]);

        $filePath = Storage::disk('local')->putFileAs("xml_importer", $request->file('xmlfile'), 'uploaded.xml');
        $filePath = Storage::disk('local')->path($filePath);

        $config = Setting::loadConfiguration('xml_importer');
        $settings = Setting::loadConfiguration('xml_importer_settings');

        $streamer = XmlStringStreamer::createStringWalkerParser($filePath, ['captureDepth' => intval($settings['tag_depth']), 'expectGT' => true]);
        $product = $json = null;

        while ($node = $streamer->getNode()) {
            if (XmlProductProcessor::validateElement($node, $settings['tag_name'])) {
                $raw = XmlProductProcessor::convertToUtf8(XmlProductProcessor::detectFileEncoding($filePath), $node);
                $json = json_encode(simplexml_load_string($raw), JSON_PRETTY_PRINT);
                $product = XmlProductProcessor::processNode($raw, $config);
                break;
            }
        }

        return $this->ajaxWithPayload(compact('product', 'json'));
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
}