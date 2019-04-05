<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ParametryNazvy extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewParametryNazvy';

    public function parametryVariaci()
    {
        return $this->hasMany(ParametryVariaci::class, 'GUIParamName', 'GUIParamName');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function zbozi()
    {
        return $this->hasMany(Zbozi::class, 'GUIParamName_Category', 'GUIParamName_Category');
    }

    public function zboziParametryNazvy()
    {
        return $this->hasMany(ZboziParametryHodnoty::class, 'GUIParamName', 'GUIParamName');
    }
}
