<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('master_dusun', function (Blueprint $table) {
            $table->increments('id_dusun');
            $table->string('nama_dusun', 100)->unique();
            $table->string('nik', 16); 
            $table->string('nama_kasun', 100);
            $table->foreign('nik')->references('nik')->on('master_penduduks')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('master_dusun');
    }
};