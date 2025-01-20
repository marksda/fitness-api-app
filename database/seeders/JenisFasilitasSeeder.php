<?php

namespace Database\Seeders;

use App\Models\JenisFasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JenisFasilitasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    JenisFasilitas::factory()
      ->count(2)
      ->sequence(
        ['id' => '01', 'nama' => 'Umum'],
        ['id' => '02', 'nama' => 'Spesial'],
      )
      ->create();
  }
}
