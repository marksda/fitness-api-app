<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
  /** @use HasFactory<\Database\Factories\PersonFactory> */
  use HasFactory;

  protected $fillable = [
    'id',
    'nama',
    'nik',
    'jenis_kelamin_id',
    'agama',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat'
  ];

}
