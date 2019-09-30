<?php

use App\Http\Controllers\IngredienteController;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(IngredienteSeeder::class);
    }
}
