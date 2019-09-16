<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function adminLogin(Request $request){
        return view('admin.login');
    }
    public function doLogin(Request $request){
        $auth = auth()->guard('admin');

        $credentials = [
          'username'    => $request->username,
          'password' => $request->password,
        ];

        if ($auth->attempt($credentials)) {
          $request->session()->put('username', $request->username);
          return response()->json([
            'error'   => 0,
            'message' => 'Login Success',
            'username'   => $request->username
          ], 200);
        } else {
          return response()->json([
            'error'   => 2,
            'message' => 'Wrong Username or Password'
          ], 200);
        }
    }
    public function dashboard(Request $request){
        return view('admin.dashboard');
    }
}
