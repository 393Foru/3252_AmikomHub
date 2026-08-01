<?php

namespace App\Console\Commands;

use App\Models\Transaction;
use App\Services\WhatsAppService;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RecoverAbandonedCartCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:recover-abandoned-cart';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Recover abandoned carts by sending a WhatsApp payment reminder to the user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Cari transaksi yang pending dan umurnya antara 15 menit s/d 60 menit
        $abandonedTransactions = Transaction::with('event')
            ->whereIn('status', ['Pending', 'pending'])
            ->where('recovery_sent', false)
            ->where('created_at', '<', Carbon::now()->subMinutes(15))
            ->where('created_at', '>', Carbon::now()->subMinutes(60))
            ->get();

        $count = $abandonedTransactions->count();

        if ($count === 0) {
            $this->info("Tidak ada transaksi abandoned cart saat ini.");
            return;
        }

        $this->info("Ditemukan {$count} transaksi abandoned cart. Memulai pengiriman pengingat...");

        $waService = app(WhatsAppService::class);

        foreach ($abandonedTransactions as $transaction) {
            try {
                $waService->sendPaymentReminder($transaction);
                
                // Tandai bahwa recovery sudah dikirim
                $transaction->update(['recovery_sent' => true]);
                
                $this->info("Pengingat berhasil dikirim ke pesanan {$transaction->order_id}.");
            } catch (\Exception $e) {
                $this->error("Gagal mengirim pengingat ke {$transaction->order_id}: " . $e->getMessage());
            }
        }

        $this->info("Selesai memproses abandoned cart.");
    }
}
