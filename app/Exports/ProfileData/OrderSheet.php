<?php

namespace App\Exports\ProfileData;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrderSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $orders;

    public function __construct($orders)
    {
        $this->orders = $orders;
    }

    /**
     * @return Builder
     */
    public function collection()
    {
        return $this->orders->transform(function ($order) {
            return collect($order->toArray())->merge(['total' => $order->formatted_total_price])->only([
                'order_number',
                'invoice_number',
                'variable_symbol',
                'placed_at',
                'email',
                'total',
            ]);
        });
    }

    public function headings(): array
    {
        return [
            trans('exports.order_number'),
            trans('exports.invoice_number'),
            trans('exports.variable_symbol'),
            trans('exports.placed_at'),
            trans('exports.email'),
            trans('exports.total'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('exports.orders');
    }
}
