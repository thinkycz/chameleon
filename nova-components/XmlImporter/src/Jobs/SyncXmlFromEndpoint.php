<?php

namespace Nulisec\XmlImporter\Jobs;

use App\Abstracts\SyncJob;
use App\Models\Store;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;

class SyncXmlFromEndpoint extends SyncJob implements ShouldQueue
{
    /**
     * @var string
     */
    public static $jobName = 'XML Endpoint Sync';

    /**
     * @var string
     */
    protected $statusCode = 'xml_importer_endpoint_status';

    /**
     * @var object
     */
    protected $settings;

    /**
     * @var string
     */
    protected $endpoint;

    /**
     * @var bool
     */
    protected $resyncPhotos;

    public function __construct(Store $store, $resyncPhotos = false)
    {
        parent::__construct($store);

        $this->resyncPhotos = $resyncPhotos;
    }

    protected function prepare()
    {
        parent::prepare();

        $this->settings = $this->store->loadDataObject('xml_importer_endpoint_settings');
        $this->endpoint = $this->settings->endpoint_url;
    }

    public function handle()
    {
        $this->prepare();

        dispatch(new ProcessXmlFile($this->getFile(), $this->store, $this->resyncPhotos))->onConnection('sync');

        $this->logJobSucceeded();
    }

    public function failed()
    {
        $this->logJobFailed();
    }

    private function getFile()
    {
        $path = "xml_importer/{$this->store->id}";
        Storage::disk('local')->createDir($path);
        $file = Storage::disk('local')->path("{$path}/endpoint.xml");

        if (!$out = fopen($file, "wb")) {
            throw new \Exception('Error while writing a file.');
        }

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_FILE, $out);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_URL, $this->endpoint);
        curl_exec($ch);
        curl_close($ch);

        return $file;
    }
}
