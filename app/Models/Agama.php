<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agama extends Model
{
  /** @use HasFactory<\Database\Factories\AgamaFactory> */
  use HasFactory;

  protected $table = 'master.agamas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama'
  ];
}
