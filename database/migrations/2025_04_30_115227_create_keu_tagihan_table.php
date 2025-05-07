<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keu_tagihan', function (Blueprint $table) {
            $table->id('id_tagihan');
            $table->string('nim', 20);
            $table->foreignId('id_jenis')->constrained('keu_jenis_tagihan', 'id_jenis');
            $table->foreignId('id_tahun')->constrained('keu_tahun_ajaran', 'id_tahun');
            $table->decimal('nominal', 12, 2);
            $table->enum('status_tagihan', ['Lunas', 'Belum Lunas'])->default('Belum Lunas');
            $table->date('tgl_terbit');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keu_tagihan');
    }
};