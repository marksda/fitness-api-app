<?php

namespace Database\Seeders;

use App\Models\Fasilitas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FasilitasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Fasilitas::factory()
      ->count(10)
      ->sequence(
        ['id' => '01', 'nama' => 'MATRAS', 'jenis_fasilitas_id' => '01'],
        ['id' => '02', 'nama' => 'FREE WEIGHTS', 'jenis_fasilitas_id' => '01'],
        ['id' => '03', 'nama' => 'TOILET', 'jenis_fasilitas_id' => '01'],
        ['id' => '04', 'nama' => 'RUANG TUNGGU', 'jenis_fasilitas_id' => '01'],
        ['id' => '05', 'nama' => 'LOCKER', 'jenis_fasilitas_id' => '01'],
        ['id' => '06', 'nama' => 'RIPSTICK', 'jenis_fasilitas_id' => '01'],
        ['id' => '07', 'nama' => 'CHARGING', 'jenis_fasilitas_id' => '01'],
        ['id' => '08', 'nama' => 'SHOWER ROOM', 'jenis_fasilitas_id' => '01'],
        ['id' => '09', 'nama' => 'RUANG GANTI', 'jenis_fasilitas_id' => '01'],
        ['id' => '10', 'nama' => 'BOXING AREA', 'jenis_fasilitas_id' => '02'],
      )
      ->create();
  }
}
