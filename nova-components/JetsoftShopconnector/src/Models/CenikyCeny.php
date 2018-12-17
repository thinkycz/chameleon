<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class CenikyCeny extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewCenikyCeny';

    public function cenik()
    {
        return $this->belongsTo(Ceniky::class, 'GUIPriceList', 'GUIPriceList');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function zbozi()
    {
        return $this->belongsTo(Zbozi::class, 'GUICommodity', 'GUICommodity');
    }
}
