<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Club extends Model
{
  /** @use HasFactory<\Database\Factories\ClubFactory> */
  use HasFactory;

  protected $table = 'master.clubs';

  protected $fillable = [
    'nama',
    'deskripsi',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat',
    'patner_id'
  ];

  protected $hidden = [    
    'patner_id'
  ];

  /**
   * Get the propinsi that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function propinsi(): BelongsTo
  {
    return $this->belongsTo(Propinsi::class, 'propinsi_id', 'id');
  }

  /**
   * Get the kabupaten that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kabupaten(): BelongsTo
  {
    return $this->belongsTo(Kabupaten::class, 'kabupaten_id', 'id');
  }

  /**
   * Get the kecamatan that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kecamatan(): BelongsTo
  {
    return $this->belongsTo(Kecamatan::class, 'kecamatan_id', 'id');
  }

  /**
   * Get the desa that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function desa(): BelongsTo
  {
      return $this->belongsTo(Desa::class, 'desa_id', 'id');
  }

  /**
   * Get the patner that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function patner(): BelongsTo
  {
    return $this->belongsTo(Patner::class, 'patner_id', 'id');
  }

  /**
   * The fasilitas that belong to the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function fasilitas(): BelongsToMany
  {
    return $this->belongsToMany(Fasilitas::class, 'master.club_fasilitas', 'club_id', 'fasilitas_id');
  }

}
