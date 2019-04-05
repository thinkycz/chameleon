<?php

namespace App\Exports\OrderData;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class OrderedItemsSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{
    private $orderedItems;

    public function __construct($orderedItems)
    {
        $this->orderedItems = $orderedItems;
    }

    /**
     * @return Collection
     */
    public function collection()
    {
        return $this->orderedItems->transform(function ($item) {
            $item = collect($item->toArray())->merge([
                'price'    => $item->formatted_price ?: 0,
                'discount' => $item->discount ?: 0,
                'type'     => $item->typeInString,
                'total'    => $item->formatted_total_price ?: 0,
            ]);

            return collect([
                'name'             => $item->get('name'),
                'catalogue_number' => $item->get('catalogue_number'),
                'barcode'          => $item->get('barcode'),
                'quantity_ordered' => $item->get('quantity_ordered'),
                'price'            => $item->get('price'),
                'total'            => $item->get('total'),
                'discount'         => $item->get('discount'),
                'vatrate'          => $item->get('vatrate'),
                'type'             => $item->get('type'),
            ]);
        });
    }

    public function headings(): array
    {
        return [
            trans('exports.name'),
            trans('exports.catalogue_number'),
            trans('exports.barcode'),
            trans('exports.quantity_ordered'),
            trans('exports.price'),
            trans('exports.total'),
            trans('exports.discount'),
            trans('exports.vat_rate'),
            trans('exports.type'),
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return trans('exports.ordered_items');
    }
}
