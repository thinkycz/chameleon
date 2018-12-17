<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class FakturyPolozky extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewFakturyPolozky';

    public function faktura()
    {
        return $this->belongsTo(Faktury::class, 'Faktura_ID', 'ID');
    }
}
