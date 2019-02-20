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

    /**
     * Preparing the data for the new database structure
     *
     * @param boolean $array
     * @return Collection
     */
    protected function prepare($array = true)
    {
        $result = collect();
        $pairs = collect($this->pairs);
        $data = $this->getExistingData();

        $data->each(function ($item) use ($pairs, &$result) {
            $single = collect();
            $pairs->map(function ($old, $new) use ($item, &$single) {
                if ($old && property_exists($item, $old) && ($value = $item->{$old})) {
                    $single->put($new, $value);
                } else {
                    $single->put($new, null);
                }
            });

            $result->push($single);
        });

        return $array ? $result->toArray() : $result;
    }

    public function getExistingData()
    {
        return DB::connection('old_mysql')->table($this->oldTableName)->get();
    }
}
