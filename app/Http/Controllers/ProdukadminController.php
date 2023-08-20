<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Kategori;

class ProdukadminController extends Controller
{
       public function produk(){
        $produks = Produk::get();
        $kategori  = Kategori::get();
        return view('admin.pages.produk',compact('produks','kategori'));
    }

 public function admin_tambah_produk(Request $request){
        $tambah_produk = new Produk();
        $tambah_produk->namaproduk = $request->namaproduk;
        $tambah_produk->slug = Str::slug($request->namaproduk);
        $tambah_produk->berat = $request->berat;
        $tambah_produk->kategoris_id = $request->kategoris_id; 
        $tambah_produk->harga = $request->harga;
        // $tambah_produk->stok = $request->stok;
        $tambah_produk->diskon = $request->diskon;
        $tambah_produk->deskripsi = $request->deskripsi;
       

      if($request->file('gambarproduk1')){
          $gambarproduk1= $request->file('gambarproduk1');
         $filename=  $gambarproduk1->getClientOriginalName();
          $gambarproduk1->move(public_path('inputan/produk/img'), $filename);
          $tambah_produk->gambarproduk1= $filename;
      }
       if($request->file('gambarproduk2')){
          $gambarproduk2= $request->file('gambarproduk2');
          $filename=  $gambarproduk2->getClientOriginalName();
          $gambarproduk2->move(public_path('inputan/produk/img'), $filename);
          $tambah_produk->gambarproduk2= $filename;
      }
      if($request->file('gambarproduk3')){
          $gambarproduk3= $request->file('gambarproduk3');
          $filename=  $gambarproduk3->getClientOriginalName();
          $gambarproduk3->move(public_path('inputan/produk/img'), $filename);
          $tambah_produk->gambarproduk3= $filename;
      }
        if($request->file('gambarproduk4')){
          $gambarproduk4= $request->file('gambarproduk4');
          $filename=  $gambarproduk4->getClientOriginalName();
          $gambarproduk4->move(public_path('inputan/produk/img'), $filename);
          $tambah_produk->gambarproduk4= $filename;
      }

        $tambah_produk->save();  
        return redirect()->route('produk')->with('success');
 }
public function admin_edit_produk(Request $request, $id){
   
    $edit_produk = Produk::where('id', $id)->first();
    $edit_produk->namaproduk = $request->namaproduk;
    $edit_produk->slug = Str::slug($request->namaproduk);
    $edit_produk->kategoris_id = $request->kategoris_id;
    $edit_produk->berat = $request->berat;
    // $edit_produk->stok = $request->stok; 
    $edit_produk->harga = $request->harga;
    $edit_produk->diskon = $request->diskon;
    $edit_produk->deskripsi = $request->deskripsi;
       

    if ($request->hasFile('gambarproduk1')) {
        $gambarproduk1 = 'inputan/produk/img/' . $edit_produk->gambarproduk1;
        if (File::exists($gambarproduk1)) {
            File::delete($gambarproduk1);
        }
       
            $gambarproduk1= $request->file('gambarproduk1');
            $filename=  $gambarproduk1->getClientOriginalName();
            $gambarproduk1->move(public_path('inputan/produk/img'), $filename);
            $edit_produk->gambarproduk1= $filename;
        
    }
    if ($request->hasFile('gambarproduk2')) {
        $gambarproduk2 = 'inputan/produk/img/' . $edit_produk->gambarproduk2;
        if (File::exists($gambarproduk2)) {
            File::delete($gambarproduk2);
        }
       
            $gambarproduk2= $request->file('gambarproduk2');
            $filename=  $gambarproduk2->getClientOriginalName();
            $gambarproduk2->move(public_path('inputan/produk/img'), $filename);
            $edit_produk->gambarproduk2= $filename;
        
    }
    if ($request->hasFile('gambarproduk3')) {
        $gambarproduk3 = 'inputan/produk/img/' . $edit_produk->gambarproduk3;
        if (File::exists($gambarproduk3)) {
            File::delete($gambarproduk3); 
        }
       
            $gambarproduk3= $request->file('gambarproduk3');
            $filename=  $gambarproduk3->getClientOriginalName();
            $gambarproduk3->move(public_path('inputan/produk/img'), $filename);
            $edit_produk->gambarproduk4= $filename;
        
    }
    if ($request->hasFile('gambarproduk4')) {
        $gambarproduk4 = 'inputan/produk/img/' . $edit_produk->gambarproduk4;
        if (File::exists($gambarproduk4)) {
            File::delete($gambarproduk4);
        }
       
            $gambarproduk4= $request->file('gambarproduk4');
            $filename=  $gambarproduk4->getClientOriginalName();
            $gambarproduk4->move(public_path('inputan/produk/img'), $filename);
            $edit_produk->gambarproduk4= $filename;
        
    }
    $edit_produk->save();
  
    return redirect()->back()->with('success');
}

public function destroy(Produk $id)
{
    $id->delete();

    return redirect('admin/produk')->with('success', 'Book deleted');
}   

}