<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Status::factory()
      ->count(2)
      ->sequence(
        ['id' => '01', 'nama' => 'AKTIF'],
        ['id' => '02', 'nama' => 'NON AKTIF']
      )
      ->create();
  }
}
