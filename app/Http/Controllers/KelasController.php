<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Kelas;
use App\Http\Resources\KelasCollection;
use App\Http\Resources\KelasResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class KelasController extends Controller implements HasMiddleware
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
    $query = Kelas::query();
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
        $kelas = $isPaging ? $query->paginate(10) : $query->get();
      }    
      else {
        $kelas = $query->get();
      }
    }
    else {
      $kelas = $query->get();
    }
    
    return new KelasCollection($kelas);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kelas');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255",
      'kelas_kategori_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'durasi' => "required|string|min:3|max:255",
      'level_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'image_path' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $kelas = Kelas::create($fields);

    return new KelasResource($kelas);
  }

  /**
   * Display the specified resource.
   */
  public function show(Kelas $kela)
  {
    return new KelasResource($kela);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kelas $kela)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data kelas');
    }

    $fields = $request->validate([
      'id' => "string|size:2|regex:/^[0-9]+$/",
      'nama' => "string|min:3|max:255",
      'kelas_kategori_id' => "string|size:2|regex:/^[0-9]+$/",
      'durasi' => "string|min:3|max:255",
      'level_id' => "string|size:2|regex:/^[0-9]+$/",
      'image_path' => "required|string|min:3|max:255"
    ]);


    $kela->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kelas $kela)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk hapus data kelas');
    }

    $kela->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
