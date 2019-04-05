<?php

namespace App\Traits\ReusableScopes;

use Illuminate\Database\Eloquent\Builder;

trait ScopeWhereLike
{
    public function scopeWhereLike(Builder $query, $column, $keyword)
    {
        return $query->where($column, 'like', "%$keyword%");
    }

    public function scopeWhereLikeQuery(Builder $query, $column, $keyword)
    {
        return $query->where($column, 'like', str_replace('*', '%', $keyword));
    }
}
