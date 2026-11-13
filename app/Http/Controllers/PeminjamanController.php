<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
    public function index()
    {
        $peminjaman = Peminjaman::with(['alat', 'kategori', 'user'])->get();

        return view('home.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        $alat = Alat::all();
        $kategori = Kategori::all();
        $user = User::all();

        return view('home.peminjaman.create', compact('alat', 'kategori', 'user'));
    }

    public function ajukan()
    {
        $alat = Alat::all();

        return view('home.peminjaman.ajukan', compact('alat'));
    }

    public function submitAjukan(Request $request)
    {
        $request->validate([
            'id_alat' => 'required|exists:alats,id',
            'tanggal_dipinjam' => 'required|date',
            'jumlah_pinjam' => 'required|integer|min:1',
            'alasan_peminjaman' => 'required|string|max:255',
        ]);

        $user = Auth::user();

        if (! $user instanceof User || ! $user->canAccessFeature('peminjaman_ajukan')) {
            abort(403, 'Anda tidak memiliki izin untuk mengajukan peminjaman.');
        }

        $alat = Alat::findOrFail($request->id_alat);

        Peminjaman::create([
            'id_alat' => $request->id_alat,
            'id_kategori' => $alat->id_kategori,
            'id_user' => $user->id,
            'jumlah_pinjam' => $request->jumlah_pinjam,
            'alasan_peminjaman' => $request->alasan_peminjaman,
            'tanggal_dipinjam' => $request->tanggal_dipinjam,
            'tanggal_dikembalikan' => null,
            'status' => Peminjaman::STATUS_MENUNGGU,
            'pesan' => null,
        ]);

        $redirectRoute = $user->isPeminjam() ? 'return-monitoring.saya' : 'return-monitoring.index';

        return redirect()->route($redirectRoute)->with('success', 'Pengajuan peminjaman berhasil dikirim dan menunggu persetujuan.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_alat' => 'required|exists:alats,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_user' => 'required|exists:users,id',
            'tanggal_dipinjam' => 'required|date',
            'tanggal_dikembalikan' => 'nullable|date',
        ]);

        Peminjaman::create($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil ditambahkan');
    }

    public function edit(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $alat = Alat::all();
        $kategori = Kategori::all();
        $user = User::all();

        return view('home.peminjaman.edit', compact('peminjaman', 'alat', 'kategori', 'user'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'id_alat' => 'required|exists:alats,id',
            'id_kategori' => 'required|exists:kategoris,id',
            'id_user' => 'required|exists:users,id',
            'tanggal_dipinjam' => 'required|date',
            'tanggal_dikembalikan' => 'nullable|date',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->update($request->all());

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil diperbarui');
    }

    public function destroy(string $id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->route('peminjaman.index')->with('success', 'Data peminjaman berhasil dihapus');
    }
}
