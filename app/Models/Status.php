<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
  /** @use HasFactory<\Database\Factories\StatusFactory> */
  use HasFactory;

  protected $table = 'master.statuses';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama'
  ];
  
}
