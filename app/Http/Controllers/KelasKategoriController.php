<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Http\Resources\KelasKategoriCollection;
use App\Http\Resources\KelasKategoriResource;
use App\Models\KelasKategori;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class KelasKategoriController extends Controller implements HasMiddleware
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
    $query = KelasKategori::query();
    $filter = request("filters", null);

    if($filter != null) {
      $filter = json_decode($filter);

      if(property_exists($filter, "fields_filter")) {
        $fieldsFilter = $filter->fields_filter;
        foreach ($fieldsFilter as $fieldFilter) {
          switch ($fieldFilter->field_name) {
            case 'nama':
              $query->whereLike($fieldFilter->field_name, "%" . $fieldFilter->value . "%", caseSensitive: false);
              break;       
            default:
              break;
          }
        }        
      }

      if(property_exists($filter, "fields_sorter")) {
        $fieldsSort = $filter->fields_sorter;
        foreach ($fieldsSort as $fieldSort) {
          $query->orderBy($fieldSort->field_name, $fieldSort->value);
        }
      }

      if(property_exists($filter, "is_paging")) {
        $isPaging = $filter->is_paging;
        $kelas_kategori = $isPaging ? $query->paginate(10) : $query->get();
      }    
      else {
        $kelas_kategori = $query->get();
      }
    }
    else {
      $kelas_kategori = $query->get();
    }
    
    return new KelasKategoriCollection($kelas_kategori);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kelas kategori');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kelas_kategori = KelasKategori::create($fields);

    return new KelasKategoriResource($kelas_kategori);
  }

  /**
   * Display the specified resource.
   */
  public function show(KelasKategori $kelasKategori)
  {
    return new KelasKategoriResource($kelasKategori);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, KelasKategori $kelasKategori)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data kelas kategori');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kelasKategori->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(KelasKategori $kelasKategori)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk hapus data kelas kategori');
    }


    $kelasKategori->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
