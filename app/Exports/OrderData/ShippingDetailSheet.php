<?php

namespace App\Exports\OrderData;

use App\Models\ShippingDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ShippingDetailSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $shippingDetail;

    public function __construct(ShippingDetail $shippingDetail)
    {
        $this->shippingDetail = $shippingDetail;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $data = collect($this->shippingDetail->toArray())->except([
            'id',
            'user_id',
            'country_id',
            'created_at',
            'updated_at',
        ]);

        return collect([$data->toArray()]);
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
            'Phone',
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
