<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    protected $fillable = [
        'kategori',
        'judul',
        'deskripsi',
        'dasar_hukum',
        'maklumat_image',
        'persyaratan',
        'sistem_mekanisme',
        'flowchart_image',
        'jangka_waktu',
        'biaya',
        'produk_pelayanan',
        'pengaduan',
        'informasi_tambahan',
        'link_sippn',
        'file_download',
    ];
}
