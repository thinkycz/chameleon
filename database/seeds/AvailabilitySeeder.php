<?php

use App\Enums\Locale;
use App\Models\Availability;
use Illuminate\Database\Seeder;

class AvailabilitySeeder extends Seeder
{
    public function run()
    {
        Availability::updateOrCreate(['code' => 'in-stock'], [
            'name'                    => [
                Locale::ENGLISH => 'In stock',
                Locale::CZECH   => 'Skladem',
            ],
            'description'             => [
                Locale::ENGLISH => 'The product is in stock and can be ordered.',
                Locale::CZECH   => 'Tento produkt je skladem, a lze ho objednat.',
            ],
            'allow_negative_quantity' => false,
        ]);

        Availability::updateOrCreate(['code' => 'in-stock-not-guaranteed'], [
            'name'        => [
                Locale::ENGLISH => 'In stock (not guaranteed)',
                Locale::CZECH   => 'Skladem (negarantujeme)',
            ],
            'description' => [
                Locale::ENGLISH => 'The product is usually in stock, but the availability is not guaranteed.',
                Locale::CZECH   => 'Tento produkt je obvykle skladem, ale negaratujeme jeho dostupnost.',
            ],
        ]);

        Availability::updateOrCreate(['code' => 'out-of-stock'], [
            'name'         => [
                Locale::ENGLISH => 'Out of stock',
                Locale::CZECH   => 'Vyprodáno',
            ],
            'description'  => [
                Locale::ENGLISH => 'The product is not in stock and can not be ordered.',
                Locale::CZECH   => 'Tento produkt není na skladě a nelze je objednat.',
            ],
            'allow_orders' => false,
        ]);

        Availability::updateOrCreate(['code' => 'preorders-available'], [
            'name'        => [
                Locale::ENGLISH => 'Preorders available',
                Locale::CZECH   => 'Lze předobjednat',
            ],
            'description' => [
                Locale::ENGLISH => 'The product can be preordered.',
                Locale::CZECH   => 'Tento produkt lze předobjednávat.',
            ],
        ]);

        Availability::updateOrCreate(['code' => 'on-request'], [
            'name'        => [
                Locale::ENGLISH => 'On request',
                Locale::CZECH   => 'Na objednání',
            ],
            'description' => [
                Locale::ENGLISH => 'The product can be ordered and will be restocked on request.',
                Locale::CZECH   => 'Tento produkt lze objednat na vyžádání.',
            ],
        ]);
    }
}
