<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pengembalian', 50)->unique();
            $table->foreignId('peminjaman_id')->constrained('peminjamans')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('petugas_id')->nullable()->constrained('users')->nullOnDelete();
            $table->date('tgl_kembali_real');
            $table->integer('terlambat_hari')->default(0);
            $table->decimal('denda_terlambat', 12, 2)->default(0);
            $table->enum('kondisi_alat', ['Baik', 'Rusak Ringan', 'Rusak Berat', 'Hilang'])->default('Baik');
            $table->decimal('denda_kerusakan', 12, 2)->default(0);
            $table->decimal('total_denda', 12, 2)->default(0);
            $table->enum('status_denda', ['lunas', 'belum_lunas', 'tidak_ada_denda'])->default('tidak_ada_denda');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
