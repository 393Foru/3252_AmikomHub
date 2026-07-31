<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all existing transactions that don't have reviews yet
        $transactions = Transaction::whereDoesntHave('review')->get();

        foreach ($transactions as $transaction) {
            // Only seed reviews for some transactions
            if (rand(0, 1) === 1) {
                Review::create([
                    'transaction_id' => $transaction->id,
                    'event_id' => $transaction->event_id,
                    'partner_id' => $transaction->event->partner_id,
                    'rating' => rand(3, 5),
                    'comment' => 'Acara ini sangat luar biasa! Sangat merekomendasikan.',
                ]);
            }
        }
    }
}
