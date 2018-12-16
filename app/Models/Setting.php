<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $casts = [
        'schema' => 'array',
        'data'   => 'array'
    ];

    public function getNameAttribute()
    {
        return __("settings.{$this->code}");
    }

    public function getValueAttribute()
    {
        return $this->data['value'] ?? __('settings.object');
    }

    public function setDataAttribute($data)
    {
        foreach ($this->schema['properties'] as $name => $property) {
            if ($property['type'] == 'boolean') {
                $data[$name] = $data[$name] == 'true';
            } elseif ($property['type'] == 'number') {
                $data[$name] = floatval($data[$name]);
            } else {
                $data[$name] = trim($data[$name]);
            }
        }

        $this->attributes['data'] = json_encode($data);
    }
}
