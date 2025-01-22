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
    'person_id',
    'nama',
    'npwp',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat',
    'status_id'
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

  /**
   * Get the propinsi that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function propinsi(): BelongsTo
  {
    return $this->belongsTo(Propinsi::class, 'propinsi_id', 'id');
  }

  /**
   * Get the kabupaten that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kabupaten(): BelongsTo
  {
    return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
  }

  /**
   * Get the kecamatan that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kecamatan(): BelongsTo
  {
    return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
  }

  /**
   * Get the desa that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function desa(): BelongsTo
  {
    return $this->belongsTo(Desa::class, 'desa_id', 'id');
  }

  /**
   * Get the status that owns the Patner
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function status(): BelongsTo
  {
    return $this->belongsTo(Status::class, 'status_id', 'id');
  }
}
