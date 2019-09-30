<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingrediente extends Model
{

    protected $fillable = [
        'nombre','precio'
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function pizzas()
    {
        return $this->belongsToMany('App\Pizza','pizzas_ingredientes','ingrediente_id','pizza_id');
    }
}
