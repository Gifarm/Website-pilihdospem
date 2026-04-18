<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class DosenController extends Controller
{
    public function index()
    {
        $dosens = Dosen::where('prodi_id', Auth::user()->prodi_id)->get();

        return view('admin.dosen.index', compact('dosens'));
    }

    public function create()
    {
        return view('admin.dosen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'bidang_keahlian' => 'required',
            'kuota' => 'required|integer|min:1'
        ]);

        Dosen::create([
            'nama' => $request->nama,
            'bidang_keahlian' => $request->bidang_keahlian,
            'kuota' => $request->kuota,
            'prodi_id' => Auth::user()->prodi_id // 🔥 AUTO
        ]);

        return redirect('/admin/dosen')->with('success', 'Dosen berhasil ditambahkan');
    }

    public function edit(Dosen $dosen)
    {
        // 🔥 SECURITY: pastikan dosen milik prodi admin
        if ($dosen->prodi_id != Auth::user()->prodi_id) {
            abort(403);
        }

        return view('admin.dosen.edit', compact('dosen'));
    }

    public function update(Request $request, Dosen $dosen)
    {
        if ($dosen->prodi_id != Auth::user()->prodi_id) {
            abort(403);
        }

        $request->validate([
            'nama' => 'required',
            'bidang_keahlian' => 'required',
            'kuota' => 'required|integer|min:1'
        ]);

        $dosen->update($request->all());

        return redirect('/admin/dosen')->with('success', 'Dosen berhasil diupdate');
    }

    public function destroy(Dosen $dosen)
    {
        if ($dosen->prodi_id != Auth::user()->prodi_id) {
            abort(403);
        }

        $dosen->delete();

        return back()->with('success', 'Dosen dihapus');
    }



    /**
     * Display the specified resource.
     */
    public function show(Dosen $dosen)
    {
        //
    }
}
