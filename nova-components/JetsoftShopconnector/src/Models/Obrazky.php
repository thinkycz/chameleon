<?php

namespace Nulisec\JetsoftShopconnector\Models;

use App\Helpers\Tools\ExtensionMimeType;
use Illuminate\Database\Eloquent\Model;

class Obrazky extends Model
{
    protected $connection = 'shopconnector';
    protected $table = 'S5JET_SCS5_ViewObrazky';

    public function zbozi()
    {
        return $this->belongsTo(Zbozi::class, 'GUICommodity', 'GUICommodity');
    }

    public function obchod()
    {
        return $this->belongsTo(Obchody::class, 'GUIeShop', 'GUIeShop');
    }

    public function getImage()
    {
        $base64 = base64_encode($this->Data);
        $mime = ExtensionMimeType::getMimeTypeFromFilename($this->sFileName);
        return "data:{$mime};base64,{$base64}";
    }
}
