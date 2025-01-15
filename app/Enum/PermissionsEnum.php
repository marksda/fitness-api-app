<?php

namespace App\Enum;

enum PermissionsEnum: string
{
  case ManageUsers = 'manage_users';
  case ManageMembers = 'manage_members';
  case ManagePatners = 'manage_patners';
  case ManageKontenNews = 'manage_KontenNews';  
}
