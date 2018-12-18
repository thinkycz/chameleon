<?php

namespace Nulisec\JetsoftShopconnector\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class ShopconnectorController extends Controller
{
    public function saveConfiguration(Request $request)
    {
        Setting::saveConfiguration('shopconnector', $request->only('eshopname', 'identifier', 'host', 'port', 'database', 'username', 'password'), 'jetsoft-shopconnector');

        return $this->ajaxWithPayload([]);
    }
}
