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
        if (!Schema::hasColumn('master_pengajuan', 'no_registrasi')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->string('no_registrasi', 100)->nullable()->after('id_surat');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('master_pengajuan', 'no_registrasi')) {
            Schema::table('master_pengajuan', function (Blueprint $table) {
                $table->dropColumn('no_registrasi');
            });
        }
    }
};
