<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dosen;
use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function index()
    {
        $prodi_id = Auth::user()->prodi_id;

        return view('admin.dashboard', [
            'total_dosen' => Dosen::where('prodi_id', $prodi_id)->count(),
            'total_pengajuan' => Pengajuan::where('prodi_id', $prodi_id)->count(),
            'pending' => Pengajuan::where('prodi_id', $prodi_id)->where('status', 'pending')->count(),
            'disetujui' => Pengajuan::where('prodi_id', $prodi_id)->where('status', 'disetujui')->count(),
            'ditolak' => Pengajuan::where('prodi_id', $prodi_id)->where('status', 'ditolak')->count(),
        ]);
    }
}
