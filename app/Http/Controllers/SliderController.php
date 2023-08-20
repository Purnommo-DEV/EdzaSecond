<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function slider(){
        $slider = Slider::get();
        return view('admin.pages.slider',compact('slider'));
    }

    public function admin_tambah_slider(Request $request){
        $tambah_slider = new Slider();
        $tambah_slider->judul = $request->judul;
        $tambah_slider->teks = $request->teks;
        $random = Str::random(5);

        if($request->file('gambar_slider')){
            $gambar_slider= $request->file('gambar_slider');
            $filename= $random.'-'.$gambar_slider->getClientOriginalName();
            $gambar_slider->move('inputan/img', $filename);
            $tambah_slider->gambar_slider= $filename;
        }

        $tambah_slider->save();
        return redirect()->back()->with('success');
    }

    public function admin_ubah_slider(Request $request, $id){
        $edit_slider = Slider::find($id);
        $edit_slider->judul = $request->judul;
        $edit_slider->teks = $request->teks;
        $random = Str::random(5);

        if ($request->hasFile('gambar_slider')) {
            $gambar_slider = 'inputan/img' . $edit_slider->gambar_slider;
            if (File::exists($gambar_slider)) {
                File::delete($gambar_slider);
                }
                $gambar_slider= $request->file('gambar_slider');
                $filename= $random.'-'.$gambar_slider->getClientOriginalName();
                $gambar_slider->move('inputan/img', $filename);
                $edit_slider->gambar_slider= $filename;
        }
        $edit_slider->save();
        return redirect()->back()->with('success');
    }

    public function admin_hapus_slider($id)
    {
        Slider::where('id', $id)->delete();

        return redirect()->back();
    }   
}