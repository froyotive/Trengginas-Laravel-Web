<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_invoice' => Invoice::inRandomOrder()->first()->id_invoice ?? Invoice::factory(),
            'name' => $this->faker->word(),
            'series_item' => $this->faker->unique()->bothify('????-####'),
            'quantity' => $this->faker->randomNumber(4,false),
            'warranty' => $this->faker->dateTime(),
            'location' => $this->faker->sentence(),
        ];
    }
}
