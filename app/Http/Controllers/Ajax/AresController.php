<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Services\AresFetcher;
use Illuminate\Http\Request;

class AresController extends Controller
{
    /**
     * @var AresFetcher
     */
    private $fetcher;

    public function __construct(AresFetcher $fetcher)
    {
        $this->fetcher = $fetcher;
    }

    public function get(Request $request)
    {
        return $this->fetcher->fetch($request->get('company_id'));
    }
}
