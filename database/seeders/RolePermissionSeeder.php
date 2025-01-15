<?php

namespace Database\Seeders;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      $adminRole = Role::create(['name' =>RolesEnum::Admin->value]);
      $patnerRole = Role::create(['name' =>RolesEnum::Patner->value]);
      $memberRole = Role::create(['name' =>RolesEnum::Member->value]);
      $trainerRole = Role::create(['name' =>RolesEnum::Trainer->value]);

      $manageUserPermission = Permission::create([
        'name' => PermissionsEnum::ManageUsers->value
      ]);
      
      $manageMemberPermission = Permission::create([
        'name' => PermissionsEnum::ManageMembers->value
      ]);

      $managePatnerPermission = Permission::create([
        'name' => PermissionsEnum::ManagePatners->value
      ]);

      $manageKontenNewPermission = Permission::create([
        'name' => PermissionsEnum::ManageKontenNews->value
      ]);  
      
      $adminRole->syncPermissions([
        $manageUserPermission,
        $manageMemberPermission,
        $managePatnerPermission,
        $manageKontenNewPermission,
      ]);

      User::factory()->create([
        'name' => 'Administrator',
        'email' => 'admin@fit.com',
      ])->assignRole(RolesEnum::Admin);
  
    }
}
