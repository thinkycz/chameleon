<?php

use App\Enums\Locale;
use App\Models\PropertyType;
use Illuminate\Database\Seeder;

class PropertyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Color',
                Locale::CZECH   => 'Barva',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Height',
                Locale::CZECH   => 'Výška',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Width',
                Locale::CZECH   => 'Šířka',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Depth',
                Locale::CZECH   => 'Hloubka',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Unit per box',
                Locale::CZECH   => 'Množství v balení',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Weight per box',
                Locale::CZECH   => 'Hmotnost balení',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Boxes per pallet',
                Locale::CZECH   => 'Počet krabic na paletě',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Expiration',
                Locale::CZECH   => 'Datum spotřeby',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Size',
                Locale::CZECH   => 'Velikost',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Volume',
                Locale::CZECH   => 'Objem',
            ],
        ]);
//        electronics
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Type',
                Locale::CZECH   => 'Typ',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Performance',
                Locale::CZECH   => 'Výkon',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Model Name',
                Locale::CZECH   => 'Název modelu',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Features',
                Locale::CZECH   => 'Vlastnosti',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Function',
                Locale::CZECH   => 'Funkce',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Storage',
                Locale::CZECH   => 'Skladování',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Compatible',
                Locale::CZECH   => 'Kompatibilita',
            ],
        ]);
//        Clothing
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Season',
                Locale::CZECH   => 'Sezóna',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Sleeve Style',
                Locale::CZECH   => 'Styl rukáv',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Waistline',
                Locale::CZECH   => 'Objem pasu',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Decoration',
                Locale::CZECH   => 'Dekorace',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Dress Length',
                Locale::CZECH   => 'Délka šat',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Gender',
                Locale::CZECH   => 'Pohlaví',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Material',
                Locale::CZECH   => 'Materiál',
            ],
        ]);
    }
}
