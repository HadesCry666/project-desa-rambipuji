<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_surat', function (Blueprint $table) {
            $table->string('id_surat');
            $table->primary('id_surat');
            $table->string('nama_surat');
            $table->string('slug', 50);
            $table->string('keterangan', 50);
            $table->string('berkas1', 50)->nullable();
            $table->string('berkas2', 50)->nullable();
            $table->string('berkas3', 50)->nullable();
            $table->string('berkas4', 50)->nullable();
            $table->string('berkas5', 50)->nullable();
            $table->string('berkas6', 50)->nullable();
            $table->string('berkas7', 50)->nullable();
            $table->string('berkas8', 50)->nullable();
            $table->string('berkas9', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_surat');
    }
};