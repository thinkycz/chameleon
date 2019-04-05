<?php

namespace Nulisec\JetsoftShopconnector\Models;

use Illuminate\Database\Eloquent\Model;

class Obchody extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewObchody';

    public function obchodyJazyky()
    {
        return $this->hasMany(ObchodyJazyky::class, 'GUIeShop', 'GUIeShop');
    }

    public function ceniky()
    {
        return $this->hasMany(Ceniky::class, 'GUIeShop', 'GUIeShop');
    }

    public function cenikyCeny()
    {
        return $this->hasMany(CenikyCeny::class, 'GUIeShop', 'GUIeShop');
    }

    public function dopravaPlatba()
    {
        return $this->hasMany(DopravaPlatba::class, 'GUIeShop', 'GUIeShop');
    }

    public function kategorie()
    {
        return $this->hasMany(Kategorie::class, 'GUIeShop', 'GUIeShop');
    }

    public function vychoziKategorie()
    {
        return $this->belongsTo(Kategorie::class, 'VychoziKategorie_ID', 'VychoziKategorie_ID');
    }

    public function obrazky()
    {
        return $this->hasMany(Obrazky::class, 'GUIeShop', 'GUIeShop');
    }

    public function parametryHodnoty()
    {
        return $this->hasMany(ParametryHodnoty::class, 'GUIeShop', 'GUIeShop');
    }

    public function parametryNazvy()
    {
        return $this->hasMany(ParametryNazvy::class, 'GUIeShop', 'GUIeShop');
    }

    public function vyrobci()
    {
        return $this->hasMany(Vyrobci::class, 'GUIeShop', 'GUIeShop');
    }

    public function zakaznici()
    {
        return $this->hasMany(Zakaznici::class, 'GUIeShop', 'GUIeShop');
    }

    public function zakazniciOsoby()
    {
        return $this->hasMany(ZakazniciOsoby::class, 'GUIeShop', 'GUIeShop');
    }

    public function zbozi()
    {
        return $this->hasMany(Zbozi::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziAlternativni()
    {
        return $this->hasMany(ZboziAlternativni::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziDoplnky()
    {
        return $this->hasMany(ZboziDoplnky::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziKategorie()
    {
        return $this->hasMany(ZboziKategorie::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziSety()
    {
        return $this->hasMany(ZboziSety::class, 'GUIeShop', 'GUIeShop');
    }

    public function zboziSkladem()
    {
        return $this->hasMany(ZboziSkladem::class, 'GUIeShop', 'GUIeShop');
    }
}
