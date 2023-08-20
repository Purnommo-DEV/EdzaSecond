<?php

namespace App\Http\Controllers;
use App\Models\Metode;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;


class MetodePembayaranController extends Controller
{
       public function metode(){
        $metodes = Metode::get();
        return view('admin.pages.metodepembayaran', compact('metodes'));
    }
       public function admin_tambah_metode(Request $request){

        $tambah_metode = new Metode();
        $tambah_metode->namametode = $request->namametode;
        $tambah_metode->namapemilik = $request->namapemilik;
        $tambah_metode->norekening = $request->norekening;
        // Ambil id terbaru
        // $metodes_id = DB::getPdo()->lastInsertId();

        // if($request->file('gambarmetode')){
        //     $gambarmetode= $request->file('gambarmetode');
        //     $filename= 'Metode_'.$metodes_id .'.'. $gambarmetode->getClientOriginalName();
        //     $gambarmetode->move(public_path('inputan/metode/'), $filename);
        //     $tambah_metode->gambarmetode= $filename;
        // }

        $tambah_metode->save();
        
        //Install SweetAlert ralrasyid
        // Alert::success('Sukses','Berhasil Menambah Kategori');
        return redirect()->back()->with('success');
    }
    public function admin_ubah_metode(Request $request, $id){
        $ubah_metode = Metode::find($id);
        $ubah_metode->namametode = $request->namametode;
        $ubah_metode->namapemilik = $request->namapemilik;
        $ubah_metode->norekening = $request->norekening;

        // if ($request->hasFile('gambarmetode')) {
        //     $gambarmetode = 'img' . $ubah_metode->gambarmetode;
        //     if (File::exists($gambarmetode)) {
        //         File::delete($gambarmetode);
        //     }
           
        //         $gambarmetode= $request->file('gambarmetode');
        //         $filename= 'Metode_'.$id .'.'. $gambarmetode->getClientOriginalName();
        //         $gambarmetode->move(public_path('inputan/metode/'), $filename);
        //         $ubah_metode->gambarmetode= $filename;
            
        // }
        $ubah_metode->save();
      
        return redirect()->back()->with('success');
    }
    public function destroy(Metode $id)
    {
        $id->delete();

        return redirect('admin/metodepembayaran')->with('success', 'Book deleted');
    }
    
}
