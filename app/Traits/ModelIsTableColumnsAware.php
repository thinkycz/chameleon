<?php

namespace App\Traits;

trait ModelIsTableColumnsAware
{
    public static function getTableColumns($prefix = '')
    {
        $model = new static();
        $columns = $model->getConnection()->getSchemaBuilder()->getColumnListing($model->getTable());

        return array_map(function ($column) use ($prefix) {
            return "{$prefix}{$column}";
        }, $columns);
    }
}
