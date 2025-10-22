<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriModel extends Model
{
    protected $table = 't_kategori';
    protected $fillable = [
        'judul',
        'deskripsi',
        'status'];
}
