<?php

namespace Database\Seeders;

use App\Models\GameEngine;
use Illuminate\Database\Seeder;

class GameEngineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        GameEngine::create([
            'name' => 'RPG Maker'
        ]);

        GameEngine::create([
            'name' => "Ren 'Py"
        ]);

        GameEngine::create([
            'name' => 'Unity'
        ]);

        GameEngine::create([
            'name' => "KiriKiri"
        ]);

        GameEngine::create([
            'name' => "Suika 2"
        ]);

        GameEngine::create([
            'name' => "No Definido"
        ]);
    }
}
