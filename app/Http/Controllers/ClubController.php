<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Club;
use App\Http\Requests\UpdateClubRequest;
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
              $query->where($fieldFilter->field_name, "ilike", "%" . $fieldFilter->value . "%");
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
      'patner_id' => "required|numeric"
    ]);
    
    $club = Club::create($fields);

    return new ClubResource($club);
  }

  /**
   * Display the specified resource.
   */
  public function show(Club $club)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateClubRequest $request, Club $club)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Club $club)
  {
    //
  }
}
