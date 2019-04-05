<?php

use App\Enums\Locale;
use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::updateOrCreate(['isocode3' => 'DEU'], [
            'name'     => [
                Locale::ENGLISH => 'Germany',
                Locale::CZECH   => 'Německo',
            ],
            'isocode2' => 'DE',
        ]);
        Country::updateOrCreate(['isocode3' => 'ITA'], [
            'name'     => [
                Locale::ENGLISH => 'Italy',
                Locale::CZECH   => 'Itálie',
            ],
            'isocode2' => 'IT',
        ]);
        Country::updateOrCreate(['isocode3' => 'FRA'], [
            'name'     => [
                Locale::ENGLISH => 'France',
                Locale::CZECH   => 'Francie',
            ],
            'isocode2' => 'FR',
        ]);
        Country::updateOrCreate(['isocode3' => 'ESP'], [
            'name'     => [
                Locale::ENGLISH => 'Spain',
                Locale::CZECH   => 'Španělsko',
            ],
            'isocode2' => 'ES',
        ]);
        Country::updateOrCreate(['isocode3' => 'NLD'], [
            'name'     => [
                Locale::ENGLISH => 'Netherland',
                Locale::CZECH   => 'Nizozemsko',
            ],
            'isocode2' => 'NL',
        ]);
        Country::updateOrCreate(['isocode3' => 'GBR'], [
            'name'     => [
                Locale::ENGLISH => 'United Kingdom',
                Locale::CZECH   => 'Velká Británie',
            ],
            'isocode2' => 'GB',
        ]);
        Country::updateOrCreate(['isocode3' => 'SWE'], [
            'name'     => [
                Locale::ENGLISH => 'Sweden',
                Locale::CZECH   => 'Švédsko',
            ],
            'isocode2' => 'SE',
        ]);
        Country::updateOrCreate(['isocode3' => 'POL'], [
            'name'     => [
                Locale::ENGLISH => 'Poland',
                Locale::CZECH   => 'Polsko',
            ],
            'isocode2' => 'PL',
        ]);
        Country::updateOrCreate(['isocode3' => 'MLT'], [
            'name'     => [
                Locale::ENGLISH => 'Malta',
                Locale::CZECH   => 'Malta',
            ],
            'isocode2' => 'MT',
        ]);
        Country::updateOrCreate(['isocode3' => 'GRC'], [
            'name'     => [
                Locale::ENGLISH => 'Greece',
                Locale::CZECH   => 'Řecko',
            ],
            'isocode2' => 'GR',
        ]);
        Country::updateOrCreate(['isocode3' => 'AUT'], [
            'name'     => [
                Locale::ENGLISH => 'Austria',
                Locale::CZECH   => 'Rakousko',
            ],
            'isocode2' => 'AT',
        ]);
        Country::updateOrCreate(['isocode3' => 'PRT'], [
            'name'     => [
                Locale::ENGLISH => 'Portugal',
                Locale::CZECH   => 'Portugalsko',
            ],
            'isocode2' => 'PT',
        ]);
        Country::updateOrCreate(['isocode3' => 'DNK'], [
            'name'     => [
                Locale::ENGLISH => 'Denmark',
                Locale::CZECH   => 'Dánsko',
            ],
            'isocode2' => 'DK',
        ]);
        Country::updateOrCreate(['isocode3' => 'CZE'], [
            'name'     => [
                Locale::ENGLISH => 'Czech Republic',
                Locale::CZECH   => 'Česká republika',
            ],
            'isocode2' => 'CZ',
            'enabled'  => true,
        ]);
        Country::updateOrCreate(['isocode3' => 'HRV'], [
            'name'     => [
                Locale::ENGLISH => 'Croatia',
                Locale::CZECH   => 'Chorvatsko',
            ],
            'isocode2' => 'HR',
        ]);
        Country::updateOrCreate(['isocode3' => 'FIN'], [
            'name'     => [
                Locale::ENGLISH => 'Finland',
                Locale::CZECH   => 'Finsko',
            ],
            'isocode2' => 'FI',
        ]);
        Country::updateOrCreate(['isocode3' => 'BEL'], [
            'name'     => [
                Locale::ENGLISH => 'Belgium',
                Locale::CZECH   => 'Belgie',
            ],
            'isocode2' => 'BE',
        ]);
        Country::updateOrCreate(['isocode3' => 'CYP'], [
            'name'     => [
                Locale::ENGLISH => 'Cyprus',
                Locale::CZECH   => 'Kypr',
            ],
            'isocode2' => 'CY',
        ]);
        Country::updateOrCreate(['isocode3' => 'HUN'], [
            'name'     => [
                Locale::ENGLISH => 'Hungary',
                Locale::CZECH   => 'Maďarsko',
            ],
            'isocode2' => 'HU',
        ]);
        Country::updateOrCreate(['isocode3' => 'ROM'], [
            'name'     => [
                Locale::ENGLISH => 'Romania',
                Locale::CZECH   => 'Rumunsko',
            ],
            'isocode2' => 'RO',
        ]);
        Country::updateOrCreate(['isocode3' => 'IRL'], [
            'name'     => [
                Locale::ENGLISH => 'Republic of Ireland',
                Locale::CZECH   => 'Irská republika',
            ],
            'isocode2' => 'IE',
        ]);
        Country::updateOrCreate(['isocode3' => 'BGR'], [
            'name'     => [
                Locale::ENGLISH => 'Bulgaria',
                Locale::CZECH   => 'Bulharsko',
            ],
            'isocode2' => 'BG',
        ]);
        Country::updateOrCreate(['isocode3' => 'LTU'], [
            'name'     => [
                Locale::ENGLISH => 'Lithuania',
                Locale::CZECH   => 'Litva',
            ],
            'isocode2' => 'LT',
        ]);
        Country::updateOrCreate(['isocode3' => 'EST'], [
            'name'     => [
                Locale::ENGLISH => 'Estonia',
                Locale::CZECH   => 'Estonsko',
            ],
            'isocode2' => 'EE',
        ]);
        Country::updateOrCreate(['isocode3' => 'SVN'], [
            'name'     => [
                Locale::ENGLISH => 'Slovenia',
                Locale::CZECH   => 'Slovinsko',
            ],
            'isocode2' => 'SI',
        ]);
        Country::updateOrCreate(['isocode3' => 'SVK'], [
            'name'     => [
                Locale::ENGLISH => 'Slovakia',
                Locale::CZECH   => 'Slovensko',
            ],
            'isocode2' => 'SK',
        ]);
        Country::updateOrCreate(['isocode3' => 'LVA'], [
            'name'     => [
                Locale::ENGLISH => 'Latvia',
                Locale::CZECH   => 'Lotyšsko',
            ],
            'isocode2' => 'LV',
        ]);
        Country::updateOrCreate(['isocode3' => 'CHN'], [
            'name'     => [
                Locale::ENGLISH => 'China',
                Locale::CZECH   => 'Čína',
            ],
            'isocode2' => 'CN',
        ]);
        Country::updateOrCreate(['isocode3' => 'HKG'], [
            'name'     => [
                Locale::ENGLISH => 'Hong Kong',
                Locale::CZECH   => 'Hongkong',
            ],
            'isocode2' => 'HK',
        ]);
        Country::updateOrCreate(['isocode3' => 'RUS'], [
            'name'     => [
                Locale::ENGLISH => 'Russia',
                Locale::CZECH   => 'Rusko',
            ],
            'isocode2' => 'RU',
        ]);
        Country::updateOrCreate(['isocode3' => 'MKD'], [
            'name'     => [
                Locale::ENGLISH => 'Macedonia',
                Locale::CZECH   => 'Makedonie',
            ],
            'isocode2' => 'MK',
        ]);
        Country::updateOrCreate(['isocode3' => 'SRB'], [
            'name'     => [
                Locale::ENGLISH => 'Serbia',
                Locale::CZECH   => 'Srbsko',
            ],
            'isocode2' => 'RS',
        ]);
        Country::updateOrCreate(['isocode3' => 'USA'], [
            'name'     => [
                Locale::ENGLISH => 'United States',
                Locale::CZECH   => 'Spojené státy',
            ],
            'isocode2' => 'US',
        ]);
        Country::updateOrCreate(['isocode3' => 'IND'], [
            'name'     => [
                Locale::ENGLISH => 'India',
                Locale::CZECH   => 'Indie',
            ],
            'isocode2' => 'IN',
        ]);
        Country::updateOrCreate(['isocode3' => 'VNM'], [
            'name'     => [
                Locale::ENGLISH => 'Vietnam',
                Locale::CZECH   => 'Vietnam',
            ],
            'isocode2' => 'VN',
        ]);
    }
}
