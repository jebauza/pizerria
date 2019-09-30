<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{
    public function pizzas()
    {
        return $this->belongsToMany('App\Pizza');
        //return $this->belongsToMany('Ingrediente','pizzas_ingredientes','pizza_id','ingrediente_id');
    }
}
