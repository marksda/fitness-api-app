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
    $person = array(
      'id' => $this->id,
      'person_id' => $this->identifier,
      'nama' => $this->nama,   
      'tanggal_lahir' => $this->tanggal_lahir,
      'gender' => $this->gender,
      'agama' => $this->agama,
      'alamat' => array(
        'propinsi' => new PropinsiResource($this->propinsi),
        'kabupaten' => new KabupatenResource($this->kabupaten),
        'kecamatan' => new KecamatanResource($this->kecamatan),
        'desa' => new DesaResource($this->desa),
        'detail' => $this->alamat,
        'kode_pos' => $this->kode_pos
      )
    );
    
    if($this->berat_badan) {
      $person['berat_badan'] = $this->berat_badan;
    }

    if($this->tinggi_badan) {
      $person['tinggi_badan'] = $this->tinggi_badan;
    }

    return $person;
  }
}
