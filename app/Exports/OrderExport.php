<?php

namespace App\Exports;

use App\Exports\OrderData\BillingDetailSheet;
use App\Exports\OrderData\OrderedItemsSheet;
use App\Exports\OrderData\OrderSheet;
use App\Exports\OrderData\ShippingDetailSheet;
use App\Models\Order;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class OrderExport implements WithMultipleSheets, WithStrictNullComparison
{
    use Exportable;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = collect([
            new OrderSheet($this->order),
            new OrderedItemsSheet($this->order->orderedItems),
            new BillingDetailSheet($this->order->billingDetail),
            new ShippingDetailSheet($this->order->shippingDetail),
        ]);

        return $sheets->toArray();
    }
}
