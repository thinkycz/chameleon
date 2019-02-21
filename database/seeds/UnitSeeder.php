<?php

use App\Enums\Locale;
use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::updateOrCreate(['code' => 'piece'], [
            'name' => [
                Locale::ENGLISH => 'Piece',
                Locale::CZECH   => 'Kus',
            ],
            'abbr' => [
                Locale::ENGLISH => 'pcs',
                Locale::CZECH   => 'kusů',
            ],
        ]);

        Unit::updateOrCreate(['code' => 'pair'], [
            'name' => [
                Locale::ENGLISH => 'Pair',
                Locale::CZECH   => 'Pár',
            ],
            'abbr' => [
                Locale::ENGLISH => 'pairs',
                Locale::CZECH   => 'párů',
            ],
        ]);

        Unit::updateOrCreate(['code' => 'set'], [
            'name' => [
                Locale::ENGLISH => 'Set',
                Locale::CZECH   => 'Sada',
            ],
            'abbr' => [
                Locale::ENGLISH => 'set',
                Locale::CZECH   => 'sad',
            ],
        ]);

        Unit::updateOrCreate(['code' => 'box'], [
            'name' => [
                Locale::ENGLISH => 'Box',
                Locale::CZECH   => 'Krabice',
            ],
            'abbr' => [
                Locale::ENGLISH => 'box',
                Locale::CZECH   => 'krabic',
            ],
        ]);

        Unit::updateOrCreate(['code' => 'palette'], [
            'name' => [
                Locale::ENGLISH => 'Palette',
                Locale::CZECH   => 'Paleta',
            ],
            'abbr' => [
                Locale::ENGLISH => 'plt',
                Locale::CZECH   => 'palet',
            ],
        ]);

        Unit::updateOrCreate(['code' => 'dozen'], [
            'name' => [
                Locale::ENGLISH => 'Dozen',
                Locale::CZECH   => 'Tucet',
            ],
            'abbr' => [
                Locale::ENGLISH => 'dz',
                Locale::CZECH   => 'tuctů',
            ],
        ]);
    }
}
