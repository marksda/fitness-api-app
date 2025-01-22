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
    Schema::create('master.clubs', function (Blueprint $table) {
      $table->id();
      $table->string('nama');
      $table->longText('deskripsi');
      $table->char('propinsi_id', 2);
      $table->char('kabupaten_id', 4);
      $table->char('kecamatan_id', 7);
      $table->char('desa_id', 10);
      $table->string('alamat');
      $table->bigInteger('patner_id');
      $table->char('status_id', 2);
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
      $table->foreign('patner_id')
            ->references('id')->on('master.patners')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('status_id')
            ->references('id')->on('master.statuses')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.clubs');
  }
};
