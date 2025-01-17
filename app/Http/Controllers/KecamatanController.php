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

    $filter = request("filters", null);

    if($filter != null) {
      $filter = json_decode($filter);

      if(property_exists($filter, "fields_filter")) {
        $fieldsFilter = $filter->fields_filter;
        foreach ($fieldsFilter as $fieldFilter) {
          switch ($fieldFilter->field_name) {
            case 'nama':
              $query->where($fieldFilter->field_name, "ilike", "%" . $fieldFilter->value . "%");
              break;  
            case 'kabupaten_id':
                $query->where($fieldFilter->field_name, $fieldFilter->value);
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
        $kecamatans = $isPaging ? $query->paginate(10) : $query->get();
      }

      return $kecamatans;      
    }

    $kecamatans = $query->get();

    return $kecamatans;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(StoreKecamatanRequest $request)
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
      abort(403, 'Hak akses ditolak untuk update data kecamatan');
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
