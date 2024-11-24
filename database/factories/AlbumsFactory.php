<?php

namespace Database\Factories;

use App\Models\Albums;
use Illuminate\Database\Eloquent\Factories\Factory;

class AlbumsFactory extends Factory
{
    protected $model = Albums::class;

    public function definition()
    {
        return [
            'artist_id' => $this->faker->numberBetween(1, 100),
            'artist_twitter' => '@' . $this->faker->userName,
            'artist_name' => $this->faker->name,
            'name' => $this->faker->word,
        ];
    }
}
