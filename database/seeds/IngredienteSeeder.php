<?php

use Illuminate\Database\Seeder;
use App\Ingrediente;
use Illuminate\Support\Facades\DB;

class IngredienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Ingrediente::class,50)->create();
    }
}
