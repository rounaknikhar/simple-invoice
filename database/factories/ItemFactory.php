<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(), 
            'amount_value' => fake()->randomDigit(1), 
            'amount_type' => 'qty', 
            'amount_cost' => fake()->randomFloat(1, 10, 100),
            'invoice_id' => Invoice::first()->id,
        ];
    }
}
