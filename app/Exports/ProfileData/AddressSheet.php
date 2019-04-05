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
            trans('exports.company_name'),
            trans('exports.first_name'),
            trans('exports.last_name'),
            trans('exports.city'),
            trans('exports.street'),
            trans('exports.zipcode'),
            trans('exports.phone'),
            trans('exports.company_id'),
            trans('exports.vat_number'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('exports.addresses');
    }
}
