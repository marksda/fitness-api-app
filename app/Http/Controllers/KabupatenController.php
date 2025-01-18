<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Http\Resources\KabupatenCollection;
use App\Http\Resources\KabupatenResource;
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
            case 'propinsi_id':
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
        $kabupatens = $isPaging ? $query->paginate(50) : $query->get();
      }  
      else {
        $kabupatens = $query->get();
      }
    }
    else {
      $kabupatens = $query->get();
    }

    return new KabupatenCollection($kabupatens);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data kabupaten');
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
    return new KabupatenResource($kabupaten);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Kabupaten $kabupaten)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data kabupaten');
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
      abort(403, 'Hak akses ditolak untuk delete data kabupaten');
    }

    $kabupaten->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }

}