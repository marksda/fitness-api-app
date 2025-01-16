<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DesaSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csvFile = fopen(base_path('database/data/tbl_desa_202501160641.csv'), 'r');
    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
      if (! $firstline) {
        Desa::create([
          'id' => $data['0'],
          'kecamatan_id' => $data['1'],
          'nama' => $data['2'],
        ]);
      }
      $firstline = false;
    }
    fclose($csvFile);
  }
}
