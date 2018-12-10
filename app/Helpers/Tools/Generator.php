<?php

namespace App\Helpers\Tools;

use Carbon\Carbon;
use Faker\Factory;
use Illuminate\Support\Str;

class Generator
{
    public $faker;

    public function __construct()
    {
        $this->faker = Factory::create();
    }

    public function datestamp()
    {
        return Carbon::now()->format('ymd');
    }

    public function datestamprandom($prefix = null, $length = 6)
    {
        return (Str::upper($prefix) ?: '') . $this->datestamp() . Str::upper(Str::random($length));
    }

    public function orderNumber()
    {
        return $this->datestamprandom('OB');
    }

    public function invoiceNumber()
    {
        return $this->datestamprandom('FA');
    }

    public function messageNumber()
    {
        return $this->datestamprandom('DO');
    }

    public function variableSymbol()
    {
        return $this->datestamp() . $this->faker->randomNumber(4);
    }

    public function fileName($chars = null)
    {
        $string = uniqid() . substr(md5(rand(1, 1000)), 5, 10);
        if (!$chars) {
            return $string;
        }
        return substr($string, 5, 5 + $chars);
    }

    protected function suffix($id)
    {
        if (strlen($id) > 4) {
            return substr($id, -4);
        } else {
            return str_pad($id, 4, 0, STR_PAD_LEFT);
        }
    }
}
