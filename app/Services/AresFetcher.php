<?php

namespace App\Services;

use GuzzleHttp\Client;
use Nulisec\XmlParser\Reader;

class AresFetcher
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var Reader
     */
    private $reader;

    public function __construct(Client $client, Reader $reader)
    {
        $this->client = $client;
        $this->reader = $reader;
    }

    public function fetch($companyId)
    {
        $file = $this->client->get("http://wwwinfo.mfcr.cz/cgi-bin/ares/darv_bas.cgi?ico={$companyId}");

        $content = $file->getBody()->getContents();

        return $this->reader->extract($content)->namespaces('are', 'D')->rebase('VBAS')->parse([
            'company_name' => ['uses' => 'OF'],
            'company_id'   => ['uses' => 'ICO'],
            'vat_id'       => ['uses' => 'DIC'],
            'street'       => ['uses' => ['AA.NU', 'AA.CD', 'AA.CO']],
            'city'         => ['uses' => 'AA.N'],
            'zipcode'      => ['uses' => 'AA.PSC'],
        ]);
    }
}
