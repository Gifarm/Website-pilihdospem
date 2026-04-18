<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    protected $fillable = ['nama', 'bidang_keahlian', 'kuota', 'prodi_id'];
    //
    public function prodi()
    {
        return $this->belongsTo(Prodi::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
    public function sisaKuota()
    {
        return $this->kuota - $this->pengajuans()->count();
    }

    public function isFull()
    {
        return $this->pengajuans()->count() >= $this->kuota;
    }
}
