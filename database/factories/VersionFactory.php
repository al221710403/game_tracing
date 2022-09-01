<?php

namespace Database\Factories;

use App\Models\Status;
use Illuminate\Database\Eloquent\Factories\Factory;

class VersionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $datetime = $this->faker->dateTimeBetween($startDate = '-'.rand(1,5).' years', $endDate = 'now', $timezone = null);
        return [
            'version' => 'v'. rand(1,10) . rand(1,10) .rand(1,10),
            'comment' => $this->faker->paragraphs(rand(4,6),true),
            'file' => 'storage/game/file.zip',
            'status_id' => Status::all()->random()->id,
            'created_at' => $datetime,
            'updated_at' => $datetime
        ];
    }
}
