<?php

namespace Nulisec\BulkImageUpload\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BulkImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $file = collect($request->file('file'))->first();
        $filename = $this->extractFilename($file);

        if ($product = Product::where($request->get('identifier'), $filename)->first()) {
            $media = $product->addMediaFromRequest('file')->toMediaCollection('images');

            return $this->ajaxWithPayload(compact('media'));
        }

        return $this->ajaxWithPayload(null, false, trans('bulk-image-upload::messages.product_not_found'));
    }

    public function destroy(Product $product, $image)
    {
        $product->deleteMedia($image);

        return $this->ajaxWithPayload();
    }

    private function extractFilename(UploadedFile $file, $delimeter = '|')
    {
        return collect(explode($delimeter, pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)))->first();
    }
}
