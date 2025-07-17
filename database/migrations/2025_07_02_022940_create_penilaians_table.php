<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('penilaian', function (Blueprint $table) {
            $table->engine = 'InnoDB'; // Pastikan menggunakan InnoDB

            $table->id();

            // Perbaikan: Tentukan nama tabel referensi secara eksplisit
            $table->foreignId('pengajuan_magang_id')
                  ->constrained('pengajuan_magang') // Pastikan nama tabel benar
                  ->onDelete('cascade');

            $table->foreignId('mahasiswa_id')
                  ->constrained('mahasiswa')
                  ->onDelete('cascade');

            $table->foreignId('pembimbing_id')
                  ->constrained('pembimbing')
                  ->onDelete('cascade');

            $table->string('aspek_penilaian');
            $table->decimal('nilai', 5, 2);
            $table->decimal('bobot', 5, 2);
            $table->text('keterangan')->nullable();
            $table->decimal('nilai_akhir', 5, 2);
            $table->string('grade');
            $table->timestamp('tanggal_penilaian');
            $table->timestamps();

            // Tambahkan index untuk performa
            $table->index('pengajuan_magang_id');
            $table->index('mahasiswa_id');
            $table->index('pembimbing_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('penilaian');
    }
};
