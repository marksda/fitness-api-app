<?php

namespace Database\Seeders;

use App\Models\Person;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PersonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $csvFile = fopen(base_path('database/data/agamas_202501171543.csv'), 'r');
      $firstline = true;
      while (($data = fgetcsv($csvFile, 2000, ',')) !== false) {
        if (! $firstline) {
          Person::create([
            'id' => $data['0'],
            'nama' => $data['1'],
          ]);
        }
        $firstline = false;
      }
      fclose($csvFile);
    }
}
