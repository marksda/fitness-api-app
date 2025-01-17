<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Agama;
use App\Http\Requests\UpdateAgamaRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class AgamaController extends Controller implements HasMiddleware
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
    $query = Agama::query();
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
        $agamas = $isPaging ? $query->paginate(10) : $query->get();
      }

      return $agamas;      
    }

    $agamas = $query->get();
    return $agamas;
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data agama');
    }


    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $agama = Agama::create($fields);

    return $agama;
  }

  /**
   * Display the specified resource.
   */
  public function show(Agama $agama)
  {
    return $agama;
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Agama $agama)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data agama');
    }

    $fields = $request->validate([
      'id' => "required|string|size:2|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255"
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $agama->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Agama $agama)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk hapus data agama');
    }


    $agama->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
