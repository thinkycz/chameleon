<?php

namespace App\Exports\ProfileData;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class AddressSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $addresses;

    public function __construct($addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->addresses->transform(function ($address) {
            return collect($address->toArray())->except([
                'id',
                'user_id',
                'country_id',
                'is_default',
                'created_at',
                'updated_at',
                'title',
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
            'Phone',
            'Vat ID',
            'Company ID',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Addresses';
    }
}
