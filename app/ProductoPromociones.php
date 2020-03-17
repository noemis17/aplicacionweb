<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductoPromociones extends Model
{
    public function Promociones()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Promociones', 'id', 'idPromociones');
    }   
    public function Productos()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Producto', 'id', 'idProducto');
    } 
    public function Producto()
    {
        //return $this->hasOne('App\Phone', 'foreign_key', 'local_key');
        return $this->hasOne('App\Producto', 'id', 'idProducto');
    }   
}
