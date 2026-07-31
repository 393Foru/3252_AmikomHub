<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Event;
use App\Models\Transaction;
use App\Mail\ReviewRequestMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendReviewRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-review-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send review request emails to customers a day after the event finishes.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Get events that finished exactly yesterday
        $yesterday = Carbon::yesterday()->toDateString();
        
        $events = Event::whereDate('date', $yesterday)->get();
        
        $count = 0;
        
        foreach ($events as $event) {
            // Get all successful transactions for this event that don't have reviews yet
            $transactions = Transaction::where('event_id', $event->id)
                ->where('status', 'Success')
                ->whereDoesntHave('review')
                ->get();
                
            foreach ($transactions as $transaction) {
                Mail::to($transaction->customer_email)->send(new ReviewRequestMail($transaction));
                $count++;
            }
        }
        
        $this->info("Review requests sent to {$count} customers.");
    }
}
