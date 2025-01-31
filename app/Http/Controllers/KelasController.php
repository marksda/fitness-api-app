<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Http\Requests\StoreKelasRequest;
use App\Http\Requests\UpdateKelasRequest;
use App\Http\Resources\KelasCollection;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

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
  public function store(StoreKelasRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Kelas $kelas)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdateKelasRequest $request, Kelas $kelas)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Kelas $kelas)
  {
    //
  }
}
