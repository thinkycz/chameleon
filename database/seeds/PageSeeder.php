<?php

use App\Enums\Locale;
use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Page::create([
            'title' => 'Obchodní Podmínky',
            'content' => file_get_contents(__DIR__ . '/pages/terms_cs.blade.php'),
        ]);

        Page::create([
            'title' => 'Ochrana osobních údajů',
            'content' => file_get_contents(__DIR__ . '/pages/privacy_cs.blade.php'),
        ]);

        Page::create([
            'title' => 'Reklamační řád',
            'content' => file_get_contents(__DIR__ . '/pages/returns_cs.blade.php'),
        ]);

        Page::create([
            'title' => 'Často kladené otázky',
            'content' =>  file_get_contents(__DIR__ . '/pages/faq_cs.blade.php'),
        ]);
    }
}
