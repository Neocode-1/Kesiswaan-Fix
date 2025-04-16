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
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('nisn')->unique();
            $table->string('ttl');
            $table->enum('jenis_kelamin', ['L', 'P']); // enum, misalnya 'L' atau 'P'
            $table->string('agama');
            $table->string('sklh_asal');
            $table->string('tgl_masuk');
            $table->string('tgl_keluar')->nullable(); // bisa kosong
            $table->string('status_klrga');
            $table->smallInteger('anak_ke');
            $table->string('alamat');
            $table->string('telp_rumah')->nullable();
            $table->string('status_pip');

            // Data ortu
            $table->string('nama_ortu')->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('pekerjaan')->nullable();

            // Data wali
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
