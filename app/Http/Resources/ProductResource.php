<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
            'description'            => $this->description,
            'details'                => $this->details,
            'catalogue_number'       => $this->catalogue_number,
            'barcode'                => $this->barcode,
            'quantity_in_stock'      => $this->quantity_in_stock,
            'minimum_order_quantity' => $this->minimum_order_quantity,
            'multiply_of_moq_only'   => $this->multiply_of_moq_only,
            'vatrate'                => $this->vatrate,
            'unit'                   => $this->unit->abbr,
            'categories'             => $this->categories->pluck('id'),
            'prices'                 => $this->prices,
            'media'                  => $this->media,
        ];
    }
}
