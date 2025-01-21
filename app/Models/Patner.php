<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Patner extends Model
{
  /** @use HasFactory<\Database\Factories\PatnerFactory> */
  use HasFactory;

  protected $table = 'master.patners';

  protected $fillable = [
    'id',
    'person_id',
    'nama',
    'npwp',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat'
  ];

  protected $hidden = [
    'person_id'
  ];

  /**
   * Get the person that owns the Patner
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function person(): BelongsTo
  {
    return $this->belongsTo(Person::class, 'person_id', 'id');
  }

  /**
   * Get all of the clubs for the Patner
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function clubs(): HasMany
  {
    return $this->hasMany(Club::class, 'patner_id', 'id');
  }
}
