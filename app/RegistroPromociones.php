<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegistroPromociones extends Model
{
    public function tipoPromocion()
    {
        return $this->hasMany('App\TipoPromocion', 'id', 'idTipoPromocion');
    } 
    public function tipoPromocion1()
    {
        return $this->hasOne('App\TipoPromocion', 'id', 'idTipoPromocion');
    } 
    public function kits()
    {
        return $this->hasMany('App\kit', 'idRegistro', 'id');
    } 
}
