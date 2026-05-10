<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('notifikasi_pengajuan', function (Blueprint $table) {

            $table->increments('id');

            $table->string('nik', 16);

            $table->enum('jenis', [
                'pengajuan',
                'pengaduan'
            ]);

            $table->integer('id_ref');

            $table->text('pesan');

            $table->timestamp('created_at')
                  ->useCurrent();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi_pengajuan');
    }
};