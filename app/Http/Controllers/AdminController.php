<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Dosen;
use App\Mahasiswa;

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
        $dosen = Dosen::count();
        $mhs   = Mahasiswa::count();

        return view('admin.dashboard', compact('dosen', 'mhs'));
    }

    //dosen
    public function dataDosen(Request $request){
       $dosen = DB::table('tb_dosen')->get();

       return view('admin.datadosen', compact('dosen'));
    }
    public function addDosen(Request $request){
       $cek = DB::table('tb_dosen')->where('nip', $request->nip)->count();

       if($cek == 0){
         $add = Dosen::create($request->all());

         if($add){
           return response()->json([
             'error'   => 0,
             'message' => 'Success'
           ], 200);
         }else{
           return response()->json([
             'error'   => 2,
             'message' => 'Gagal'
           ], 200);
         }
       }else{
         return response()->json([
           'error'   => 1,
           'message' => 'NIP Sudah Dipakai'
         ], 200);
       }
    }

    public function deleteDosen(Request $request){
       $data = Dosen::findOrFail($request->nip);

       try {
           $data->delete();

           if( $data ){
             return response()->json([
               'error' => 0,
               'message' => 'Success Delete Data'
             ], 200);
           }
         } catch (\Exception $e) {
             return response()->json([
               'error' => 1,
               'message' => 'Failed Delete Data'
             ], 200);
         }
    }

    //mahasiswa
    public function dataMahasiswa(Request $request){
       $mahasiswa = DB::table('tb_mahasiswa')->get();

       return view('admin.datamhs', compact('mahasiswa'));
    }
    public function addMahasiswa(Request $request){
       $cek = DB::table('tb_mahasiswa')->where('nim', $request->nim)->count();

       if($cek == 0){
         $add = Mahasiswa::create($request->all());

         if($add){
           return response()->json([
             'error'   => 0,
             'message' => 'Success'
           ], 200);
         }else{
           return response()->json([
             'error'   => 2,
             'message' => 'Gagal'
           ], 200);
         }
       }else{
         return response()->json([
           'error'   => 1,
           'message' => 'NIM Sudah Dipakai'
         ], 200);
       }
    }

    public function deleteMahasiswa(Request $request){
       $data = Mahasiswa::findOrFail($request->nim);

       try {
           $data->delete();

           if( $data ){
             return response()->json([
               'error' => 0,
               'message' => 'Success Delete Data'
             ], 200);
           }
         } catch (\Exception $e) {
             return response()->json([
               'error' => 1,
               'message' => 'Failed Delete Data'
             ], 200);
         }
    }
}
