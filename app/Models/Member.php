<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
  /** @use HasFactory<\Database\Factories\MemberFactory> */
  use HasFactory;

  protected $table = 'master.members';

  protected $fillable = [
    'person_id',
    'club_id',
    'status_id'
  ];

}
