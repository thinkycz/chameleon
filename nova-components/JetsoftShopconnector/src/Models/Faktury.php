<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Faktury extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewFaktury';

    public function zakaznik()
    {
        return $this->belongsTo(Zakaznici::class, 'GUIClient', 'GUIClient');
    }

    public function fakturyPolozky()
    {
        return $this->hasMany(FakturyPolozky::class, 'Faktura_ID', 'ID');
    }
}
