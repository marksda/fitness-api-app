<?php

namespace Database\Seeders;

use App\Models\KelasKategori;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    KelasKategori::factory()
      ->count(4)
      ->sequence(
        ['id' => '01', 'nama' => 'Mind & Body'],
        ['id' => '02', 'nama' => 'Cardio'],
        ['id' => '03', 'nama' => 'Strength'],
        ['id' => '04', 'nama' => 'Dance'],
      )
      ->create();
  }
}
