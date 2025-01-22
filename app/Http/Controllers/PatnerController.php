<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Patner;
use App\Http\Requests\StorePatnerRequest;
use App\Http\Requests\UpdatePatnerRequest;
use App\Http\Resources\PatnerCollection;
use App\Http\Resources\PatnerResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PatnerController extends Controller implements HasMiddleware
{
  public static function middleware(): array 
  {
    return [
      new Middleware(['auth:sanctum']),
    ];
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    $query = Patner::query();
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
        $patners = $isPaging ? $query->paginate(10) : $query->get();
      }    
      else {
        $patners = $query->get();
      }
    }
    else {
      $patners = $query->get();
    }
    
    return new PatnerCollection($patners);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data patner');
    }

    $fields = $request->validate([
      'person_id' => "required|string|size:16|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255",
      'npwp' => "required|string|min:16|max:20",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'desa_id' => "required|string|size:10|regex:/^[0-9]+$/",
      'alamat' => "required|string",
      'status_id' => "required|string|size:2|regex:/^[0-9]+$/"
    ]);

    $patner = Patner::create($fields);

    return new PatnerResource($patner);
  }

  /**
   * Display the specified resource.
   */
  public function show(Patner $patner)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk melihat data patner');
    }

    return new PatnerResource($patner);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Patner $patner)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk update data patner');
    }

    $fields = $request->validate([
      'person_id' => "required|string|size:16|regex:/^[0-9]+$/",
      'nama' => "required|string|min:3|max:255",
      'npwp' => "required|string|min:16|max:20",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'desa_id' => "required|string|size:10|regex:/^[0-9]+$/",
      'alamat' => "required|string",
      'status_id' => "required|string|size:2|regex:/^[0-9]+$/"
    ]);

    $patner->update($fields);

    return new PatnerResource($patner);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Patner $patner)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk hapus data patner');
    }

    $patner->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
