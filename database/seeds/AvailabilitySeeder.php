<?php

use App\Enums\Locale;
use Illuminate\Database\Seeder;
use App\Models\Availability;

class AvailabilitySeeder extends Seeder
{
    public function run()
    {
        Availability::updateOrCreate(['code' => 'in-stock'], [
            'name'                    => [
                Locale::ENGLISH    => 'In stock',
                Locale::CZECH      => 'Skladem',
                Locale::VIETNAMESE => 'Trong kho',
            ],
            'description'             => [
                Locale::ENGLISH    => 'The product is in stock and can be ordered.',
                Locale::CZECH      => 'Tento produkt je skladem, a lze ho objednat.',
                Locale::VIETNAMESE => 'Sản phẩm có trong kho và quý khách có thể đặt ngay.',
            ],
            'allow_negative_quantity' => false
        ]);

        Availability::updateOrCreate(['code' => 'in-stock-not-guaranteed'], [
            'name'        => [
                Locale::ENGLISH    => 'In stock (not guaranteed)',
                Locale::CZECH      => 'Skladem (negarantujeme)',
                Locale::VIETNAMESE => 'Trong kho (không đảm bảo số lượng)',
            ],
            'description' => [
                Locale::ENGLISH    => 'The product is usually in stock, but the availability is not guaranteed.',
                Locale::CZECH      => 'Tento produkt je obvykle skladem, ale negaratujeme jeho dostupnost.',
                Locale::VIETNAMESE => 'Sản phẩm này thường có trong kho nhưng không thể đảm bảo.',
            ]
        ]);

        Availability::updateOrCreate(['code' => 'out-of-stock'], [
            'name'         => [
                Locale::ENGLISH    => 'Out of stock',
                Locale::CZECH      => 'Vyprodáno',
                Locale::VIETNAMESE => 'Hết hàng',
            ],
            'description'  => [
                Locale::ENGLISH    => 'The product is not in stock and can not be ordered.',
                Locale::CZECH      => 'Tento produkt není na skladě a nelze je objednat.',
                Locale::VIETNAMESE => 'Sản phẩm không có trong kho vì thế quý khách không thể đặt được.',
            ],
            'allow_orders' => false
        ]);

        Availability::updateOrCreate(['code' => 'preorders-available'], [
            'name'        => [
                Locale::ENGLISH    => 'Preorders available',
                Locale::CZECH      => 'Lze předobjednat',
                Locale::VIETNAMESE => 'Quý khách có thể đặt hàng trước',
            ],
            'description' => [
                Locale::ENGLISH    => 'The product can be preordered.',
                Locale::CZECH      => 'Tento produkt lze předobjednávat.',
                Locale::VIETNAMESE => 'Sản phẩm này có thể được đặt hàng trước.',
            ]
        ]);

        Availability::updateOrCreate(['code' => 'on-request'], [
            'name'        => [
                Locale::ENGLISH    => 'On request',
                Locale::CZECH      => 'Na objednání',
                Locale::VIETNAMESE => 'Theo yêu cầu',
            ],
            'description' => [
                Locale::ENGLISH    => 'The product can be ordered and will be restocked on request.',
                Locale::CZECH      => 'Tento produkt lze objednat na vyžádání.',
                Locale::VIETNAMESE => 'Chúng tôi có thể đặt hàng sản phẩm này và nạp lại nó theo yêu cầu của bạn.',
            ]
        ]);
    }
}
