<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ZboziSkladem extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewZboziSkladem';

    public function zbozi()
    {
        return $this->belongsTo(Zbozi::class, 'GUICommodity', 'GUICommodity');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }
}
