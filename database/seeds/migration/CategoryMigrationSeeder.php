<?php

use App\Models\Category;

class CategoryMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'slug'       => 'slug',
        'name'       => 'name',
        'position'   => 'position',
        'parent_id'  => 'parent_id',
        '_lft'       => '_lft',
        '_rgt'       => '_rgt',
        'enabled'    => 'enabled',

        /**
         * Default columns
         */
        'id'         => 'id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $oldTableName = 'categories';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            $item = $item->merge([
                'enabled'  => true,
                'position' => $item->get('position') ?: 0,
            ]);

            Category::insert($item->toArray());
        });
    }
}
