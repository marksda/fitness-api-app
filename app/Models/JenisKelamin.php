<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKelamin extends Model
{
    /** @use HasFactory<\Database\Factories\JenisKelaminFactory> */
    use HasFactory;

    protected $table = 'master.genders';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
      'id',
      'nama'
    ];
}
