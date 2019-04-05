<?php

namespace App\Traits\Product;

use Laravel\Scout\Searchable;

trait ProductCanBeSearched
{
    use Searchable;

    public function toSearchableArray()
    {
        return [
            $this->getKeyName() => $this->getKey(),
            'name'              => $this->name,
            'description'       => $this->description,
            'details'           => $this->details,
            'catalogue_number'  => (string) $this->catalogue_number,
            'barcode'           => (string) $this->barcode,
        ];
    }

    public function searchableFields()
    {
        return ['name^3', 'barcode^2', 'catalogue_number^2', 'description', 'details'];
    }
}
