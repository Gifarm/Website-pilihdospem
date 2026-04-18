<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Http\Request;

class ProdiController extends Controller
{

    public function index()
    {
        $prodis = Prodi::withCount(['dosens', 'users', 'pengajuans'])->get();

        return view('superadmin.prodi.index', compact('prodis'));
    }

    public function create()
    {
        return view('superadmin.prodi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_prodi' => 'required|unique:prodis,nama_prodi'
        ]);

        Prodi::create([
            'nama_prodi' => $request->nama_prodi
        ]);

        return redirect('/superadmin/prodi')->with('success', 'Prodi berhasil ditambahkan');
    }

    public function edit(Prodi $prodi)
    {
        return view('superadmin.prodi.edit', compact('prodi'));
    }

    public function update(Request $request, Prodi $prodi)
    {
        $request->validate([
            'nama_prodi' => 'required|unique:prodis,nama_prodi,' . $prodi->id
        ]);

        $prodi->update([
            'nama_prodi' => $request->nama_prodi
        ]);

        return redirect('/superadmin/prodi')->with('success', 'Prodi berhasil diupdate');
    }

    public function destroy(Prodi $prodi)
    {
        if ($prodi->dosens()->count() > 0 || $prodi->users()->count() > 0) {
            return back()->with('error', 'Prodi tidak bisa dihapus karena masih digunakan!');
        }

        $prodi->delete();

        return back()->with('success', 'Prodi berhasil dihapus');
    }
    /**
     * Display a listing of the resource.
     */


    /**
     * Display the specified resource.
     */
    public function show(Prodi $prodi)
    {
        //
    }
}
