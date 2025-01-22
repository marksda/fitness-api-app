<?php

namespace Database\Seeders;

use App\Models\Club;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClubSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Club::factory()
      ->count(1)
      ->sequence(
        [
          'nama' => 'PURI ZONE-1', 
          'patner_id' => '01',
          'deskripsi' => 'Gym premium GYM HUB hadir untuk semua orang. Memiliki berbagai peralatan modern dan fasilitas yang lengkap. Anda juga dapat memilih untuk berlatih sendiri, dengan pelatih pribadi, atau dengan grup di kelas. Anda akan menemukan segalanya di sini untuk merasakan pengalaman fitness yang terbaik.',
          'propinsi_id' => '35',
          'kabupaten_id' => '3515',
          'kecamatan_id' => '3515110',
          'desa_id' => '3515110020',
          'alamat' => 'Ruko Puri Indah lt. 2 no.4, Jln. Raya Cemengkalang',
          'patner_id' => 1,
          'status_id' => '01'
        ]
      )
      ->create();
  }
}
