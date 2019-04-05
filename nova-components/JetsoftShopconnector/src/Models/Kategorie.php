<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Kategorie extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewKategorie';

    public function parent()
    {
        return $this->belongsTo(Kategorie::class, 'GUIparent', 'GUIparent');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziKategorie()
    {
        return $this->hasMany(ZboziKategorie::class, 'GUICategory', 'GUICategory');
    }

    public function zbozi()
    {
        return $this->hasManyThrough(Zbozi::class, ZboziKategorie::class, 'GUICategory', 'GUICommodity', 'GUICategory', 'GUICommodity');
    }
}
