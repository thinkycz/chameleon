<?php

namespace Nulisec\JetsoftShopconnector\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\SyncStatus;
use Illuminate\Http\Request;
use Nulisec\JetsoftShopconnector\Jobs\SyncronizeProducts;

class ShopconnectorController extends Controller
{
    public function settings()
    {
        $settings = Setting::loadConfiguration('shopconnector');

        return $this->ajaxWithPayload($settings);
    }

    public function saveConfiguration(Request $request)
    {
        Setting::saveConfiguration('shopconnector', $request->only('eshopname', 'identifier', 'host', 'port', 'database', 'username', 'password'), 'jetsoft-shopconnector');

        return $this->ajaxWithPayload([]);
    }

    public function sync()
    {
        $this->dispatch(new SyncronizeProducts());

        return $this->ajaxWithPayload([]);
    }

    public function status()
    {
        $status = SyncStatus::get('shopconnector_status');

        return $this->ajaxWithPayload([
            'lastUpdate' => $status->lastUpdate(),
            'duration' => $status->duration(),
            'status' => $status->status()
        ]);
    }
}
