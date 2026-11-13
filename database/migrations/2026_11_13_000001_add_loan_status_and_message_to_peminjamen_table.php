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
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->integer('jumlah_pinjam')->default(1);
            $table->text('alasan_peminjaman')->nullable();
            $table->string('status')->default('menunggu');
            $table->text('pesan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('peminjamen', function (Blueprint $table) {
            $table->dropColumn(['jumlah_pinjam', 'alasan_peminjaman', 'status', 'pesan']);
        });
    }
};
