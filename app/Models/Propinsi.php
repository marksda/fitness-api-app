<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Propinsi extends Model
{
    /** @use HasFactory<\Database\Factories\PropinsiFactory> */
    use HasFactory;

    // protected $connection = 'pgsql_master_shema';
    // protected $table = 'propinsis';
    protected $table = 'master.propinsis';
    protected $keyType = 'string';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
      'id',
      'nama'
    ];
}
