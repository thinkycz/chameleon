<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Zakaznici extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewZakaznici';

    public function parent()
    {
        return $this->belongsTo(Zakaznici::class, 'GUIClientParent', 'GUIClientParent');
    }

    public function zakazniciOsoby()
    {
        return $this->hasMany(ZakazniciOsoby::class, 'GUIClient', 'GUIClient');
    }

    public function objednavky()
    {
        return $this->hasMany(Objednavky::class, 'GUIClient', 'GUIClient');
    }

    public function faktury()
    {
        return $this->hasMany(Faktury::class, 'GUIClient', 'GUIClient');
    }

    public function ceniky()
    {
        return $this->belongsTo(Ceniky::class, 'GUIPricelist', 'GUIPricelist');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }
}
