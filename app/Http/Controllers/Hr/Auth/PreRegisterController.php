<?php

namespace App\Http\Controllers\Hr\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

class PreRegisterController extends Controller
{
  protected function validator(array $data)
  {
      return Validator::make($data, [
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
          'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);
  }

  public function pre_check(Request $request){
    $this->validator($request->all())->validate();
    //flash data
    $request->flashOnly('email');

    $bridge_request = $request->all();
    // password マスキング
    $bridge_request['password_mask'] = '******';

    return view('hr.auth.register_check')->with($bridge_request);
  }
}
