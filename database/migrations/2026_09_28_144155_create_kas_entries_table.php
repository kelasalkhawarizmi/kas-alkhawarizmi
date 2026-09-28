<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('kas_entries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('minggu_ke'); // 1, 2, 3, atau 4
            $table->unsignedTinyInteger('bulan');     // 1 s.d. 12
            $table->year('tahun');
            $table->decimal('jumlah', 10, 2)->default(5000);
            $table->date('tanggal_bayar');
            $table->timestamps();

            $table->unique(['student_id', 'minggu_ke', 'bulan', 'tahun']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('kas_entries');
    }
};