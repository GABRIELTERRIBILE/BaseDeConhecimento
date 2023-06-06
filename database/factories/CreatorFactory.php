<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CreatorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            // 'subject' => $this->faker->subject(),
            'email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
