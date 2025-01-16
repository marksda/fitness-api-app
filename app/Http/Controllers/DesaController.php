<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Desa;
use App\Http\Requests\StoreDesaRequest;
use App\Http\Requests\UpdateDesaRequest;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class DesaController extends Controller implements HasMiddleware
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
    $query = Desa::query();
    $isPage = request("is_page", 0);
    $sortField = request("sort_field", "nama");
    $sortDirection = request("sort_direction", "asc");
    $idKecamatanField = request("kecamatan_id", "3515110");
    $namaField = request("nama", null);

    if ($idKecamatanField) {
      $query->where("kecamatan_id", $idKecamatanField);
    }

    if ($namaField) {
      $query->where("nama", "ilike", "%" . $namaField . "%");
    }

    $desas = $isPage ? $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            // ->onEachSide(1)
            : $query->orderBy($sortField, $sortDirection)->get();

    return $desas;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreDesaRequest $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data desa');
    }

    $fields = $request->validate([
      'id' => "required|string|size:10|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $desa = Desa::create($fields);

    return $desa;
  }

  /**
   * Display the specified resource.
   */
  public function show(Desa $desa)
  {
    return $desa;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateDesaRequest $request, Desa $desa)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data desa');
    }

    $fields = $request->validate([
      'id' => "required|string|size:10|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $desa->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Desa $desa)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data desa');
    }

    $desa->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}