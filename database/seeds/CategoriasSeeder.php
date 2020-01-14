<?php

use Illuminate\Database\Seeder;
use App\Models\Productos\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Categoria::create(['nombre' => 'Bazar']);
        Categoria::create(['nombre' => 'Decoración']);
        Categoria::create(['nombre' => 'Eventos']);
        Categoria::create(['nombre' => 'Regalería']);
        Categoria::create(['nombre' => 'Artículos de temporada']);
        Categoria::create(['nombre' => 'Textil']);
        Categoria::create(['nombre' => 'Otros']);
    }
}
