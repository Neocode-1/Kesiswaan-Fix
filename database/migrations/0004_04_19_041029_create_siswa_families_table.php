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
        Schema::create('siswa_families', function (Blueprint $table) {
            $table->id();
            $table->string('status_keluarga')->nullable();
            $table->integer('anak_ke')->nullable();
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->text('alamat_ayah')->nullable();
            $table->text('alamat_ibu')->nullable();
            $table->string('no_telp_ayah', 20)->nullable();
            $table->string('no_telp_ibu', 20)->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->text('alamat_wali')->nullable();
            $table->string('no_telp_wali', 20)->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->unsignedBigInteger('siswa_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswa_families');
    }
};
