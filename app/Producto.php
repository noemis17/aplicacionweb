<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    public $timestamps=false;
    
    protected $fillable = [
        'id_foraneo','NAME','PRICE','IDBRAND','MARCA', 'PESOITEM', 'stock',
    ];
}
