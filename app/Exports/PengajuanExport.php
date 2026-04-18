<?php

namespace App\Exports;

use App\Models\Pengajuan;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengajuanExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Pengajuan::with('dosen')
            ->where('prodi_id', Auth::user()->prodi_id)
            ->get()
            ->map(function ($p) {
                return [
                    'Nama' => $p->nama_mahasiswa,
                    'NIM' => $p->nim,
                    'No HP' => $p->no_hp,
                    'Tema TA' => $p->tema_ta,
                    'Dosen' => $p->dosen->nama,
                    'Status' => $p->status,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Nama',
            'NIM',
            'No HP',
            'Tema TA',
            'Dosen',
            'Status'
        ];
    }
}
