<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */

    // ===================================================================
    // responsi UAS
    public function up(): void
    {
        Schema::create('jabatans', function (Blueprint $table) {
            $table->id(); // Sesuai dengan BIGINT
            $table->string('name', 100);
            $table->string('created_by', 100)->nullable();
            $table->string('updated_by', 100)->nullable();
            $table->timestamps(); // Otomatis membuat created_at dan updated_at
        });
    }
    // ===================================================================

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jabatans');
    }
};
