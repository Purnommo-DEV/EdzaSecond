<?php

namespace App\Http\Controllers;
use App\Models\Produk;
use App\Models\Kategori;
use App\Models\Keranjang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
class DetailProdukController extends Controller
{
    public function detailproduk(Request $request, $id){
        $detail_produks = Produk::find($id);
        $kategoris  = Kategori::get();
        return view ('pengguna.pages.detailproduk',compact('detail_produks','kategoris'));
    }

}
