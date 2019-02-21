<?php

use App\Models\Page;

class PageMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'title'      => 'title',
        'slug'       => 'slug',
        'content'    => 'source',

        /**
         * Default columns
         */
        'id'         => 'id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $oldTableName = 'pages';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $title = json_decode($item->get('title'));
            $content = json_decode($item->get('content'));

            $item = $item->merge([
                'title'   => property_exists($title, 'cs') ? $title->cs : $title->en,
                'content' => property_exists($content, 'cs') ? $content->cs : $content->en,
            ]);

            Page::insert($item->toArray());
        });
    }
}
