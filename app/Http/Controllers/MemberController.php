<?php

namespace App\Http\Controllers;

use App\Enum\PermissionsEnum;
use App\Models\Member;
use App\Http\Resources\MemberCollection;
use App\Http\Resources\MemberResource;
use Illuminate\Http\Request;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Support\Facades\Gate;

class MemberController extends Controller implements HasMiddleware
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
    $query = Member::query();
    $filter = request("filters", null);

    if($filter != null) {
      $filter = json_decode($filter);

      if(property_exists($filter, "fields_filter")) {
        $fieldsFilter = $filter->fields_filter;
        foreach ($fieldsFilter as $fieldFilter) {
          switch ($fieldFilter->field_name) {
            case 'nama':
              $query->join('master.people', 'master.members.person_id', '=', 'master.people.id')
                    ->whereLike('master.people.nama', "%" . $fieldFilter->value . "%", caseSensitive: false);
              break; 
              break;
            default:
              break;
          }
        }        
      }

      if(property_exists($filter, "fields_sorter")) {
        $fieldsSort = $filter->fields_sorter;
        if(property_exists($filter, "fields_filter")) {
          foreach ($fieldsSort as $fieldSort) {
            switch ($fieldSort->field_name) {
              case 'nama':
                $query->orderBy('master.people.nama', $fieldSort->value);
                break;              
              default:
                $query->orderBy($fieldSort->field_name, $fieldSort->value);
                break;
            } 
          }
        }
        else {
          $query->join('master.people', 'master.members.person_id', '=', 'master.people.id');
          foreach ($fieldsSort as $fieldSort) {
            switch ($fieldSort->field_name) {
              case 'nama':
                $query->orderBy('master.people.nama', $fieldSort->value);
                break;              
              default:
                $query->orderBy($fieldSort->field_name, $fieldSort->value);
                break;
            }            
          }
        }
      }

      if(property_exists($filter, "is_paging")) {
        $isPaging = $filter->is_paging;
        $members = $isPaging ? $query->paginate(50) : $query->get();
      }
      else {
        $members = $query->get();     
      }      
    }
    else {
      $members = $query->get();
    }

    return   new MemberCollection($members);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menambah data member');
    }

    $fields = $request->validate([
      'person_id' => "required|numeric",
      'club_id' => "required|numeric",
      'status_id' => "required|string|size:2|regex:/^[0-9]+$/"
    ]);


    $member = Member::create($fields);

    return new MemberResource($member);
  }

  /**
   * Display the specified resource.
   */
  public function show(Member $member)
  {
    return new MemberResource($member);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Member $member)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk mengubah data member');
    }

    $fields = $request->validate([
      'person_id' => "numeric",
      'club_id' => "numeric",
      'status_id' => "string|size:2|regex:/^[0-9]+$/"
    ]);

    $member->update($fields);

    return ["status" => "sukses", "message" => "data berhasil diupdate"];
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Member $member)
  {
    if (! Gate::allows(PermissionsEnum::ManageDatas->value)) {
      abort(403, 'Hak akses ditolak untuk menghapus data member');
    }

    $member->delete();

    return ["status" => "sukses", "message" => "data berhasil dihapus"];
  }
}
