<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'label' => $this->faker->randomElement(['Internal', 'External']),
            'start_date' => $this->faker->date,
            'end_date' => $this->faker->date,
            'user_id' => 1, 
        ];
    }
}
