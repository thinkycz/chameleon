<?php

use Illuminate\Support\Facades\DB;

class MediaMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'       => 'value',
        'type'       => 'is_badge',

        /**
         * Default columns
         */
        'id'         => 'id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $oldTableName = 'media';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::connection('old_mysql')->table($this->oldTableName)->orderBy('id')->chunk(200, function ($medias) {
            $medias->each(function ($media) {
                $media = json_decode(json_encode($media, JSON_UNESCAPED_SLASHES), true);
                $media = array_merge($media, [
                    'collection_name'   => 'images',
                    'custom_properties' => $media['custom_properties'],
                    'manipulations'     => $media['manipulations'],
                    'responsive_images' => json_encode([]),
                ]);
                DB::table('media')->insert($media);
            });
        });
    }
}
