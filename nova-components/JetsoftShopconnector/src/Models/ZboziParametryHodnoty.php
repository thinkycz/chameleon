<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ZboziParametryHodnoty extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewZboziParametryHodnoty';

    public function zbozi()
    {
        return $this->belongsTo(Zbozi::class, 'GUICommodity', 'GUICommodity');
    }

    public function parametrNazev()
    {
        return $this->belongsTo(ParametryNazvy::class, 'GUIParamName', 'GUIParamName');
    }

    public function parametrHodnota()
    {
        return $this->belongsTo(ParametryHodnoty::class, 'GUIParamName', 'GUIParamName');
    }
}
