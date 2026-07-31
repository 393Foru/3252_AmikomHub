<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Review;

class ReviewController extends Controller
{
    public function create(Request $request, Transaction $transaction)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'Invalid or expired review link.');
        }

        // Check if review already exists
        if ($transaction->review) {
            return view('reviews.success')->with('message', 'Anda sudah memberikan review untuk event ini. Terima kasih!');
        }

        return view('reviews.create', compact('transaction'));
    }

    public function store(Request $request, Transaction $transaction)
    {
        if (! $request->hasValidSignature()) {
            abort(401, 'Invalid or expired review link.');
        }

        if ($transaction->review) {
            return redirect()->route('home')->with('error', 'Review sudah pernah diberikan.');
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000'
        ]);

        Review::create([
            'transaction_id' => $transaction->id,
            'event_id' => $transaction->event_id,
            'partner_id' => $transaction->event->partner_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return view('reviews.success')->with('message', 'Terima kasih atas review Anda! Masukan Anda sangat berharga bagi kami.');
    }
}
