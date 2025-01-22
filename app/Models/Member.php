<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Member extends Model
{
  /** @use HasFactory<\Database\Factories\MemberFactory> */
  use HasFactory;

  protected $table = 'master.members';

  protected $fillable = [
    'person_id',
    'club_id',
    'status_id'
  ];

  /**
   * Get the person that owns the Member
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function person(): BelongsTo
  {
    return $this->belongsTo(Person::class, 'person_id', 'id');
  }

  /**
   * Get the club that owns the Member
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function club(): BelongsTo
  {
    return $this->belongsTo(Club::class, 'club_id', 'id');
  }

  /**
   * Get the status that owns the Member
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function status(): BelongsTo
  {
    return $this->belongsTo(Status::class, 'status_id', 'id');
  }
}
