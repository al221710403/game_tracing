<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Language;
use App\Models\Version;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        DB::table('game_languages')->truncate(); // Eliminar datos de tabla
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Reactivamos la revisión de claves foráneas

        $games = Game::factory(20)->create();

        foreach ($games as $game) {
            $count = rand(1,5);
            $countLanguage = rand(1,3);

            for ($i=0; $i <= $count ; $i++) {
                Version::factory(1)->create([
                    'game_id' => $game->id,
                ]);
            }

            for ($i=0; $i <= $countLanguage ; $i++) {
                DB::table('game_languages')->insert([
                    'game_id' => $game->id,
                    'language_id' => Language::all()->random()->id
                ]);
            }
        }
    }
}
