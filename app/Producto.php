<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps=false;
    
    protected $fillable = [
        'id_foraneo','NAME','PRICE','IDBRAND','MARCA', 'PESOITEM', 'stock',
    ];
    public function  PromocionesProducto(){
        return $this->hasMany('App\ProductoPromociones','idProducto', 'id')->with("Promociones");
    }
    public function  PromocionesProducto2(){
        return $this->hasMany('App\ProductoPromociones','idProducto', 'id')->with("Promocion")->where('estado_del' , '1');
    }
    public function  PromocionesdelProducto(){
        return $this->hasMany('App\PromocionDelProducto', 'idProducto', 'id')->where('estado_del' , '1');
    }
    
}

