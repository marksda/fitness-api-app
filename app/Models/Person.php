<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Person extends Model
{
  /** @use HasFactory<\Database\Factories\PersonFactory> */
  use HasFactory;

  protected $table = 'master.people';

  protected $fillable = [
    'identifier',
    'nama',
    'tanggal_lahir',
    'jenis_kelamin_id',
    'agama_id',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat',
    'kode_pos',
    'email',
    'no_hp',
    'tinggi_badan',
    'berat_badan'
  ];

  protected $hidden = [
    'user_id',
    'created_at',
    'updated_at'
  ];

  /**
   * Get the gender that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function gender(): BelongsTo
  {
    return $this->belongsTo(Gender::class, 'jenis_kelamin_id', 'id');
  }

  /**
   * Get the agama that owns the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function agama(): BelongsTo
  {
    return $this->belongsTo(Agama::class, 'agama_id', 'id');
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
   * Get all of the patner for the Person
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function patner(): HasMany
  {
      return $this->hasMany(Patner::class, 'person_id', 'id');
  }
  
}
