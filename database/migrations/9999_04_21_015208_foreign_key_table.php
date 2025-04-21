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
        Schema::table('klasifikasis', function (Blueprint $table) {
            $table->foreign('admin_id')->after('id')->references('id')->on('users')->onDelete('set null');
        });
        Schema::table('siswas', function (Blueprint $table) {
            $table->foreign('admin_id')->after('id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('klasifikasi_id')->after('admin_id')->references('id')->on('klasifikasis')->onDelete('set null');
        });
        Schema::table('siswa_families', function (Blueprint $table) {
            $table->foreign('siswa_id')->after('id')->references('id')->on('siswas')->onDelete('set null');
        });
        Schema::table('raports', function (Blueprint $table) {
            $table->foreign('admin_id')->after('id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('klasifikasi_id')->after('admin_id')->references('id')->on('klasifikasis')->onDelete('set null');
            $table->foreign('siswa_id')->after('klasifikasi_id')->references('id')->on('siswas')->onDelete('set null');
        });
        Schema::table('ijazahs', function (Blueprint $table) {
            $table->foreign('admin_id')->after('id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('klasifikasi_id')->after('admin_id')->references('id')->on('klasifikasis')->onDelete('set null');
            $table->foreign('siswa_id')->after('klasifikasi_id')->references('id')->on('siswas')->onDelete('set null');
        });
        Schema::table('prestasis', function (Blueprint $table) {
            $table->foreign('siswa_id')->after('klasifikasi_id')->references('id')->on('siswas')->onDelete('set null');
        });
        Schema::table('absensis', function (Blueprint $table) {
            $table->foreign('admin_id')->after('id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('klasifikasi_id')->after('admin_id')->references('id')->on('users')->onDelete('set null');
        });
        
        Schema::table('kelas', function (Blueprint $table) {
            $table->foreign('absensi_id')->after('id')->references('id')->on('absensis')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
