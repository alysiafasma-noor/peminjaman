<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    protected function authorizeApproval(): void
    {
        $user = Auth::user();

        if (! $user instanceof User || (! $user->isAdmin() && ! $user->isPetugas())) {
            abort(403, 'Hanya admin dan petugas yang dapat mengelola persetujuan peminjaman.');
        }
    }

    public function index()
    {
        $peminjaman = Peminjaman::with(['user', 'alat', 'kategori'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                $item->status = $item->status ?? Peminjaman::STATUS_MENUNGGU;
                return $item;
            });

        return view('home.approval.index', compact('peminjaman'));
    }

    public function approve($id)
    {
        $this->authorizeApproval();

        $peminjaman = Peminjaman::with('alat')->findOrFail($id);

        if ($peminjaman->status === Peminjaman::STATUS_SUDAH_DIKEMBALIKAN) {
            return redirect()->route('approval.index')->with('error', 'Peminjaman ini sudah selesai dan tidak dapat disetujui lagi.');
        }

        $alat = $peminjaman->alat;

        if (! $alat) {
            abort(404, 'Data alat tidak ditemukan.');
        }

        if ($alat->stok < (int) $peminjaman->jumlah_pinjam) {
            return redirect()->route('approval.index')->with('error', 'Stok alat tidak mencukupi untuk jumlah yang dipinjam.');
        }

        $alat->stok -= (int) $peminjaman->jumlah_pinjam;
        $alat->save();

        $peminjaman->status = Peminjaman::STATUS_SEDANG_DIPINJAM;
        $peminjaman->pesan = null;
        $peminjaman->tanggal_dikembalikan = null;
        $peminjaman->save();

        return redirect()->route('approval.index')->with('success', 'Peminjaman berhasil disetujui dan stok alat otomatis berkurang.');
    }

    public function reject(Request $request, $id)
    {
        $this->authorizeApproval();

        $request->validate([
            'pesan' => 'required|string|max:255',
        ]);

        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->status = Peminjaman::STATUS_DITOLAK;
        $peminjaman->pesan = $request->pesan;
        $peminjaman->save();

        return redirect()->route('approval.index')->with('success', 'Pengajuan peminjaman berhasil ditolak.');
    }
}
