<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ZakazniciOsoby extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewZakazniciOsoby';

    public function zakaznik()
    {
        return $this->belongsTo(Zakaznici::class, 'GUIClient', 'GUIClient');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }
}
