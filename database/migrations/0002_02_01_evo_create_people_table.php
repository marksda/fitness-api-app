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
      $table->char('jenis_kelamin_id', 2);
      $table->char('agama_id', 2);
      $table->char('propinsi_id', 2);
      $table->char('kabupaten_id', 4);
      $table->char('kecamatan_id', 7);
      $table->char('desa_id', 10);
      $table->string('alamat');
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
