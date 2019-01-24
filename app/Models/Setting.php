<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'namespace',
        'code',
        'schema',
        'data'
    ];

    protected $casts = [
        'schema' => 'array',
        'data'   => 'array'
    ];

    public function getNameAttribute()
    {
        $namespace = $this->namespace ? "{$this->namespace}::" : '';

        return __("{$namespace}settings.{$this->code}");
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

    public static function loadConfiguration(string $code)
    {
        $setting = static::whereCode($code)->first();

        return optional($setting)->data;
    }

    public static function saveConfiguration(string $code, array $data, string $namespace = '')
    {
        $schema = [
            'type'       => 'object',
            'properties' => collect($data)->keys()->mapWithKeys(function ($value) {
                return [$value => ['type' => 'string']];
            })
        ];

        return static::updateOrCreate(compact('namespace', 'code'), compact('schema', 'data'));
    }
}