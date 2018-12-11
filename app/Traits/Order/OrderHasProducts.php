<?php

namespace App\Traits\Order;

use App\Models\OrderedItem;
use App\Models\Product;

trait OrderHasProducts
{
    public function addProduct(Product $product, $quantity = 1, $options = [])
    {
        $this->createOrUpdateOrderedItem($product, $quantity, $options);

        return $this->fresh();
    }

    public function updateOrderedItemQuantity(OrderedItem $orderedItem, $quantity)
    {
        if ($quantity == 0) {
            return $this->removeOrderedItem($orderedItem);
        } else {
            $orderedItem->update(['quantity_ordered' => $quantity]);
        }

        return $this->fresh();
    }

    public function removeOrderedItem(OrderedItem $orderedItem)
    {
        $orderedItem->delete();

        return $this->fresh();
    }

    private function createOrUpdateOrderedItem(Product $product, $quantity, $options)
    {
        if ($item = $this->findOrderedItem($product, $options)) {
            $this->updateOrderedItemQuantity($item, $quantity);
        } else {
            $item = $this->createOrderedItem($product, $quantity, $options);
        }

        return $item;
    }

    private function createOrderedItem(Product $product, $quantity, $options)
    {
        $data = collect($product->only([
            'name',
            'description',
            'catalogue_number',
            'barcode',
            'details',
            'vatrate',
        ]))->merge([
            'product_id'       => $product->id,
            'price'            => $product->getPrice(),
            'options'          => $options ?? null,
            'quantity_ordered' => $quantity,
        ]);

        return $this->orderedItems()->create($data->toArray());
    }

    private function findOrderedItem($product, $options)
    {
        $items = $this->orderedItems()->where('product_id', $product->id)->get();

        return $items->first(function ($item) use ($options) {
            return !count(array_diff($options, $item->options));
        });
    }
}
