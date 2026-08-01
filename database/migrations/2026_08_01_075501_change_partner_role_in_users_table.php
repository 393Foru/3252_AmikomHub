<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Change role of existing partners to 'partner'
        \Illuminate\Support\Facades\DB::table('users')
            ->where('role', 'admin')
            ->whereNotNull('partner_id')
            ->update(['role' => 'partner']);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert role of partners back to 'admin'
        \Illuminate\Support\Facades\DB::table('users')
            ->where('role', 'partner')
            ->whereNotNull('partner_id')
            ->update(['role' => 'admin']);
    }
};
