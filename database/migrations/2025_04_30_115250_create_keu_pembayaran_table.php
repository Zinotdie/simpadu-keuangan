<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keu_pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->string('nim', 20);
            $table->foreignId('id_tagihan')->constrained('keu_tagihan', 'id_tagihan');
            $table->decimal('nominal', 12, 2);
            $table->date('tgl_bayar');
            $table->string('metode_bayar', 50);
            $table->string('bukti_bayar')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keu_pembayaran');
    }
};