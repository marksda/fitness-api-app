<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
  
  public function register(Request $request, string $jenis_register) {
    if ($jenis_register == 'member') {
      return $this->memberRegister($request);
    }
    else if ($jenis_register == 'patner') {
      //register buat patner
    }
    else {
      abort(403, 'Ditolak: jenis register tidak dikenali');
    }
  }

  public function login(Request $request) {
    $request->validate([
      'email' => 'required|email|exists:users',
      'password' => 'required'
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
      return [
        'errors' => [
          'email' => ['The provided credentials are incorrect.']
        ]
      ];
    }

    $token = $user->createToken($user->name);

    return [
      'user' => $user,
      'token' => $token->plainTextToken
    ];
  }

  public function logout(Request $request) {
    $request->user()->tokens()->delete();

    return [
      'message' => 'You are logged out.' 
    ];
  }

  private function memberRegister(Request $request) {    

    $fieldClub = $request->validate([
      'club_id' => "required|numeric"
    ]);

    $club = Club::find($fieldClub['club_id']);
    $user = new User;

    if(!$club) {
      abort(403, 'Ditolak: club tidak ada dalam sistem');
    }
    else {
      $fields = $request->validate([
        'identifier' => "required|string|min:3|max:255|unique:master.people",
        'nama' => "required|string|min:3|max:255",
        'tanggal_lahir' => "required|date_format:Y-m-d",
        'jenis_kelamin_id' => "required|string|size:2|regex:/^[0-9]+$/",
        'agama_id' => "required|string|size:2|regex:/^[0-9]+$/",
        'propinsi_id' => "required|string|size:2|regex:/^[0-9]+$/",
        'kabupaten_id' => "required|string|size:4|regex:/^[0-9]+$/",
        'kecamatan_id' => "required|string|size:7|regex:/^[0-9]+$/",
        'desa_id' => "required|string|size:10|regex:/^[0-9]+$/",
        'alamat' => "required|string|min:3|max:255",
        'kode_pos' => "string|size:5|regex:/^[0-9]+$/",
        'email' => "required|email|unique:users",
        'no_hp' => "required|string|regex:/^[0-9]+$/",
        'tinggi_badan' => "numeric",
        'berat_badan' => "numeric",
        'password' => 'required|confirmed'
      ]);    
      
      $user->name = $fields['nama'];
      $user->email = $fields['email'];
      $user->password = $fields['password'];
      $user->save();

      $person = new Person;
      $person->identifier = $fields['identifier'];
      $person->nama = $fields['nama'];
      $person->tanggal_lahir = $fields['tanggal_lahir'];
      $person->jenis_kelamin_id = $fields['jenis_kelamin_id'];
      $person->agama_id = $fields['agama_id'];
      $person->propinsi_id = $fields['propinsi_id'];
      $person->kabupaten_id = $fields['kabupaten_id'];
      $person->kecamatan_id = $fields['kecamatan_id'];
      $person->desa_id = $fields['desa_id'];
      $person->alamat = $fields['alamat'];
      if($fields['kode_pos']) {
        $person->kode_pos = $fields['kode_pos'];
      }
      $person->email = $fields['email'];
      $person->no_hp = $fields['no_hp'];
      if($fields['tinggi_badan']) {
        $person->tinggi_badan = $fields['tinggi_badan'];
      }
      if($fields['berat_badan']) {
        $person->berat_badan = $fields['berat_badan'];
      }
      $person->save();

      $member = new Member;
      $member->person_id = $person->id;
      $member->club_id = $club->id;
      $member->status_id = "01";
      $member->save();       
    }

    $token = $user->createToken($request->name);
    
    return [
      'user' => $user,
      'token' => $token->plainTextToken
    ];
  }
}
