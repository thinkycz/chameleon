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
        return trans('exports.billing_details');
    }
}
