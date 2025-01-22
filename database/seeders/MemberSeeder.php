<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MemberSeeder extends Seeder
{
  /**
   * Run the database seeds.
   */
  public function run(): void
  {
    Member::factory()
      ->count(1)
      ->sequence(
        ['person_id' => 1, 'club_id' => 1, 'status_id' => '01']
      )
      ->create();
  }
}
