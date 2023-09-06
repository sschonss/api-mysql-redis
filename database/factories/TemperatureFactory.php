<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Temperature>
 */
class TemperatureFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [

            'created_at' => now(),
            'sensor_01' => $this->faker->randomFloat(2, -200, 300),
            'sensor_02' => $this->faker->randomFloat(2, -200, 300),
            'sensor_03' => $this->faker->randomFloat(2, -200, 300),
            'sensor_04' => $this->faker->randomFloat(2, -200, 300),
            'sensor_05' => $this->faker->randomFloat(2, -200, 300),
            'sensor_06' => $this->faker->randomFloat(2, -200, 300),
            'sensor_07' => $this->faker->randomFloat(2, -200, 300),
            'sensor_08' => $this->faker->randomFloat(2, -200, 300),
            'sensor_09' => $this->faker->randomFloat(2, -200, 300),
            'sensor_10' => $this->faker->randomFloat(2, -200, 300),
            'sensor_11' => $this->faker->randomFloat(2, -200, 300),
            'sensor_12' => $this->faker->randomFloat(2, -200, 300),
            'sensor_13' => $this->faker->randomFloat(2, -200, 300),
            'sensor_14' => $this->faker->randomFloat(2, -200, 300),
            'sensor_15' => $this->faker->randomFloat(2, -200, 300),
        ];
    }
}
