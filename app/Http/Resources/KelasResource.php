<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class KelasResource extends JsonResource
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
      'kelas_kategori' => new KelasKategoriResource($this->kelasKategori),
      'durasi' => $this->durasi,
      'level' => new LevelResource($this->level),
      'deskripsi' => $this->deskripsi
    ];
  }
}
