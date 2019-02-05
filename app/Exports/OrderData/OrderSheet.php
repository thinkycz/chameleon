<?php

namespace App\Exports\OrderData;

use App\Models\Order;
use App\Models\Store;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrderSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    /**
     * @var Order
     */
    private $order;

    /**
     * @var Store
     */
    private $store;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        $data = collect($this->order->toArray())->only([
            'order_number',
            'invoice_number',
            'variable_symbol',
            'issue_date',
            'email',
        ]);

        $data->put('total', $this->order->formatted_total_price);

        return collect()->push($data);
    }

    public function headings(): array
    {
        return [
            'Order Number',
            'Invoice Number',
            'Variable Symbol',
            'Issue Date',
            'Email',
            'Total',
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Order';
    }
}
