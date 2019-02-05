<?php

namespace App\Exports\OrderData;

use App\Models\BillingDetail;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class BillingDetailSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $billingDetail;

    public function __construct(BillingDetail $billingDetail)
    {
        $this->billingDetail = $billingDetail;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $data = collect($this->billingDetail->toArray())->except([
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
