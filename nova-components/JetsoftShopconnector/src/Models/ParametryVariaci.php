<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class ParametryVariaci extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewParametryVariaci';

    public function parametrNazev()
    {
        return $this->belongsTo(ParametryNazvy::class, 'GUIParamName', 'GUIParamName');
    }
}
