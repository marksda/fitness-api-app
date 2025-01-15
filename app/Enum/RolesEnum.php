<?php

namespace App\Enum;

enum RolesEnum: string
{
  case Admin = 'admin';
  case Patner = 'patner';
  case Member = 'member';
  case Trainer = 'trainer';

  public static function labels(): array
  {
      return [
        self::Admin->value => 'Admin',
        self::Patner->value => 'Patner',
        self::Member->value => 'Member',
        self::Trainer->value => 'Trainer',
      ];
  }

  public function label()
  {
    return match($this) {
      self::Admin->value => 'Admin',
      self::Patner->value => 'Patner',
      self::Member->value => 'Member',
      self::Trainer->value => 'Trainer',
    };
  }
}
