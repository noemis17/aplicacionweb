<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TipoPromocion extends Model
{
    public function registro()
    {
        return $this->hasMany('App\RegistroPromociones', 'idTipoPromocion', 'id');
    } 
}
