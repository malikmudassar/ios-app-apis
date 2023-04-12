<?php

namespace Database\Factories;

use App\Models\ProfileCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

class ProfileCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     * @var string
     */
    protected $model = ProfileCategory::class;

    /**
     * @return array
     */
    public function definition()
    {
        return [
            'category_name' => $this->faker->randomElement(['Personal Information', 'Work Information', 'Educational Information']),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
