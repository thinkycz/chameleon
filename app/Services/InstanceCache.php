<?php

namespace App\Services;

use Illuminate\Support\Collection;

class InstanceCache
{
    public $instanceData;

    public function __construct()
    {
        $this->instanceData = new Collection();
    }

    public function getOrFetch($namespace, $rawkey, callable $closure)
    {
        $key = "{$namespace}.{$rawkey}";

        if ($this->instanceData->has($key)) {
            $result = $this->instanceData->get($key);
        } else {
            $result = $closure();
            $this->instanceData->put($key, $result);
        }

        return $result;
    }
}
