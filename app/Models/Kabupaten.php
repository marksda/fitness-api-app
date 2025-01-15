<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kabupaten extends Model
{
  /** @use HasFactory<\Database\Factories\KabupatenFactory> */
  use HasFactory;

  protected $table = 'master.kabupatens';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'propinsi_id'  
  ];

  protected $hidden = [
    'propinsi_id'
  ];

  /**
   * Get the propinsi that owns the Kabupaten
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function propinsi(): BelongsTo
  {
    return $this->belongsTo(Propinsi::class, 'propinsi_id', 'id');
  }
    
  /**
   * Get all of the kecamatan for the Kabupaten
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function kecamatan(): HasMany
  {
    return $this->hasMany(Kecamatan::class, 'kabupaten_id', 'id');
  }
}
