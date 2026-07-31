<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Transaction;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'transaction_id' => Transaction::factory(),
            'event_id' => function (array $attributes) {
                return Transaction::find($attributes['transaction_id'])->event_id;
            },
            'partner_id' => function (array $attributes) {
                return Transaction::find($attributes['transaction_id'])->event->partner_id;
            },
            'rating' => $this->faker->numberBetween(3, 5),
            'comment' => $this->faker->sentence(),
        ];
    }
}
