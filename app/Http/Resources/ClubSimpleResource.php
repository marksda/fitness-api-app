<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClubSimpleResource extends JsonResource
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
      'nama' => $this->nama,
      'alamat' => [
        'propinsi' => new PropinsiResource($this->propinsi),
        'kabupaten' => new KabupatenResource($this->Kabupaten),
        'kecamatan' => new KecamatanResource($this->kecamatan),
        'desa' => new DesaResource($this->desa),
        'detail' => $this->alamat
      ]
    ];
  }
}
