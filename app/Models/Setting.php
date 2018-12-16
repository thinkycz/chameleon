<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $casts = [
        'schema' => 'array',
        'data' => 'array'
    ];

    public function getNameAttribute()
    {
        return __("settings.{$this->code}");
    }

    public function getValueAttribute()
    {
        return $this->data['value'] ?? __('settings.object');
    }
}
