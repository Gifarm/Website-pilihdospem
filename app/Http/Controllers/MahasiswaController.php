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
                'jenjang' => $d->jenjang,
                'sisa' => $d->sisaKuota(),
                'full' => $d->isFull()
            ];
        }));
    }

    public function store(Request $request)
    {
        $dosen = Dosen::find($request->dosen_id);

        // VALIDASI KUOTA
        if ($dosen->isFull()) {
            return back()->with('error', 'Dosen sudah penuh!');
        }

        // 🚫 SUDAH DITERIMA (GLOBAL BLOCK)
        if (Pengajuan::where('nim', $request->nim)->where('status', 'disetujui')->exists()) {
            return back()->with('error', 'Pengajuan kamu sudah disetujui, tidak bisa mendaftar lagi.');
        }

        // 🚫 MASIH PENDING
        if (Pengajuan::where('nim', $request->nim)->where('status', 'pending')->exists()) {
            return back()->with('error', 'Kamu sudah mengajukan, silakan tunggu proses.');
        }

        // ✅ BOLEH (ditolak atau belum ada)
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
