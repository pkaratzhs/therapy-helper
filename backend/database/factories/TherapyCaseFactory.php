<?php

namespace Database\Factories;

use App\Models\TherapyCase;
use Illuminate\Database\Eloquent\Factories\Factory;

class TherapyCaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = TherapyCase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'diagnosis' => $this->faker->sentence(),
            'finished' => false,
        ];
    }
}
