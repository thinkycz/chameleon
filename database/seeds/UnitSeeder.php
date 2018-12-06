<?php

use App\Enums\Locale;
use Illuminate\Database\Seeder;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    public function run()
    {
        Unit::updateOrCreate(['code' => 'piece'], [
            'name' => [
                Locale::ENGLISH => 'Piece',
                Locale::CZECH => 'Kus',
                Locale::VIETNAMESE => 'Cái',
            ],
            'abbr' => [
                Locale::ENGLISH => 'pcs',
                Locale::CZECH => 'kusů',
                Locale::VIETNAMESE => 'cái',
            ],
        ]);
        Unit::updateOrCreate(['code' => 'pair'], [
            'name' => [
                Locale::ENGLISH => 'Pair',
                Locale::CZECH => 'Pár',
                Locale::VIETNAMESE => 'Đôi',
            ],
            'abbr' => [
                Locale::ENGLISH => 'pairs',
                Locale::CZECH => 'párů',
                Locale::VIETNAMESE => 'đôi',
            ],
        ]);
        Unit::updateOrCreate(['code' => 'set'], [
            'name' => [
                Locale::ENGLISH => 'Set',
                Locale::CZECH => 'Sada',
                Locale::VIETNAMESE => 'Bộ',
            ],
            'abbr' => [
                Locale::ENGLISH => 'set',
                Locale::CZECH => 'sad',
                Locale::VIETNAMESE => 'bộ',
            ],
        ]);
        Unit::updateOrCreate(['code' => 'box'], [
            'name' => [
                Locale::ENGLISH => 'Box',
                Locale::CZECH => 'Krabice',
                Locale::VIETNAMESE => 'Hộp',
            ],
            'abbr' => [
                Locale::ENGLISH => 'box',
                Locale::CZECH => 'krabic',
                Locale::VIETNAMESE => 'hộp',
            ],
        ]);
        Unit::updateOrCreate(['code' => 'palette'], [
            'name' => [
                Locale::ENGLISH => 'Palette',
                Locale::CZECH => 'Paleta',
                Locale::VIETNAMESE => 'Palet',
            ],
            'abbr' => [
                Locale::ENGLISH => 'plt',
                Locale::CZECH => 'palet',
                Locale::VIETNAMESE => 'palet',
            ],
        ]);
        Unit::updateOrCreate(['code' => 'dozen'], [
            'name' => [
                Locale::ENGLISH => 'Dozen',
                Locale::CZECH => 'Tucet',
                Locale::VIETNAMESE => 'Tá',
            ],
            'abbr' => [
                Locale::ENGLISH => 'dz',
                Locale::CZECH => 'tuctů',
                Locale::VIETNAMESE => 'tá',
            ],
        ]);
    }
}
