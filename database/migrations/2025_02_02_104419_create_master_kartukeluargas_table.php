<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('master_kartukeluargas', function (Blueprint $table) {
            $table->string('no_kk', 16)->primary();
            $table->String('alamat', 255);
            $table->String('rt', 3);
            $table->String('rw', 3);
            $table->string('desa', 30)->default('Rambipuji');
            $table->string('kecamatan', 50)->default('Rambipuji');
            $table->integer('kode_pos')->default(68152);
            $table->string('kabupaten', 30)->default('Jember');
            $table->string('provinsi', 30)->default('Jawa Timur');
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
        Schema::dropIfExists('master_kartukeluargas');
    }
};
