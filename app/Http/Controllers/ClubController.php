<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Club;
use App\Http\Resources\ClubCollection;
use App\Http\Resources\ClubResource;
use App\Http\Resources\ClubSimpleCollection;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class ClubController extends Controller implements HasMiddleware
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
    $query = Club::query();
    $filter = request("filters", null);
    $listSimple = false;

    if($filter != null) {
      $filter = json_decode($filter);

      if(property_exists($filter, "fields_filter")) {
        $fieldsFilter = $filter->fields_filter;
        foreach ($fieldsFilter as $fieldFilter) {
          switch ($fieldFilter->field_name) {
            case 'nama':
              $query->where('nama', "ilike", "%" . $fieldFilter->value . "%");
              break;    
            case 'kabupaten_id':
              $query->where('kabupaten_id', $fieldFilter->value);
              break;      
            case 'simple':  
              $listSimple = $fieldFilter->value;
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
        $clubs = $isPaging ? $query->paginate(50) : $query->get();
      }
      else {
        $clubs = $query->get();     
      }      
    }
    else {
      $clubs = $query->get();
    }

    return  $listSimple ? new ClubSimpleCollection($clubs) : new ClubCollection($clubs);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data club');
    }

    $fields = $request->validate([
      'nama' => "required|string|min:3|max:255",
      'deskripsi' => "required|string|min:3",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'desa_id' => "required|string|size:10|regex:/^[0-9]+$/",
      'alamat' => "required|string",
      'patner_id' => "required|numeric",
      'status_id' => "required|string|size:2|regex:/^[0-9]+$/"
    ]);
    
    $club = Club::create($fields);

    return new ClubResource($club);
  }

  /**
   * Display the specified resource.
   */
  public function show(Club $club)
  {
    return new ClubResource($club);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Club $club)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk merubah data club');
    }

    $fields = $request->validate([
      'nama' => "string|min:3|max:255",
      'deskripsi' => "string|min:3",
      'propinsi_id' => "string|size:2|regex:/^[0-9]+$/",
      'kabupaten_id' => "string|size:4|regex:/^[0-9]+$/",
      'kecamatan_id' => "string|size:7|regex:/^[0-9]+$/",
      'desa_id' => "string|size:10|regex:/^[0-9]+$/",
      'alamat' => "string",
      'patner_id' => "numeric",
      'status_id' => "string|size:2|regex:/^[0-9]+$/"
    ]);

    $club->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Club $club)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menghapus data club');
    }

    $club->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
