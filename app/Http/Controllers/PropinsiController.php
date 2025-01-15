<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
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
      new Middleware(['auth:sanctum'], except: ['show']),
    ];
  }
  
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    if (! Gate::allows(PermissionsEnum::ManageKontenNews)) {
      abort(403, 'Hak akses ditolak untuk menghapus data propinsi');
    }

    return Propinsi::all();
  }

  /**
   * Store a newly created resource in storage.
   */
  // public function store(StorePropinsiRequest $request)
  public function store(Request $request)
  {
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
    Gate::authorize('delete', $propinsi);

    $propinsi->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
