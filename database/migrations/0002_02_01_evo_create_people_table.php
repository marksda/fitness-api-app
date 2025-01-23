<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    DB::statement('CREATE SCHEMA IF NOT EXISTS master');
    Schema::create('master.people', function (Blueprint $table) {
      $table->id();
      $table->string('identifier')->unique();
      $table->string('nama');
      $table->date('tanggal_lahir');
      $table->char('jenis_kelamin_id', 2);
      $table->char('agama_id', 2);
      $table->char('propinsi_id', 2);
      $table->char('kabupaten_id', 4);
      $table->char('kecamatan_id', 7);
      $table->char('desa_id', 10);
      $table->string('alamat');
      $table->char('kode_pos', 5);
      $table->decimal('berat_badan', total: 6, places: 2);
      $table->decimal('tinggi_badan', total: 5, places: 2);
      $table->string('email')->unique();
      $table->string('no_hp', 25);
      $table->timestamps();
      $table->foreign('propinsi_id')
            ->references('id')->on('master.propinsis')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('kabupaten_id')
            ->references('id')->on('master.kabupatens')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('kecamatan_id')
            ->references('id')->on('master.kecamatans')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('desa_id')
            ->references('id')->on('master.desas')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.people');
  }
};
