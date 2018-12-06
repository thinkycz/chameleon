<?php

use App\Enums\Locale;
use App\Models\Currency;
use Illuminate\Database\Seeder;

class CurrencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Czech Koruna',
                Locale::CZECH => 'Česká koruna',
                Locale::VIETNAMESE => 'Koruna Séc'
            ],
            'isocode' => 'CZK',
            'symbol' => 'Kč',
            'symbol_is_before' => false,
            'exchange_rate' => 1,
            'enabled' => true
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'United States Dollar',
                Locale::CZECH => 'Americký dolar',
                Locale::VIETNAMESE => 'Đô la mỹ'
            ],
            'isocode' => 'USD',
            'symbol' => '$',
            'symbol_is_before' => true,
            'exchange_rate' => 21.88,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Euro',
                Locale::CZECH => 'Euro',
                Locale::VIETNAMESE => 'Euro'
            ],
            'isocode' => 'EUR',
            'symbol' => '€',
            'symbol_is_before' => false,
            'exchange_rate' => 26.10,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'United Kingdom Pound',
                Locale::CZECH => 'Britská libra',
                Locale::VIETNAMESE => 'Đồng bảng Anh'
            ],
            'isocode' => 'GBP',
            'symbol' => '£',
            'symbol_is_before' => true,
            'exchange_rate' => 28.25,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Indian Rupee',
                Locale::CZECH => 'Indická rupie',
                Locale::VIETNAMESE => 'Rupee Ấn Độ'
            ],
            'isocode' => 'INR',
            'symbol' => '₹',
            'symbol_is_before' => true,
            'exchange_rate' => 0.34,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Australian Dollar',
                Locale::CZECH => 'Australský dolar',
                Locale::VIETNAMESE => 'Đô la Úc'
            ],
            'isocode' => 'AUD',
            'symbol' => 'A$',
            'symbol_is_before' => true,
            'exchange_rate' => 17.38,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Canadian Dollar',
                Locale::CZECH => 'Kanadský dolar',
                Locale::VIETNAMESE => 'Đô la Canada'
            ],
            'isocode' => 'CAD',
            'symbol' => 'C$',
            'symbol_is_before' => true,
            'exchange_rate' => 17.57,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Singapore Dollar',
                Locale::CZECH => 'Singapurský dolar',
                Locale::VIETNAMESE => 'Đô la Singapore'
            ],
            'isocode' => 'SGD',
            'symbol' => 'S$',
            'symbol_is_before' => true,
            'exchange_rate' => 16.15,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Swiss Franc',
                Locale::CZECH => 'Švýcarský frank',
                Locale::VIETNAMESE => 'Franc Thụy Sĩ'
            ],
            'isocode' => 'CHF',
            'symbol' => 'CHF',
            'symbol_is_before' => false,
            'exchange_rate' => 22.92,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Malaysian Ringgit',
                Locale::CZECH => 'Malajsijský ringgit',
                Locale::VIETNAMESE => 'Đồng Ringgit Mã Lai'
            ],
            'isocode' => 'MYR',
            'symbol' => 'RM',
            'symbol_is_before' => false,
            'exchange_rate' => 5.12,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Japanese Yen',
                Locale::CZECH => 'Japonský jen',
                Locale::VIETNAMESE => 'Yen Nhật'
            ],
            'isocode' => 'JPY',
            'symbol' => '¥',
            'symbol_is_before' => true,
            'exchange_rate' => 0.20,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Chinese Yuan Renminbi',
                Locale::CZECH => 'Čínský jen',
                Locale::VIETNAMESE => 'Nhân dân tệ Trung Quốc'
            ],
            'isocode' => 'CNY',
            'symbol' => '¥',
            'symbol_is_before' => true,
            'exchange_rate' => 3.30,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Swedish Krona',
                Locale::CZECH => 'Švédská koruna',
                Locale::VIETNAMESE => 'curon Thụy Điển'
            ],
            'isocode' => 'SEK',
            'symbol' => 'kr',
            'symbol_is_before' => false,
            'exchange_rate' => 2.74,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'New Zealand Dollar',
                Locale::CZECH => 'Novozélandský dolar',
                Locale::VIETNAMESE => 'Đô la New Zealand'
            ],
            'isocode' => 'NZD',
            'symbol' => 'NZ$',
            'symbol_is_before' => true,
            'exchange_rate' => 15.83,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Mexican Peso',
                Locale::CZECH => 'Mexické peso',
                Locale::VIETNAMESE => 'Đồng peso Mexican'
            ],
            'isocode' => 'MXN',
            'symbol' => 'MEX$',
            'symbol_is_before' => true,
            'exchange_rate' => 15.83,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Hong Kong Dollar',
                Locale::CZECH => 'Hongkongský dolar',
                Locale::VIETNAMESE => 'Đô la Hong Kong'
            ],
            'isocode' => 'HKD',
            'symbol' => 'HK$',
            'symbol_is_before' => true,
            'exchange_rate' => 2.80,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Norwegian Krone',
                Locale::CZECH => 'Norská koruna',
                Locale::VIETNAMESE => 'Krone Na Uy'
            ],
            'isocode' => 'NOK',
            'symbol' => 'kr',
            'symbol_is_before' => false,
            'exchange_rate' => 2.81,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'South Korean Won',
                Locale::CZECH => 'Jihokorejský won',
                Locale::VIETNAMESE => 'Won Hàn Quốc'
            ],
            'isocode' => 'KRW',
            'symbol' => '₩',
            'symbol_is_before' => true,
            'exchange_rate' => 0.020,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Turkish Lira',
                Locale::CZECH => 'Turská lira',
                Locale::VIETNAMESE => 'Lira Thổ Nhĩ Kỳ'
            ],
            'isocode' => 'TRY',
            'symbol' => '₺',
            'symbol_is_before' => true,
            'exchange_rate' => 6.34,
            'enabled' => false
        ]);
        Currency::create([
            'name' => [
                Locale::ENGLISH => 'Russian Ruble',
                Locale::CZECH => 'Ruský rubl',
                Locale::VIETNAMESE => 'Đồng rúp Nga'
            ],
            'isocode' => 'RUB',
            'symbol' => '₽',
            'symbol_is_before' => true,
            'exchange_rate' => 0.37,
            'enabled' => false
        ]);
    }
}
