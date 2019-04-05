<?php

namespace Nulisec\LatestOrders\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'order_number' => $this->order_number,
            'placed_at'    => $this->placed_at->format(config('config.date_format')),
            'email'        => $this->email,
            'phone'        => $this->phone,
            'user'         => $this->user ?? null,
            'status'       => $this->status ?? null,
        ];
    }
}
