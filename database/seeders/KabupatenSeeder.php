<?php

namespace Database\Seeders;

use App\Models\Kabupaten;
use Illuminate\Database\Seeder;

class KabupatenSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csvFile = fopen(base_path('database/data/tbl_kabupaten_202501140913.csv'), 'r');
    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
        if (! $firstline) {
            Kabupaten::create([
                'id' => $data['0'],
                'propinsi_id' => $data['1'],
                'nama' => $data['2'],
            ]);
        }
        $firstline = false;
    }
    fclose($csvFile);
  }
}
