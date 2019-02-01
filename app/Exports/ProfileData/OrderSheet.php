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
            'Order Number',
            'Invoice Number',
            'Variable Symbol',
            'Placed at',
            'Email',
            'Total',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Orders';
    }
}
