<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $lat = $this->faker->latitude($min = 24.555059, $max = 49.014817);
        $lng = $this->faker->longitude($min = -125.142753, $max = -66.925779);

        return [
            'fname' => $this->faker->firstName,
            'email' => $this->faker->email,
            'apple_id' => $this->faker->unique()->md5,
            'age' => $this->faker->numberBetween($min = 18, $max = 60),
            'birth_month' => $this->faker->monthName($max = 'now'),
            'birth_day' => $this->faker->numberBetween($min = 1, $max = 31),
            'occupation' => $this->faker->jobTitle,
            'purpose' => $this->faker->sentence($nbWords = 6, $variableNbWords = true),
            'source' => $this->faker->randomElement(['google', 'apple']),
            'lat' => $lat,
            'lng' => $lng,
            'device_id' => $this->faker->numberBetween($min = 18, $max = 60),
            'attraction' => $this->faker->randomElement(['Men','women','girl','Boy','other']),
            'pref_profile_view' => $this->faker->randomElement(['yes','no']),
            'subsc_package' => $this->faker->randomElement([0,1]),
            'Zodic_sign' => $this->faker->randomElement(['yes','no'])
        ];
    }
}
