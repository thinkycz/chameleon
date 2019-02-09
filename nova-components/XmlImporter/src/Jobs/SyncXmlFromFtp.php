<?php

namespace Nulisec\XmlImporter\Jobs;

use App\Abstracts\SyncJob;
use Anchu\Ftp\Facades\Ftp;
use App\Models\Store;
use Config;
use Illuminate\Contracts\Queue\ShouldQueue;
use Storage;
use ZipArchive;

class SyncXmlFromFtp extends SyncJob implements ShouldQueue
{
    /**
     * @var string
     */
    public static $jobName = 'XML FTP Sync';

    /**
     * @var string
     */
    protected $statusCode = 'xml_importer_ftp_status';

    /**
     * @var string
     */
    protected $ftpconnection;

    /**
     * @var object
     */
    protected $settings;

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

        $this->settings = $this->store->loadDataObject('xml_importer_ftp_settings');
        $this->ftpconnection = $this->createConnection();
    }

    public function handle()
    {
        $this->prepare();

        $path = $this->download();

        if (!$path) throw new \Exception('Could not download XML file from FTP');

        dispatch(new ProcessXmlFile($path, $this->store, $this->resyncPhotos))->onConnection('sync');

        $this->logJobSucceeded();
    }

    public function failed()
    {
        $this->logJobFailed();
    }

    private function download()
    {
        $filename = basename($this->settings->ftp_filepath);
        $path = "xml_importer/{$this->store->id}";
        $extension = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

        if (!in_array($extension, ['xml', 'zip'])) return false;

        $destination = Storage::disk('local')->path("{$path}/{$filename}");

        Storage::disk('local')->createDir($path);
        if (!Ftp::connection($this->ftpconnection)->downloadFile($this->settings->ftp_filepath, $destination)) return false;

        if ($extension == 'zip') {
            $this->unzip($destination);
            foreach (Storage::disk('local')->files("{$path}/unzipped") as $file) {
                if (pathinfo($file, PATHINFO_EXTENSION) == 'xml') {
                    Storage::disk('local')->delete("{$path}/ftp.xml");
                    Storage::disk('local')->copy($file, "{$path}/ftp.xml");
                    Storage::disk('local')->deleteDir("{$path}/unzipped");
                    Storage::disk('local')->delete("{$path}/{$filename}");
                    break;
                }
            }
        } else {
            Storage::disk('local')->delete("{$path}/ftp.xml");
            Storage::disk('local')->move("{$path}/{$filename}", "{$path}/ftp.xml");
        }

        return Storage::disk('local')->path("{$path}/ftp.xml");
    }

    private function createConnection()
    {
        return tap("store.{$this->store->id}", function ($connection) {
            Config::set("ftp.connections.$connection", [
                'host'     => $this->settings->ftp_host,
                'username' => $this->settings->ftp_username,
                'password' => $this->settings->ftp_password,
                'passive'  => true
            ]);
        });
    }

    private function unzip($filePath)
    {
        return tap(pathinfo($filePath, PATHINFO_DIRNAME) . '/unzipped', function ($destination) use ($filePath) {
            $zip = new ZipArchive;

            if (!($zip->open($filePath) === true)) return false;

            $zip->extractTo($destination);

            return $zip->close();
        });
    }
}
