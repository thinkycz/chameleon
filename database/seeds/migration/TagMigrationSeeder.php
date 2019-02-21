<?php

use App\Enums\Locale;
use Illuminate\Support\Facades\DB;
use Spatie\Tags\Tag;

class TagMigrationSeeder extends BaseMigrationSeeder
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

    protected $oldTableName = 'tags';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'type' => $item->get('type') ? 'badge' : null,
                'name' => json_encode([Locale::fallback() => $item->get('name')]),
                'slug' => json_encode([Locale::fallback() => str_slug($item->get('name'))]),
            ]);

            Tag::insert($item->toArray());
        });

        $this->taggables();
    }

    private function taggables()
    {
        $data = Tag::hydrate(DB::connection('old_mysql')->table('taggables')->get()->toArray());

        $data->each(function ($taggable) {
            DB::table('taggables')->insert($taggable->toArray());
        });
    }
}
