<?php

namespace App\Policies;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\User;

class ManageDataPolicy
{  
  public function manageData(User $user): bool
  {
    if($user->hasRole(RolesEnum::Admin->value)) {
      return true;
    }
    else {      
      try {
        return $user->hasPermissionTo(PermissionsEnum::ManageDatas->value);
      } catch (\Throwable $th) {
        return false;
      }      
    }
  }
}
