<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public function ingredientes()
    {
        return $this->belongsToMany('App\Ingrediente');
        //return $this->belongsToMany('Ingrediente','pizzas_ingredientes','pizza_id','ingrediente_id');  
    }
}
