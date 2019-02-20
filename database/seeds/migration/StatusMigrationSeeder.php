<?php

use App\Models\Status;

class StatusMigrationSeeder extends BaseMigrationSeeder
{
    protected $pairs = [
        'code'        => 'code',
        'name'        => 'name',
        'description' => 'description',
        'color'       => 'color',
        'is_final'    => 'is_final',

        /**
         * Default columns
         */
        'id'          => 'id',
        'created_at'  => 'created_at',
        'updated_at'  => 'updated_at',
    ];

    protected $oldTableName = 'order_statuses';

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->prepare($array = false);
        $data = $data->map(function ($item) {
            return $item->merge([
                'is_final' => $item->get('is_final') ?: false,
            ]);
        });

        Status::insert($data->toArray());
    }
}
