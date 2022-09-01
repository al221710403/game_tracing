<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Status;
use App\Models\GameEngine;
use Illuminate\Database\Eloquent\Factories\Factory;

class GameFactory extends Factory
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
            'name' => $this->faker->words(rand(3,8),true),
            'description' => $this->faker->paragraphs(rand(2,5),true),
            'background_image' => 'img/game/'. $this->faker->image('public/img/game/',640,480, null, false),
            // 'background_image' => 'game/background_photo/'. $this->faker->image('public/storage/game/background_photo',640,480, null, false),
            'download_site' => 'https://'.$this->faker->word().'.com',
            'status_game_id' => Status::all()->random()->id,
            'game_engine_id' => GameEngine::all()->random()->id,
            'qualification' => rand(1,5),
            'user_id' => User::all()->random()->id,
            'created_at' => $datetime,
            'updated_at' => $datetime
        ];
    }
}
