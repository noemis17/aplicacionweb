<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promociones extends Model
{
    public function tipoPromociones()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\TipoPromocion', 'id', 'idTipoProducto');
    }
    //public function  PromocionesProducto(){
       // return $this->hasMany('App\ProductoPromociones','idPromociones', 'id')->with("Producto");
    //}
    
}
