<?php

namespace Database\Seeders;

use App\Models\Kecamatan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KecamatanSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csvFile = fopen(base_path('database/data/tbl_kecamatan_202501160616.csv'), 'r');
    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
      if (! $firstline) {
        Kecamatan::create([
          'id' => $data['0'],
          'kabupaten_id' => $data['1'],
          'nama' => $data['2'],
        ]);
      }
      $firstline = false;
    }
    fclose($csvFile);
  }
}
