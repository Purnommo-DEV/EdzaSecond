<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Pesanan;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Pembayaran;
use App\Models\PesananLogs;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use App\Models\Slider;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PenggunaController extends Controller
{
    public function beranda(){
        $slider = Slider::get();
        $produks = Produk::paginate(6);
        $kategoris  = Kategori::get();
        return view ('pengguna.pages.beranda',compact('produks','kategoris', 'slider'));
    }
 
    public function produk(){
        $produks = Produk::get();
        return view ('pengguna.pages.produk',compact('produks'));
    }

    public function profil(){
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->get();
        $produkDiPesan = PesananProduk::where('user_id', Auth::user()->id)->get();
        $buktiTransfer = Pembayaran::where('user_id', Auth::user()->id)->get();
        return view('pengguna.pages.profil', compact('pesanan', 'produkDiPesan', 'buktiTransfer'));
    }

    public function kategori(Request $request, $id){
        $produks = Produk::get();
        $kategoris  = Kategori::get();
        return view ('pengguna.pages.kategori',compact('produks','kategoris'));
    }

    public function total_produk_keranjang(){
        $total_produk_keranjang = Keranjang::where('user_id', Auth::user()->id)->count();
        return response()->json(['totalProdukKeranjang' => $total_produk_keranjang]);
    }

    public function tambah_ke_keranjang(Request $request){

        $produk_id = $request->produk_id;
        $kuantitas = $request->kuantitas;
        $berat_produk = $request->berat_produk;
        $produk_harga = $request->harga_produk;

         if (Auth::id() == null) {
            return response()->json(['status' => "Silahkan Login untuk Melanjutkan "]);
        }else{
            if(Keranjang::where('user_id', Auth::user()->id)->where('produk_id',$produk_id)->exists()){
                return response()->json(['status'=>'Produk Telah ada di Keranjang']);
            }else{
                $tambahKeKeranjang = new Keranjang();
                $tambahKeKeranjang->user_id = Auth::user()->id;
                $tambahKeKeranjang->produk_id = $produk_id;
                $tambahKeKeranjang->kuantitas = $kuantitas;
                $tambahKeKeranjang->berat_produk = $berat_produk;
                $tambahKeKeranjang->harga_produk = $produk_harga;
                $tambahKeKeranjang->save();
                return response()->json(['status'=>'Berhasil Menambahkan Produk ke Keranjang']);
            }
        }
    }
    public function konfirmasi_terima_pesanan(Request $request){

        $data_id = $request->all();
        Pesanan::where('id', $data_id['id'])->where('user_id', Auth::user()->id)->update([
            'status_pesanan'=>'Pesanan Di Terima'
        ]);

        $statusPesanan = new PesananLogs();
        $statusPesanan->pesanan_id = $data_id['id'];
        $statusPesanan->pesanan_status = "Pesanan Di Terima";
        $statusPesanan->save();
        
        Alert::success('Sukses','Berhasil Konfirmasi Pesanan');
        return redirect()->route('Profil')->with('success');
    }
    
}
