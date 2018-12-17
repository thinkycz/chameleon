<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Vyrobci extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewVyrobci';

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIParamName');
    }
}
