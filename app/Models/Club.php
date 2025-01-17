<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Club extends Model
{
  /** @use HasFactory<\Database\Factories\ClubFactory> */
  use HasFactory;

  protected $table = 'master.desas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'propinsi_id',
    'kabupaten_id',
    'kecamatan_id',
    'desa_id',
    'alamat',
  ];

  protected $hidden = [    
    'patner_id'
  ];

  /**
   * Get the patner that owns the Club
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function patner(): BelongsTo
  {
    return $this->belongsTo(Patner::class, 'patner_id', 'id');
  }

}
