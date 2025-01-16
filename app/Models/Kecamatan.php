<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kecamatan extends Model
{
  /** @use HasFactory<\Database\Factories\KecamatanFactory> */
  use HasFactory;

  protected $table = 'master.kecamatans';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'kabupaten_id'  
  ];

  protected $hidden = [
    'kabupaten_id'
  ];

  /**
   * Get the kabupaten that owns the Kecamatan
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kabupaten(): BelongsTo
  {
    return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
  }

  /**
   * Get all of the desa for the Kecamatan
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function desa(): HasMany
  {
      return $this->hasMany(Desa::class, 'kecamatan_id', 'id');
  }
}
