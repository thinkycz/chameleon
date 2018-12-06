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
                Locale::CZECH => 'Barva',
                Locale::VIETNAMESE => 'Màu',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Height',
                Locale::CZECH => 'Výška',
                Locale::VIETNAMESE => 'Chiều cao',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Width',
                Locale::CZECH => 'Šířka',
                Locale::VIETNAMESE => 'Chiều rộng',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Depth',
                Locale::CZECH => 'Hloubka',
                Locale::VIETNAMESE => 'Độ sâu',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Unit per box',
                Locale::CZECH => 'Množství v balení',
                Locale::VIETNAMESE => 'Số lượng trong thùng',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Weight per box',
                Locale::CZECH => 'Hmotnost balení',
                Locale::VIETNAMESE => 'Trọng lượng mỗi hộp',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Boxes per pallet',
                Locale::CZECH => 'Počet krabic na paletě',
                Locale::VIETNAMESE => 'Số hộp trên palet',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Expiration',
                Locale::CZECH => 'Datum spotřeby',
                Locale::VIETNAMESE => 'Hạn',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Size',
                Locale::CZECH => 'Velikost',
                Locale::VIETNAMESE => 'Kích thước',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Volume',
                Locale::CZECH => 'Objem',
                Locale::VIETNAMESE => 'Thể tích',
            ],
        ]);
//        electronics
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Type',
                Locale::CZECH => 'Typ',
                Locale::VIETNAMESE => 'Kiểu',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Performance',
                Locale::CZECH => 'Výkon',
                Locale::VIETNAMESE => 'Chức năng',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Model Name',
                Locale::CZECH => 'Název modelu',
                Locale::VIETNAMESE => 'Tên mô hình',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Features',
                Locale::CZECH => 'Vlastnosti',
                Locale::VIETNAMESE => 'Chi tiết',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Function',
                Locale::CZECH => 'Funkce',
                Locale::VIETNAMESE => 'Chức năng',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Storage',
                Locale::CZECH => 'Skladování',
                Locale::VIETNAMESE => 'Lưu trữ',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Compatible',
                Locale::CZECH => 'Kompatibilita',
                Locale::VIETNAMESE => 'Tương thích',
            ],
        ]);
//        Clothing
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Season',
                Locale::CZECH => 'Sezóna',
                Locale::VIETNAMESE => 'Mùa',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Sleeve Style',
                Locale::CZECH => 'Styl rukáv',
                Locale::VIETNAMESE => 'Kiểu tay áo',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Waistline',
                Locale::CZECH => 'Objem pasu',
                Locale::VIETNAMESE => 'Vòng eo',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Decoration',
                Locale::CZECH => 'Dekorace',
                Locale::VIETNAMESE => 'Trang trí',
            ],
        ]);
        PropertyType::create([
           'name' => [
                Locale::ENGLISH => 'Dress Length',
                Locale::CZECH => 'Délka šat',
                Locale::VIETNAMESE => 'Chiều dài đầm',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Gender',
                Locale::CZECH => 'Pohlaví',
                Locale::VIETNAMESE => 'Giới tính',
            ],
        ]);
        PropertyType::create([
            'name' => [
                Locale::ENGLISH => 'Material',
                Locale::CZECH => 'Materiál',
                Locale::VIETNAMESE => 'Vật chất',
            ],
        ]);
    }
}
