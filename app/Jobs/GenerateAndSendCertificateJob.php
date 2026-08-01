<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Transaction;
use App\Mail\EventCertificateMail;
use Illuminate\Support\Facades\Mail;
use Barryvdh\DomPDF\Facade\Pdf;

class GenerateAndSendCertificateJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $transaction;

    /**
     * Create a new job instance.
     */
    public function __construct(Transaction $transaction)
    {
        $this->transaction = $transaction;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Hindari pengiriman ganda
        if ($this->transaction->certificate_sent) {
            return;
        }

        // Render PDF
        $pdf = Pdf::loadView('pdf.certificate', ['transaction' => $this->transaction])
                  ->setPaper('a4', 'landscape');
        
        $pdfContent = $pdf->output();

        // Kirim Email
        Mail::to($this->transaction->customer_email)
            ->send(new EventCertificateMail($this->transaction, $pdfContent));

        // Update status sent
        $this->transaction->update([
            'certificate_sent' => true
        ]);
    }
}
