<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class DopravaPlatba extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewDopravaPlatba';

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }
}
