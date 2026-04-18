<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Pengajuan;

class SuperAdminController extends Controller
{
    //
    public function index()
    {
        return view('superadmin.dashboard', [
            'total_prodi' => Prodi::count(),
            'total_admin' => User::where('role', 'admin')->count(),
            'total_dosen' => Dosen::count(),
            'total_pengajuan' => Pengajuan::count(),
        ]);
    }

    public function reset()
    {
        Pengajuan::truncate();
        return back()->with('success', 'Semua data pengajuan berhasil direset!');
    }
}
