<?php

namespace App\Http\Controllers\Hr\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\HrUser;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::Hr_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:hr');
    }

    public function showRegistrationForm()
    {
      return view('hr.auth.register');
    }

    protected function guard(){
      return Auth::guard('hr');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return HrUser::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'status' => 1,
            'company_id' => 1,
            'plan' => 'free',
            'password' => Hash::make($data['password']),
        ]);
    }

    //=== 仮会員登録機能 ======================================================*/
    public function pre_check(Request $request){
      $this->validator($request->all())->validate();
      //flash data
      $request->flashOnly('email');

      $bridge_request = $request->all();
      // password マスキング
      $bridge_request['password_mask'] = '******';

      return view('auth.register_check')->with($bridge_request);
    }

}
