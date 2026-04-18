<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $fillable = ['nama_prodi'];
    //
    public function dosens()
    {
        return $this->hasMany(Dosen::class);
    }


    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function pengajuans()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
