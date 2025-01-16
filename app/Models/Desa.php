<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Desa extends Model
{
  /** @use HasFactory<\Database\Factories\DesaFactory> */
  use HasFactory;

  protected $table = 'master.desas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'kecamatan_id'  
  ];

  protected $hidden = [
    'kecamatan_id'
  ];

  /**
   * Get the kecamatan that owns the Desa
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kecamatan(): BelongsTo
  {
    return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
  }
}
