<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KelasKategori extends Model
{
  /** @use HasFactory<\Database\Factories\KelasFactory> */
  use HasFactory;

  protected $table = 'master.kelas_kategori';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama'
  ];
}
