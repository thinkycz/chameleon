<?php

namespace App\Exports\ProfileData;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ShippingDetailsSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $shippingDetails;

    public function __construct($shippingDetails)
    {
        $this->shippingDetails = $shippingDetails;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->shippingDetails->transform(function ($address) {
            return collect($address->toArray())->except([
                'id',
                'user_id',
                'country_id',
                'created_at',
                'updated_at',
            ]);
        });
    }

    public function headings(): array
    {
        return [
            trans('exports.company_name'),
            trans('exports.first_name'),
            trans('exports.last_name'),
            trans('exports.city'),
            trans('exports.street'),
            trans('exports.zipcode'),
            trans('exports.phone'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('exports.shipping_details');
    }
}
