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
    Schema::create('master.kelas', function (Blueprint $table) {
      $table->char('id', 2)->primary();
      $table->string('nama');
      $table->char('kelas_kategori_id', 2);
      $table->string('durasi');
      $table->char('level_id', 2);
      $table->foreign('kelas_kategori_id')
            ->references('id')->on('master.kelas_kategori')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('level_id')
            ->references('id')->on('master.levels')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.kelas');
  }
};
