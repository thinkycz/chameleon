<?php

use App\Models\Unit;

class UnitMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'name'       => 'name',
        'abbr'       => 'abbr',

        /**
         * Default columns
         */
        'id'         => 'id',
        'created_at' => 'created_at',
        'updated_at' => 'updated_at',
    ];

    protected $oldTableName = 'units';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->execute(function ($item) {
            Unit::insert($item->toArray());
        });
    }
}
