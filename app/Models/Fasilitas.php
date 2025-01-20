<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Fasilitas extends Model
{
  /** @use HasFactory<\Database\Factories\FasilitasFactory> */
  use HasFactory;

  protected $table = 'master.fasilitas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'jenis_fasilitas_id'
  ];

  /**
   * Get the jenisFasilitas that owns the Fasilitas
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function jenisFasilitas(): BelongsTo
  {
    return $this->belongsTo(JenisFasilitas::class, 'jenis_fasilitas_id', 'id');
  }

  /**
   * The clubs that belong to the Fasilitas
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
   */
  public function clubs(): BelongsToMany
  {
    return $this->belongsToMany(Club::class, 'master.club_fasilitas', 'fasilitas_id', 'club_id');
  }
}
