<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Zbozi extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewZbozi';

    protected $appends = ['quantityInStock'];

    public function getQuantityInStockAttribute()
    {
        if (!$this->zboziSkladem) return 0;

        $skladem = $this->zboziSkladem->sum('nStore');

        return $skladem > 0 ? $skladem : 0;
    }

    public function parent()
    {
        return $this->belongsTo(Zbozi::class, 'GUICommodity_Parent', 'GUICommodity_Parent');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function vyrobce()
    {
        return $this->belongsTo(Vyrobci::class, 'GUIProducer', 'GUIProducer');
    }

    public function parametrNazev()
    {
        return $this->belongsTo(ParametryNazvy::class, 'GUIParamName_Category', 'GUIParamName_Category');
    }

    public function parametrHodnota()
    {
        return $this->belongsTo(ParametryHodnoty::class, 'GUIParamValue_Category', 'GUIParamValue_Category');
    }

    public function zboziAlternativni()
    {
        return $this->hasMany(ZboziAlternativni::class, 'GUICommodity', 'GUICommodity');
    }

    public function zboziDoplnky()
    {
        return $this->hasMany(ZboziDoplnky::class, 'GUICommodity', 'GUICommodity');
    }

    public function zboziParametryHodnoty()
    {
        return $this->hasMany(ZboziParametryHodnoty::class, 'GUICommodity', 'GUICommodity');
    }

    public function zboziSety()
    {
        return $this->hasMany(ZboziSety::class, 'GUICommodity', 'GUICommodity');
    }

    public function zboziSkladem()
    {
        return $this->hasMany(ZboziSkladem::class, 'GUICommodity', 'GUICommodity');
    }

    public function zboziKategorie()
    {
        return $this->hasMany(ZboziKategorie::class, 'GUICommodity', 'GUICommodity');
    }

    public function kategorie()
    {
        return $this->hasManyThrough(Kategorie::class, ZboziKategorie::class, 'GUICommodity', 'GUICategory', 'GUICommodity', 'GUICategory');
    }

    public function obrazky()
    {
        return $this->hasMany(Obrazky::class, 'GUICommodity', 'GUICommodity');
    }

    public function cenikyCeny()
    {
        return $this->hasMany(CenikyCeny::class, 'GUICommodity', 'GUICommodity');
    }
}
