<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Pizza extends Model
{

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function ingredientes()
    {
        return $this->belongsToMany('App\Ingrediente','pizzas_ingredientes','pizza_id','ingrediente_id');
    }
}
