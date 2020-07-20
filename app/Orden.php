<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orden extends Model
{
    public $timestamps=true;
    // protected $table = 'ordens';

    public function Compras(){
        return $this->hasMany('App\Compra','idOrdenar', 'id')->with('Promocion','Registro','Producto');
        //return $this->hasMany('App\Compra','idOrdenar', 'id')->with(['Promocion']);
    }
    public function TipoPago(){
        return $this->hasOne('App\tipoPago','id', 'idTipoPago');
        //return $this->hasMany('App\Compra','idOrdenar', 'id')->with(['Promocion']);
    }
    public function Estado(){
        return $this->hasOne('App\EstadoVenta','id', 'idestado');
        //return $this->hasMany('App\Compra','idOrdenar', 'id')->with(['Promocion']);
    }
    public function Usuarios(){
        return $this->hasOne('App\User','id', 'idUsuario');
        //return $this->hasMany('App\Compra','idOrdenar', 'id')->with(['Promocion']);
    }
    public function Comprobante(){
        return $this->hasMany('App\Comprobante','idorden', 'id');
        //return $this->hasMany('App\Compra','idOrdenar', 'id')->with(['Promocion']);
    }

}
