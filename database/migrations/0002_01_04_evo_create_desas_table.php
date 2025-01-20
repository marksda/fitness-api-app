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
    Schema::create('master.desas', function (Blueprint $table) {
      $table->char('id', 10)->primary();
      $table->string('nama');
      $table->char('kecamatan_id', 7);
      $table->foreign('kecamatan_id')
            ->references('id')->on('master.kecamatans')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.desas');
  }
};
