<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;

class ActivityLogController extends Controller
{
    private function getLogs(): array
    {
        return Peminjaman::with(['user', 'alat', 'kategori'])
            ->orderByDesc('created_at')
            ->get()
            ->map(function ($item) {
                $namaUser = $item->user?->name ?? 'User';
                $namaAlat = $item->alat?->nama_alat ?? 'Alat';
                $status = $item->tanggal_dikembalikan ? 'Selesai' : 'Sedang dipinjam';

                return [
                    'nama_user' => $namaUser,
                    'nama_alat' => $namaAlat,
                    'kategori' => $item->kategori?->nama_kategori ?? '-',
                    'tanggal_dipinjam' => $item->tanggal_dipinjam
                        ? \Carbon\Carbon::parse($item->tanggal_dipinjam)->translatedFormat('d M Y')
                        : '-',
                    'tanggal_dikembalikan' => $item->tanggal_dikembalikan
                        ? \Carbon\Carbon::parse($item->tanggal_dikembalikan)->translatedFormat('d M Y')
                        : '-',
                    'status' => $status,
                    'waktu' => $item->created_at
                        ? \Carbon\Carbon::parse($item->created_at)->translatedFormat('d M Y, H:i')
                        : '-',
                ];
            })
            ->all();
    }

    public function index()
    {
        $logs = $this->getLogs();

        return view('home.log_aktivitas', compact('logs'));
    }

    public function report()
    {
        $logs = $this->getLogs();

        return view('home.laporan', compact('logs'));
    }
}
