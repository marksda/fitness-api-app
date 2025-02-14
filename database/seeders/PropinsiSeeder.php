<?php

namespace Database\Seeders;

use App\Models\Propinsi;
use Illuminate\Database\Seeder;

class PropinsiSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    $csvFile = fopen(base_path('database/data/tbl_propinsi_202501140927.csv'), 'r');
    $firstline = true;
    while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
        if (! $firstline) {
            Propinsi::create([
                'id' => $data['0'],
                'nama' => $data['1'],
            ]);
        }
        $firstline = false;
    }
    fclose($csvFile);
  }
}
