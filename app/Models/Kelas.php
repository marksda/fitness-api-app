<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kelas extends Model
{
  /** @use HasFactory<\Database\Factories\KelasFactory> */
  use HasFactory;

  protected $table = 'master.kelas';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama',
    'kelas_kategori_id',
    'durasi',
    'level_id'
  ];

  /**
   * Get the KelasKategori that owns the Kelas
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function kelasKategori(): BelongsTo
  {
    return $this->belongsTo(KelasKategori::class, 'kelas_kategori_id', 'id');
  }

  /**
   * Get the level that owns the Kelas
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function level(): BelongsTo
  {
    return $this->belongsTo(level::class, 'level_id', 'id');
  }
}
