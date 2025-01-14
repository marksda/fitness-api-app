<?php

namespace App\Http\Controllers;

use App\Models\Kabupaten;
// use App\Models\Propinsi;
use Illuminate\Http\Request;

class KabupatenController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return Kabupaten::all();
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    // $fields = $request->validate([
    //   'id' => "required|string|size:2|regex:/^[0-9]+$/",
    //   'propinsi_id' => "required|string|size:4|regex:/^[0-9]+$/",
    //   'nama' => "required|string|min:3|max:255"
    // ]);

    // $propinsi = Propinsi::find($fields['propinsi_id'])->kabupatens()->create($fields);

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'propinsi_id' => "required|string|size:4|regex:/^[0-9]+$/",
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
    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'propinsi_id' => "required|string|size:4|regex:/^[0-9]+$/",
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
    $kabupaten->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
