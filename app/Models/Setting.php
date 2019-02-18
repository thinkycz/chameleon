<?php

namespace App\Models;

use App\Traits\ModelHasMedia;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Setting extends Model implements HasMedia
{
    use ModelHasMedia;

    public $timestamps = false;

    protected $fillable = [
        'namespace',
        'code',
        'schema',
        'data',
    ];

    protected $casts = [
        'schema' => 'array',
        'data'   => 'array',
    ];

    public function getNameAttribute()
    {
        $namespace = $this->namespace ? "{$this->namespace}::" : '';

        $key = "{$namespace}settings.{$this->code}";

        return \Lang::has($key) ? __($key) : str_replace('_', ' ', Str::title($this->code));
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
            } elseif ($property['type'] == 'string') {
                $data[$name] = trim($data[$name]);
            }
        }

        $this->attributes['data'] = json_encode($data);
    }

    public static function fetch($code, $key)
    {
        $settings = static::loadConfiguration($code);

        return $settings[$key] ?? null;
    }

    public static function loadConfiguration(string $code)
    {
        $setting = static::whereCode($code)->first();

        return optional($setting)->data;
    }

    public static function saveConfiguration(string $code, array $data, string $namespace = '', string $type = 'string')
    {
        $schema = [
            'type'       => 'object',
            'properties' => collect($data)->keys()->mapWithKeys(function ($value) use ($type) {
                return [$value => compact('type')];
            }),
        ];

        return static::updateOrCreate(compact('namespace', 'code'), compact('schema', 'data'));
    }
}
