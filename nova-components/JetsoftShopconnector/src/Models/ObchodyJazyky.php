<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ObchodyJazyky extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewObjednavky';

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }
}
