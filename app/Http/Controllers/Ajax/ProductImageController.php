<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductImageController extends Controller
{
    public function upload(Request $request, Product $product)
    {
        $file = collect($request->file('file'))->first();

        $media = $product->addMediaFromRequest('file')->toMediaCollection('images');

        return $this->ajaxWithPayload(compact('media'));
    }

    public function destroy(Product $product, $image)
    {
        $product->deleteMedia($image);

        return $this->ajaxWithPayload();
    }
}
