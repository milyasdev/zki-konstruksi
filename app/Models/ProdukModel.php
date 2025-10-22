<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProdukModel extends Model
{
    protected $table = 't_product';
    protected $fillable = [
        'judul',
        'deskripsi',
        'harga',
        'kategori',
        'sub_kategori',
        'satuan',
        'min_pembelian',
        'dimensi_unit',
        'berat',
        'merk',
        'stock',
        'gambar',
    ];

    public function kategoriRelasi()
    {
        return $this->belongsTo(KategoriModel::class, 'kategori', 'id');
    }
}
