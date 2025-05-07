<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('keu_tahun_ajaran', function (Blueprint $table) {
            $table->id('id_tahun');
            $table->string('nama_tahun', 20);
            $table->enum('semester', ['Ganjil', 'Genap']);
            $table->boolean('aktif')->default(true);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('keu_tahun_ajaran');
    }
};