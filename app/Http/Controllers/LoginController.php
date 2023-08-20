<?php

namespace App\Http\Controllers;

use App\Models\Kota;
use App\Models\User;
use App\Models\Provinsi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;


class LoginController extends Controller
{
    public function login(){
        return view('pengguna.pages.login');
    }
    
    public function register(){
        $provinsi = Provinsi::pluck('nama', 'id');
        return view('pengguna.pages.register', compact('provinsi'));
    }

    public function data_kota($provinsi_id){
        $kota = Kota::where('provinsi_id', $provinsi_id)->pluck('nama', 'id');
        return response()->json($kota);
    }

    public function tambah_user(Request $request){
        $daftar_baru = new User();
        $daftar_baru->name = $request->name;
        $daftar_baru->email = $request->email;
        $daftar_baru->nomor_hp = $request->nomor_hp;
        $daftar_baru->alamat = $request->alamat;
        $daftar_baru->password = Hash::make("22222222");
        $daftar_baru->provinsi_id = $request->provinsi_id;
        $daftar_baru->kota_id = $request->kota_id;
        $daftar_baru->peran = "Pelanggan";
        $daftar_baru->save();
        Alert::success('Sukses','Berhasil Membuat Akun');
        return redirect()->route('Login');
    }

    public function cek_login(Request $request){
        $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($request->only('email','password'))){
            if (auth()->user()->peran == 'Pelanggan') {
                return redirect()->route('Beranda');
            } 
            elseif (auth()->user()->peran == 'Admin') {
                return redirect()->route('produk');
            }
        }else{
            Alert::error('Gagal Login', '<br> <small>Cek kembali Email dan Password Anda');
            return redirect()->route('Login')
    
            ->with('error','Email-Address And Password Are Wrong.');
        }
    }

    public function user_logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/');
    }
    
}
