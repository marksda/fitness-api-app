<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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
      'person_id' => $this->person_id,
      'nama' => $this->nama,   
      'gender' => $this->gender,
      'agama' => $this->agama,
      'alamat' => [
        'propinsi' => new PropinsiResource($this->propinsi),
        'kabupaten' => new KabupatenResource($this->kabupaten),
        'kecamatan' => new KecamatanResource($this->kecamatan),
        'desa' => new DesaResource($this->desa),
        'detail' => $this->alamat
      ]
    ];
  }
}
