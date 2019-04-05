<?php

namespace Nulisec\LatestUsers\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'id'          => $this->id,
            'image'       => $this->thumbnail,
            'name'        => $this->name,
            'email'       => $this->email,
            'phone'       => $this->phone,
            'price_level' => $this->priceLevel ?? null,
            'is_active'   => $this->is_active,
        ];
    }
}
