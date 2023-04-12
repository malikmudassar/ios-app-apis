<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lat = $this->faker->latitude($min = 31.392746397382727, $max = 31.643518267451505);
        $lng = $this->faker->longitude($min =  74.15663206371892, $max = 74.52354187517167);

        return [
            'name' => $this->faker->city(),
            'latitude' => $lat,
            'longitude' => $lng
        ];
    }
}
