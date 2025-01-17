<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Person;
use App\Http\Requests\UpdatePersonRequest;
use App\Http\Resources\PersonCollectionResource;
use App\Http\Resources\PersonResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class PersonController extends Controller implements HasMiddleware
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
    $query = Person::query();
    $filter = request("filters", null);

    if($filter != null) {
      $filter = json_decode($filter);

      if(property_exists($filter, "fields_filter")) {
        $fieldsFilter = $filter->fields_filter;
        foreach ($fieldsFilter as $fieldFilter) {
          switch ($fieldFilter->field_name) {
            case 'person_id':
              $query->where($fieldFilter->field_name, $fieldFilter->value);
              break; 
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
        $people = $isPaging ? $query->paginate(10) : $query->get();
      }
    }
    else {
      $people = $query->get();
    }

    return new PersonCollectionResource($people);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data person');
    }

    $fields = $request->validate([
      'person_id' => "required|string|min:3|max:255",
      'nama' => "required|string|min:3|max:255",
      'jenis_kelamin_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'agama_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
      'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
      'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
      'desa_id' => "required|string|size:10|regex:/^[0-9]+$/",
      'alamat' => "required|string|min:3|max:255",
    ]);

    $fields['nama'] = strtoupper($fields['nama']);

    $person = Person::create($fields);

    return $person;
  }

  /**
   * Display the specified resource.
   */
  public function show(Person $person)
  {
    return new PersonResource($person);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UpdatePersonRequest $request, Person $person)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Person $person)
  {
    //
  }
}
