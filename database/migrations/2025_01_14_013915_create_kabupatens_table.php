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

    Schema::create('master.kabupatens', function (Blueprint $table) {
      $table->char('id', 4)->primary();
      $table->string('nama');
      $table->char('propinsi_id', 2);
      $table->foreign('propinsi_id')
            ->references('id')->on('master.propinsis')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('kabupatens');
  }
};
