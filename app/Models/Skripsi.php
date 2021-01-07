<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Skripsi extends Model
{
    protected $table = 'skripsi_uim';

    protected $fillable = [
        'nama', 'nim', 'fakultas', 'jurusan',
        'judul_skripsi', 'angkatan', 'kontak'
    ];


}
