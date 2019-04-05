<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ObjednavkyPolozky extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewObjednavkyPolozky';

    public function objednavka()
    {
        return $this->belongsTo(Objednavky::class, 'ObjednavkaID', 'ID');
    }
}
