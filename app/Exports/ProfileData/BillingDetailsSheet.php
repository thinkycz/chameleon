<?php

namespace App\Exports\ProfileData;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BillingDetailsSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $billingDetails;

    public function __construct($billingDetails)
    {
        $this->billingDetails = $billingDetails;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->billingDetails->transform(function ($address) {
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
            'Company ID',
            'Vat Number',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Billing Details';
    }
}
