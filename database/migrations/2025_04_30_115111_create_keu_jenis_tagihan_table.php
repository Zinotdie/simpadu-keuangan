<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keu_jenis_tagihan', function (Blueprint $table) {
            $table->id('id_jenis');
            $table->string('nama_jenis_tagihan', 100);
            $table->text('deskripsi_tagihan')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keu_jenis_tagihan');
    }
};