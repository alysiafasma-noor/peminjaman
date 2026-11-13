<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AlatController extends Controller
{
    public function index()
    {
        $alat = Alat::with('kategori')->get();

        return view('home.alat.index', compact('alat'));
    }

    public function daftar()
    {
        $alat = Alat::with('kategori')->get();

        return view('home.alat.daftar', compact('alat'));
    }

    public function create()
    {
        $kategori = Kategori::all();

        return view('home.alat.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
        ]);

        Alat::create($request->all());

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $alat = Alat::findOrFail($id);
        $kategori = Kategori::all();

        return view('home.alat.edit', compact('alat', 'kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_alat' => 'required|string|max:100',
            'id_kategori' => 'required|exists:kategoris,id',
            'stok' => 'required|integer|min:0',
        ]);

        $alat = Alat::findOrFail($id);
        $alat->update($request->all());

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $alat = Alat::findOrFail($id);
        $alat->delete();

        return redirect()->route('alat.index')->with('success', 'Data alat berhasil dihapus');
    }
}
