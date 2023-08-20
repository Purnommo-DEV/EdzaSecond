<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Http\Request;

class KatAdminController extends Controller
{
    public function kategori(){
        $kategoris = Kategori::get();
        return view('admin.pages.kategori',compact('kategoris'));
    }

    public function admin_tambah_kategori(Request $request){
        $tambah_kategori = new Kategori();
        $tambah_kategori->namakat = $request->namakat;
        $tambah_kategori->slug = Str::slug($request->namakat);
        $kategoris_id = DB::getPdo()->lastInsertId();

        if($request->file('gambarkat')){
            $gambarkat= $request->file('gambarkat');
            $filename= 'Kategori_'.$kategoris_id .'.'. $gambarkat->getClientOriginalName();
            $gambarkat->move(public_path('inputan/img'), $filename);
            $tambah_kategori->gambarkat= $filename;
        }

        $tambah_kategori->save();
    //Install SweetAlert ralrasyid
    // Alert::success('Sukses','Berhasil Menambah Kategori');
        return redirect()->back()->with('success');
    }

    public function admin_edit_kategori(Request $request, $id){
        $edit_kategori = Kategori::find($id);
        $edit_kategori->namakat = $request->namakat;
        $edit_kategori->slug = Str::slug($request->namakat);

        if ($request->hasFile('gambarkat')) {
            $gambarkat = 'img' . $edit_kategori->gambarkat;
            if (File::exists($gambarkat)) {
                File::delete($gambarkat);
            }
        
                $gambarkat= $request->file('gambarkat');
                $filename= 'Kategori_'.$id .'.'. $gambarkat->getClientOriginalName();
                $gambarkat->move(public_path('inputan/img'), $filename);
                $edit_kategori->gambarkat= $filename;
            
        }
        $edit_kategori->save();
        return redirect()->back()->with('success');
    }

    public function destroy(Kategori $id)
    {
        $id->delete();

        return redirect('admin/kategori')->with('success', 'Book deleted');
    }   

}
