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
      Schema::create('master.kelas_kategori', function (Blueprint $table) {
        $table->char('id', 2)->primary();
        $table->string('nama');
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      Schema::dropIfExists('master.kelas_kategori');
    }
};
