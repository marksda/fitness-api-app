<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Kecamatan;
use App\Http\Requests\StoreKecamatanRequest;
use App\Http\Requests\UpdateKecamatanRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class KecamatanController extends Controller implements HasMiddleware
{
  public static function middleware(): array 
  {
    return [
      new Middleware(['auth:sanctum'], except: ['index', 'show']),
    ];
  }
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $query = Kecamatan::query();
    $isPage = request("is_page", 0);
    $sortField = request("sort_field", "nama");
    $sortDirection = request("sort_direction", "asc");
    $idKabupatenField = request("kabupaten_id", "3515");
    $namaField = request("nama", null);

    if ($idKabupatenField) {
      $query->where("kabupaten_id", $idKabupatenField);
    }

    if ($namaField) {
      $query->where("nama", "ilike", "%" . $namaField . "%");
    }

    $kecamatans = $isPage ? $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            // ->onEachSide(1)
            : $query->orderBy($sortField, $sortDirection)->get();

    return $kecamatans;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKecamatanRequest $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data propinsi');
    }

    $fields = $request->validate([
      'id' => "required|string|size:7|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kecamatan = Kecamatan::create($fields);

    return $kecamatan;
    
  }

  /**
   * Display the specified resource.
   */
  public function show(Kecamatan $kecamatan)
  {
    return $kecamatan;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKecamatanRequest $request, Kecamatan $kecamatan)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kecamatan');
    }

    $fields = $request->validate([
      'id' => "required|string|size:7|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kecamatan->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kecamatan $kecamatan)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kecamatan');
    }

    $kecamatan->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
