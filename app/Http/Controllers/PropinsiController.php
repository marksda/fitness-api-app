<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Enum\RolesEnum;
use App\Models\Propinsi;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PropinsiController extends Controller implements HasMiddleware
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
    $query = Propinsi::query();
    $isPage = request("is_page", 0);
    $sortField = request("sort_field", "nama");
    $sortDirection = request("sort_direction", "asc");
    $namaField = request("nama", null);

    if ($namaField) {
      $query->where("nama", "ilike", "%" . $namaField . "%");
    }

    $propinsis = $isPage ? $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            // ->onEachSide(1)
            : $query->orderBy($sortField, $sortDirection)->get();

    return $propinsis;
  }

  /**
   * Store a newly created resource in storage.
   */
  // public function store(StorePropinsiRequest $request)
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value . '-propinsi')) {
      abort(403, 'Hak akses ditolak untuk menambah data propinsi');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $propinsi = Propinsi::create($fields);

    return $propinsi;
  }

  /**
   * Display the specified resource.
   */
  public function show(Propinsi $propinsi)
  {
    return $propinsi;
  }

  /**
   * Update the specified resource in storage.
   */
  // public function update(UpdatePropinsiRequest $request, Propinsi $propinsi)
  public function update(Request $request, Propinsi $propinsi)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value . '-propinsi')) {
      abort(403, 'Hak akses ditolak untuk update data propinsi');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $propinsi->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Propinsi $propinsi)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value . '-propinsi')) {
      abort(403, 'Hak akses ditolak untuk hapus data propinsi');
    }


    $propinsi->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
