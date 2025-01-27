<?php

namespace App\Http\Resources;

use Carbon\Carbon;
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
    $person = [
      'id' => $this->id,
      'identifier' => $this->identifier,
      'nama' => $this->nama,   
      'tanggal_lahir' => $this->tanggal_lahir,
      'gender' => $this->gender,
      'agama' => $this->agama,
      'alamat' => [
        'propinsi' => new PropinsiResource($this->propinsi),
        'kabupaten' => new KabupatenResource($this->kabupaten),
        'kecamatan' => new KecamatanResource($this->kecamatan),
        'desa' => new DesaResource($this->desa),
        'detail' => $this->alamat,
        'kode_pos' => $this->kode_pos
      ],
      'kontak' => [
        'email' => $this->email,
        'no_hp' => $this->no_hp
      ]
    ];
    
    if($this->berat_badan) {
      $person['berat_badan'] = (float) $this->berat_badan;
    }

    if($this->tinggi_badan) {
      $person['tinggi_badan'] = (float) $this->tinggi_badan;
    }

    return $person;
  }
}