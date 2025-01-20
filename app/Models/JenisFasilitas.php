<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class JenisFasilitas extends Model
{
  /** @use HasFactory<\Database\Factories\JenisFasilitasFactory> */
  use HasFactory;

  protected $table = 'master.jenis_fasilitas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama'
  ];

  /**
   * Get all of the fasilitas for the JenisFasilitas
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function fasilitas(): HasMany
  {
      return $this->hasMany(Fasilitas::class, 'jenis_fasilitas_id', 'id');
  }

}
