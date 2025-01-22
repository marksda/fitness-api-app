<?php

namespace App\Http\Resources;

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
      "status" => new StatusResource($this->status)
    ];
  }
}
