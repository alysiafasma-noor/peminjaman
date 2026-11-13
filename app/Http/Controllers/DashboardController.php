<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser = User::count();
        $totalKategori = Kategori::count();
        $totalAlat = Alat::count();
        $totalPeminjaman = Peminjaman::count();

        return view('home.dashboard', compact(
            'totalUser',
            'totalKategori',
            'totalAlat',
            'totalPeminjaman'
        ));
    }
}
