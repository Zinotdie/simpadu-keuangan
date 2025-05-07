<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keu_keringanan', function (Blueprint $table) {
            $table->id('id_keringanan');
            $table->string('nim', 20);
            $table->foreignId('id_tahun')->constrained('keu_tahun_ajaran', 'id_tahun');
            $table->string('jenis_keringanan', 50);
            $table->decimal('jumlah_potongan', 12, 2);
            $table->text('deskripsi_keringanan')->nullable();
            $table->enum('status_keringanan', ['Disetujui', 'Ditolak', 'Menunggu'])->default('Menunggu');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keu_keringanan');
    }
};