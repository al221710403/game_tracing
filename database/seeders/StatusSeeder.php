<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Status::create([
            'status' => 'Sin estado',
            'color' => 'gray'
        ]);

        Status::create([
            'status' => 'Finalizado',
            'color' => 'blue'
        ]);

        Status::create([
            'status' => 'En proceso',
            'color' => 'yellow'
        ]);

        Status::create([
            'status' => 'Detenido',
            'color' => 'red'
        ]);
    }
}
