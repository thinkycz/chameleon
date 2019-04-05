<?php

namespace Nulisec\JsonSchema\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        $collection = $request->get('collection');
        $setting = Setting::whereCode('store_settings')->first();

        $setting->clearMediaCollection($collection);
        $media = $setting->addMediaFromRequest('file')->toMediaCollection($collection);

        return $this->ajaxWithPayload(compact('media'));
    }
}
