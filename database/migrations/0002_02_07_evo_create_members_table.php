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
    Schema::create('master.members', function (Blueprint $table) {
      $table->id();
      $table->bigInteger('person_id');
      $table->bigInteger('club_id');
      $table->char('status_id', 2);
      $table->bigInteger('user_id');
      $table->timestamps();
      $table->foreign('person_id')
            ->references('id')->on('master.people')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('club_id')
            ->references('id')->on('master.clubs')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('status_id')
            ->references('id')->on('master.statuses')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
      $table->foreign('user_id')
            ->references('id')->on('public.user_id')
            ->cascadeOnUpdate()
            ->restrictOnDelete();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('master.members');
  }
};
