<?php

namespace Database\Seeders;

use App\Models\level;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LevelSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    level::factory()
      ->count(3)
      ->sequence(
        ['id' => '01', 'nama' => 'EASY'],
        ['id' => '02', 'nama' => 'MODERATE'],
        ['id' => '03', 'nama' => 'HARD'],
      )
      ->create();
  }
}
