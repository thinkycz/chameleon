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
            'Company Name',
            'First Name',
            'Last Name',
            'City',
            'Street',
            'Zipcode',
            'Country',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Shipping Details';
    }
}
