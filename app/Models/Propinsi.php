<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Propinsi extends Model
{
  /** @use HasFactory<\Database\Factories\PropinsiFactory> */
  use HasFactory;

  protected $table = 'master.propinsis';
  protected $keyType = 'string';
  public $timestamps = false;
  public $incrementing = false;

  protected $fillable = [
    'id',
    'nama'
  ];

  /**
   * Get all of the kabupaten for the Propinsi
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function kabupatens(): HasMany
  {
      return $this->hasMany(Kabupaten::class, 'propinsi_id', 'id');
  }
}
