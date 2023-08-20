<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Pembayaran;
use App\Models\PesananLogs;
use Illuminate\Http\Request;
use App\Models\PesananProduk;
use RealRashid\SweetAlert\Facades\Alert;

class DataPesananController extends Controller
{
    public function pesanan(){
        $pesanan = Pesanan::get();
        return view('admin.pages.pesanan', compact('pesanan'));
    }

    public function pesanan_detail($id){
        $pesanan_logs = PesananLogs::where('pesanan_id', $id)->orderBy('id', 'DESC')->get();
        $pesananPelanggan = Pesanan::where('id', $id)->first();
        $transferPembayaran = Pembayaran::where('pesanan_id', $id)->first();
        $produkDiPesan = PesananProduk::where('pesanan_id', $id)->get();
        return view('admin.pages.pesanan_detail', compact('pesanan_logs','pesananPelanggan', 'transferPembayaran', 'produkDiPesan'));
    }

    public function verifikasi_pembayaran(Request $request){
        $data = $request->all();
        Pembayaran::where('pesanan_id', $data['pesanan_id'])->update([
            'status_verifikasi'=> "Sudah Di Verifikasi"
        ]);
        Pesanan::where('id', $data['pesanan_id'])->update([
            'status_pesanan'=> "Pending"
        ]);
        Alert::success('Sukses','Berhasil Verifikasi Pembayaran');
        return redirect()->back()->with('success');
    }

    public function status_pesanan_logs(Request $request){
        $pesanan_logs = new PesananLogs();
        $pesanan_logs->pesanan_id = $request->pesanan_id;
        $pesanan_logs->pesanan_status = $request->pesanan_status;
        $pesanan_logs->save();

        Pesanan::where('id', $pesanan_logs->pesanan_id)->update([
            'resi'=>$request->resi,
            'status_pesanan'=>$request->pesanan_status
        ]);
        Alert::success('Sukses','Berhasil Memperbarui Status Pesanan');
        return redirect()->back()->with('success');
    }
}
