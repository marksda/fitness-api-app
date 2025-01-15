<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class KabupatenController extends Controller implements HasMiddleware
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
    $query = Kabupaten::query();
    $isPage = request("is_page", 0);
    $sortField = request("sort_field", "nama");
    $sortDirection = request("sort_direction", "asc");
    $idPropinsiField = request("propinsi_id", "35");
    $namaField = request("nama", null);

    if ($idPropinsiField) {
      $query->where("propinsi_id", $idPropinsiField);
    }

    if ($namaField) {
      $query->where("nama", "ilike", "%" . $namaField . "%");
    }

    $kabupaten = $isPage ? $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            // ->onEachSide(1)
            : $query->orderBy($sortField, $sortDirection)->get();

    return $kabupaten;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data propinsi');
    }

    // $fields = $request->validate([
    //   'id' => "required|string|size:2|regex:/^[0-9]+$/",
    //   'propinsi_id' => "required|string|size:4|regex:/^[0-9]+$/",
    //   'nama' => "required|string|min:3|max:255"
    // ]);

    // $propinsi = Propinsi::find($fields['propinsi_id'])->kabupatens()->create($fields);

    $fields = $request->validate([
      'id' => "required|string|size:4|regex:/^[0-9]+$/",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kabupaten = Kabupaten::create($fields);

    return $kabupaten;
  }

  /**
   * Display the specified resource.
   */
  public function show(Kabupaten $kabupaten)
  {
    return $kabupaten;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kabupaten $kabupaten)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kabupaten');
    }

    $fields = $request->validate([
      'id' => "required|string|size:4|regex:/^[0-9]+$/",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kabupaten->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kabupaten $kabupaten)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kabupaten');
    }

    $kabupaten->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }

}