<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Objednavky extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewObjednavky';

    public function zakaznik()
    {
        return $this->belongsTo(Zakaznici::class, 'GUIClient', 'GUIClient');
    }

    public function objednavkyPolozky()
    {
        return $this->hasMany(ObjednavkyPolozky::class, 'ObjednavkaID', 'ID');
    }
}
