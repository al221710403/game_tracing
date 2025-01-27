<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'Español',
        ]);

        Language::create([
            'name' => 'Ingles',
        ]);

        Language::create([
            'name' => 'Japones',
        ]);
    }
}
