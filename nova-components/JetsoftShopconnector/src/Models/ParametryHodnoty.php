<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ParametryHodnoty extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewParametryHodnoty';

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function zbozi()
    {
        return $this->hasMany(Zbozi::class, 'GUIParamValue_Category', 'GUIParamValue_Category');
    }

    public function zboziParametryHodnoty()
    {
        return $this->hasMany(ZboziParametryHodnoty::class, 'GUIParamValue', 'GUIParamValue');
    }
}
