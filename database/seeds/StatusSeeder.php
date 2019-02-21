<?php

use App\Enums\Locale;
use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::updateOrCreate(['code' => 'waiting-for-confirmation'], [
            'name'        => [
                Locale::ENGLISH => 'Waiting for confirmation',
                Locale::CZECH   => 'Čeká na potvrzení',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order has been placed and is waiting to be confirmed.',
                Locale::CZECH   => 'Vaše objednávka proběhla úspěšně a čeká na zpracování.',
            ],
            'color'       => '#A9A9A9',
        ]);
        Status::updateOrCreate(['code' => 'confirmed'], [
            'name'        => [
                Locale::ENGLISH => 'Confirmed',
                Locale::CZECH   => 'Potvrzeno',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order has been placed and is waiting to be processed.',
                Locale::CZECH   => 'Vaše objednávka proběhla úspěšně a čeká na zpracování.',
            ],
            'color'       => '#4CBCF6',
        ]);
        Status::updateOrCreate(['code' => 'processing'], [
            'name'        => [
                Locale::ENGLISH => 'Processing',
                Locale::CZECH   => 'Zpracovává se',
            ],
            'description' => [
                Locale::ENGLISH => 'We are currently preparing your order to be shipped.',
                Locale::CZECH   => 'Připravujeme vaši objednávku k odeslání.',
            ],
            'color'       => '#ED5E8A',
        ]);
        Status::updateOrCreate(['code' => 'packed'], [
            'name'        => [
                Locale::ENGLISH => 'Packed',
                Locale::CZECH   => 'Zabaleno',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order has been packed and is waiting to be shipped.',
                Locale::CZECH   => 'Vaše objednávka byla zabalena a je připravena k odeslání.',
            ],
            'color'       => '#737FC5',
        ]);
        Status::updateOrCreate(['code' => 'shipped'], [
            'name'        => [
                Locale::ENGLISH => 'Shipped',
                Locale::CZECH   => 'Odesláno',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order is in transit. You should receive your order soon.',
                Locale::CZECH   => 'Vaše objednávka je na cestě.',
            ],
            'color'       => '#FFAF4C',
        ]);
        Status::updateOrCreate(['code' => 'cancelled'], [
            'name'        => [
                Locale::ENGLISH => 'Returned / Cancelled',
                Locale::CZECH   => 'Vráceno / zrušeno',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order has been cancelled.',
                Locale::CZECH   => 'Vaše objednávka byla zrušena.',
            ],
            'color'       => '#4C4C4C',
            'is_final'    => true,
        ]);
        Status::updateOrCreate(['code' => 'completed'], [
            'name'        => [
                Locale::ENGLISH => 'Completed',
                Locale::CZECH   => 'Zpracováno',
            ],
            'description' => [
                Locale::ENGLISH => 'Your order has been completed.',
                Locale::CZECH   => 'Vaše objednávka byla zpracovaná.',
            ],
            'color'       => '#7BC07D',
            'is_final'    => true,
        ]);
    }
}
