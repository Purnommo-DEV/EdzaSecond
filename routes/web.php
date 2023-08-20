 <?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KatAdminController;
use App\Http\Controllers\ProdukadminController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\DetailProdukController;
use App\Http\Controllers\KeranjangController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DataPesananController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MetodePembayaranController;
use App\Http\Controllers\SliderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',  [PenggunaController::class, 'beranda']) -> name('Beranda');
Route::get('/kategoripengguna/{id}',  [PenggunaController::class, 'kategori']) -> name('kategoripengguna');
Route::get('/detailproduk/{id}',  [DetailProdukController::class, 'detailproduk'])->name('detailproduk');
Route::post('/userLogout',           [LoginController::class, 'user_logout'])->name('UserLogOut');

Route::get('/halamanProduk',  [PenggunaController::class, 'produk']) -> name('HalamanProduk');
Route::get('/login',  [LoginController::class, 'login'])->name('Login');
Route::get('/register',  [LoginController::class, 'register'])->name('Register');
Route::post('/tambahUser',  [LoginController::class, 'tambah_user'])->name('TambahUser');
Route::get('/kota/{provinsi_id}', [LoginController::class, 'data_kota']);
Route::post('/cekLogin',       [LoginController::class, 'cek_login'])->name('CekLogin');

Route::middleware(['auth', 'hakAkses:Pelanggan'])->group(function () {
    Route::get('/profil',  [PenggunaController::class, 'profil'])->name('Profil');
    Route::get('/keranjang',  [KeranjangController::class, 'keranjang'])->name('Keranjang');
    Route::post('/tambahKeKeranjang',  [PenggunaController::class, 'tambah_ke_keranjang'])->name('TambahKeKeranjang');
    Route::get('/checkout',  [CheckoutController::class, 'checkout'])->name('Checkout');
    Route::get('/totalProdukDlmKeranjang',  [PenggunaController::class, 'total_produk_keranjang']);
    Route::get('/hapusDataKeranjang/{id}',    [KeranjangController::class, 'hapus_data_keranjang']);
    Route::post('/pembayaran',    [CheckoutController::class, 'pembayaran'])->name('Pembayaran');
    Route::post('/konfirmasiTerima', [PenggunaController::class, 'konfirmasi_terima_pesanan'])->name('KonfirmasiTerimaPesanan');
});

// admin
Route::middleware(['auth', 'hakAkses:Admin'])->group(function () {
Route::prefix('/admin')
    ->namespace('Admin')
   
    ->group(
        function(){

// Route::middleware(['auth', 'cekRole:Admin'])->group(function () {
    Route::get('/',  [DashboardController::class, 'dashboard']) -> name('dashboard');

    // kategori
    Route::get('/kategori',  [KatAdminController::class, 'kategori']) -> name('kategori');
    Route::post('/tambahKategori', [KatAdminController::class, 'admin_tambah_kategori'])->name('TambahKategori');
    Route::post('/editKategori/{id}',[KatAdminController::class, 'admin_edit_kategori'])->name('UbahKategori');
    Route::delete('/kategori/{id}', [KatAdminController::class, 'destroy'])->name('kategoris.destroy');

    //produk
    Route::get('/produk',  [ProdukadminController::class, 'produk']) -> name('produk');
    Route::post('/tambahProduk', [ProdukadminController::class, 'admin_tambah_produk'])->name('Tambahproduk');
    Route::post('/editProduk/{id}',[ProdukadminController::class, 'admin_edit_produk'])->name('Ubahproduk');
    Route::delete('/produk/{id}', [ProdukadminController::class, 'destroy'])->name('produks.destroy');
   
    Route::get('/metodepembayaran',  [MetodePembayaranController::class, 'metode']) -> name('metode');
    Route::post('/tambahMetodePembayaran', [MetodePembayaranController::class, 'admin_tambah_metode'])->name('TambahMetode');
    Route::post('/editMetodePembayaran/{id}',[MetodePembayaranController::class, 'admin_ubah_metode'])->name('UbahMetode');
    Route::delete('/metode/{id}', [MetodePembayaranController::class, 'destroy'])->name('metodes.destroy');

    Route::get('/slider',  [SliderController::class, 'slider']) -> name('slider');
    Route::post('/tambahSlider', [SliderController::class, 'admin_tambah_slider'])->name('TambahSlider');
    Route::post('/editSlider/{id}',[SliderController::class, 'admin_ubah_slider'])->name('UbahSlider');
    Route::delete('/slider/{id}', [SliderController::class, 'admin_hapus_slider'])->name('HapusSliders');

    Route::get('/pesanan',  [DataPesananController::class, 'pesanan']) -> name('pesanan');
    Route::get('/pesananDetail/{id}',  [DataPesananController::class, 'pesanan_detail']) -> name('PesananDetail');
    Route::post('/verifikasiPembayaran', [DataPesananController::class, 'verifikasi_pembayaran'])->name('VerifikasiPembayaran');
    Route::post('/statusPesananLogs',           [DataPesananController::class, 'status_pesanan_logs'])->name('StatusPesananLogs');
    });
});

 // Metode Pembayaran
       