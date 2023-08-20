<?php

namespace App\Http\Controllers;

use App\Models\Metode;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class KeranjangController extends Controller
{
    public function keranjang () {
        $keranjang = Keranjang::where('user_id', Auth::user()->id)->get();
        $metodes = Metode::get();
        return view('pengguna.pages.keranjang', compact('metodes', 'keranjang'));
    }

    public function hapus_data_keranjang($id){
        Keranjang::where('id', $id)->delete();
        Alert::success('Sukses','Berhasil menghapus produk di keranjang');
        return redirect()->back();
    }
}
