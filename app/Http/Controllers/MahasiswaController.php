<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prodi;
use App\Models\Dosen;
use App\Models\Pengajuan;


class MahasiswaController extends Controller
{
    public function form()
    {
        $prodis = Prodi::all();
        return view('mahasiswa.form', compact('prodis'));
    }

    public function getDosen($prodi_id)
    {
        $dosens = Dosen::where('prodi_id', $prodi_id)->get();

        return response()->json($dosens->map(function ($d) {
            return [
                'id' => $d->id,
                'nama' => $d->nama,
                'sisa' => $d->sisaKuota(),
                'full' => $d->isFull()
            ];
        }));
    }

    public function store(Request $request)
    {
        $dosen = Dosen::find($request->dosen_id);

        // 🔥 VALIDASI KUOTA
        if ($dosen->isFull()) {
            return back()->with('error', 'Dosen sudah penuh!');
        }

        // 🔥 VALIDASI NIM
        if (Pengajuan::where('nim', $request->nim)->exists()) {
            return back()->with('error', 'NIM sudah pernah mendaftar!');
        }

        Pengajuan::create([
            'nama_mahasiswa' => $request->nama_mahasiswa,
            'nim' => $request->nim,
            'no_hp' => $request->no_hp,
            'tema_ta' => $request->tema_ta,
            'dosen_id' => $request->dosen_id,
            'prodi_id' => $request->prodi_id,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Pengajuan berhasil dikirim!');
    }
}
