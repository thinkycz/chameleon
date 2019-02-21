<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

abstract class BaseMigrationSeeder extends Seeder
{
    /**
     * Represents a pair for new => old
     * database structure
     *
     * @var array
     */
    protected $pairs = [];

    protected $oldTableName;

    protected function execute($callback)
    {
        $pairs = collect($this->pairs);

        DB::connection('old_mysql')
            ->table($this->oldTableName)
            ->orderBy('id')
            ->chunk(200,
                function ($items) use ($callback, $pairs) {
                    $items->each(function ($item) use ($callback, $pairs) {
                        $result = collect();
                        $pairs->map(function ($old, $new) use ($item, &$result) {
                            if ($old && property_exists($item, $old) && ($value = $item->{$old})) {
                                $result->put($new, $value);
                            } else {
                                $result->put($new, null);
                            }
                        });

                        $callback($result);
                    });
                });
    }
}
