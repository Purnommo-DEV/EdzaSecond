<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kategori;

class Produk extends Model
{
    use HasFactory;

    protected $table ='produk';
    protected $guarded =[];
    
    public function katadmin()
    {
        return $this->belongsTo(Kategori::class, 'kategoris_id', 'id');
    }
}

