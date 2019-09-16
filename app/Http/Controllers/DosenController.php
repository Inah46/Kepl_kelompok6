<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    public function dosenLogin(Request $request){
        return view('dosen.login');
    }
    public function doLogin(Request $request){
        $auth = auth()->guard('dosen');

        $credentials = [
          'nip'    => $request->nip,
          'password' => $request->password,
        ];

        if ($auth->attempt($credentials)) {
          $request->session()->put('nip', $request->nip);
          return response()->json([
            'error'   => 0,
            'message' => 'Login Success',
            'nip'   => $request->nip
          ], 200);
        } else {
          return response()->json([
            'error'   => 2,
            'message' => 'Wrong Username or Password'
          ], 200);
        }
    }
}
