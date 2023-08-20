<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananProduk extends Model
{
    use HasFactory;

    protected $table ='pesanan_produk';
    protected $guarded =[];

    public function produk(){
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
    
}
