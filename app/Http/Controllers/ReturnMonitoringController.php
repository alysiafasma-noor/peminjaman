<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReturnMonitoringController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $query = Peminjaman::query()
            ->with(['user', 'alat', 'kategori'])
            ->orderByDesc('created_at');

        if ($user instanceof User && $user->isPeminjam()) {
            $query->where('id_user', $user->id);
        }

        $peminjaman = $query->get();

        return view('home.return_monitoring.index', compact('peminjaman'));
    }

    public function saya()
    {
        $user = Auth::user();

        if (! $user instanceof User) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        $peminjaman = Peminjaman::query()
            ->with(['user', 'alat', 'kategori'])
            ->where('id_user', $user->id)
            ->orderByDesc('created_at')
            ->get();

        return view('home.return_monitoring.saya', compact('peminjaman'));
    }

    public function kembali(Request $request, $id)
    {
        $peminjaman = Peminjaman::with('alat')->findOrFail($id);
        $currentUser = Auth::user();

        if (! $currentUser instanceof User) {
            abort(401, 'Silakan login terlebih dahulu.');
        }

        if ($currentUser->isPeminjam()) {
            abort(403, 'Peminjam tidak dapat menandai barang kembali.');
        }

        if (! $currentUser->isAdmin() && ! $currentUser->isPetugas()) {
            abort(403, 'Anda tidak berhak mengembalikan barang ini.');
        }

        if (! in_array($peminjaman->status, [Peminjaman::STATUS_DISETUJUI, Peminjaman::STATUS_SEDANG_DIPINJAM], true)) {
            abort(403, 'Barang belum aktif untuk dikembalikan.');
        }

        if (! empty($peminjaman->tanggal_dikembalikan)) {
            abort(403, 'Barang sudah dikembalikan.');
        }

        $alat = $peminjaman->alat;

        if ($alat) {
            $alat->stok += (int) $peminjaman->jumlah_pinjam;
            $alat->save();
        }

        $peminjaman->status = Peminjaman::STATUS_SUDAH_DIKEMBALIKAN;
        $peminjaman->tanggal_dikembalikan = $request->tanggal_dikembalikan ?? now()->toDateString();
        $peminjaman->save();

        return redirect()->route('return-monitoring.index')->with('success', 'Barang berhasil dikembalikan dan stok alat kembali bertambah.');
    }
}
