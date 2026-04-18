<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    protected $fillable = ['nama_mahasiswa', 'nim', 'no_hp', 'tema_ta', 'status', 'dosen_id', 'prodi_id'];
    //
    public function dosen()
    {
        return $this->belongsTo(Dosen::class);
    }

    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }
}
