<?php

namespace Database\Seeders;

use App\Models\Kelas;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KelasSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Kelas::factory()
      ->count(21)
      ->sequence(
        ['id' => '01', 'nama' => 'VINYASA YOGA', 'kelas_kategori_id' => '01', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '02', 'nama' => 'KAPHA YOGA', 'kelas_kategori_id' => '01', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '03', 'nama' => 'LADIES STYLE BACHATA', 'kelas_kategori_id' => '01', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '04', 'nama' => 'THAI BOXING', 'kelas_kategori_id' => '01', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '05', 'nama' => 'ZUMBA', 'kelas_kategori_id' => '01', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '06', 'nama' => 'BODYCOMBAT', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '07', 'nama' => 'FIT CYCLE', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '08', 'nama' => 'STRONG NATION', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '09', 'nama' => 'POUND FIT', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '10', 'nama' => 'MAT PILATES', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '11', 'nama' => 'FIT RUSH', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '12', 'nama' => 'PILOXING', 'kelas_kategori_id' => '02', 'durasi' => '60 MIN', 'level_id' => '01'],
        ['id' => '13', 'nama' => 'HIIT', 'kelas_kategori_id' => '03', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '14', 'nama' => 'CORE', 'kelas_kategori_id' => '03', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '15', 'nama' => 'CIRCUIT', 'kelas_kategori_id' => '03', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '16', 'nama' => 'BOOTY SHAPING', 'kelas_kategori_id' => '03', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '17', 'nama' => 'BOOTCAMP', 'kelas_kategori_id' => '03', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '18', 'nama' => 'HIP HOP DANCE', 'kelas_kategori_id' => '04', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '19', 'nama' => 'FREESTYLE DANCE', 'kelas_kategori_id' => '04', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '20', 'nama' => 'CARDIO DANCE', 'kelas_kategori_id' => '04', 'durasi' => '60 MIN', 'level_id' => '02'],
        ['id' => '21', 'nama' => 'BELLY DANCE', 'kelas_kategori_id' => '04', 'durasi' => '60 MIN', 'level_id' => '02'],
      )
      ->create();
  }
}
