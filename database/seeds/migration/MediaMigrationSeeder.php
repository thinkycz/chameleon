<?php

use App\Models\Media;
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
        $data = Spatie\MediaLibrary\Models\Media::hydrate(DB::connection('old_mysql')->table('media')->get()->toArray());

        $data->each(function ($media) {
            $media = $media->toArray();
            $media = array_merge($media, [
                'custom_properties' => json_encode($media['custom_properties']),
                'manipulations'     => json_encode($media['manipulations']),
                'responsive_images' => json_encode([]),
            ]);

            DB::table('media')->insert($media);
        });
    }
}
