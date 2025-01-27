<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MemberResource extends JsonResource
{
  /**
   * Transform the resource into an array.
   *
   * @return array<string, mixed>
   */
  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'person' => new PersonResource($this->person),
      'club' => new ClubSimpleResource($this->club),
      'tanggal_gabung' => [
        'value' => Carbon::parse($this->date_create)->format('Y-m-d'),
        'formatted' => Carbon::parse($this->date_create)->format('d-m-Y')
      ],
      'status' => new StatusResource($this->status),
    ];
  }
}