@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $totalUser ?? 0 }}</h3>
                <p>User</p>
              </div>
              <div class="icon"><i class="fas fa-users"></i></div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{ $totalKategori ?? 0 }}</h3>
                <p>Kategori</p>
              </div>
              <div class="icon"><i class="fas fa-tags"></i></div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{ $totalAlat ?? 0 }}</h3>
                <p>Alat</p>
              </div>
              <div class="icon"><i class="fas fa-tools"></i></div>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $totalPeminjaman ?? 0 }}</h3>
                <p>Peminjaman</p>
              </div>
              <div class="icon"><i class="fas fa-hand-holding"></i></div>
            </div>
          </div>
        </div>

        @php
            $user = auth()->user();
            $features = [];

            if ($user && $user->isAdmin()) {
                $features = [
                    ['title' => 'Kelola User', 'icon' => 'fas fa-users', 'class' => 'bg-primary', 'url' => route('user.index')],
                    ['title' => 'Log Aktivitas', 'icon' => 'fas fa-history', 'class' => 'bg-info', 'url' => route('log.aktivitas')],
                    ['title' => 'Kelola Kategori', 'icon' => 'fas fa-tags', 'class' => 'bg-warning', 'url' => route('kategori.index')],
                    ['title' => 'Kelola Alat', 'icon' => 'fas fa-toolbox', 'class' => 'bg-success', 'url' => route('alat.index')],
                    ['title' => 'Kelola Peminjaman', 'icon' => 'fas fa-handshake', 'class' => 'bg-secondary', 'url' => route('peminjaman.index')],
                    ['title' => 'Menetujui Peminjaman', 'icon' => 'fas fa-check-circle', 'class' => 'bg-success', 'url' => route('approval.index')],
                    ['title' => 'Memantau Pengembalian', 'icon' => 'fas fa-clipboard-check', 'class' => 'bg-warning', 'url' => route('return-monitoring.index')],
                    ['title' => 'Mencetak Laporan', 'icon' => 'fas fa-print', 'class' => 'bg-info', 'url' => route('laporan')],
                ];
            } elseif ($user && $user->isPetugas()) {
                $features = [
                    ['title' => 'Menetujui Peminjaman', 'icon' => 'fas fa-check-circle', 'class' => 'bg-success', 'url' => route('approval.index')],
                    ['title' => 'Memantau Pengembalian', 'icon' => 'fas fa-clipboard-check', 'class' => 'bg-warning', 'url' => route('return-monitoring.index')],
                    ['title' => 'Mencetak Laporan', 'icon' => 'fas fa-print', 'class' => 'bg-info', 'url' => route('laporan')],
                ];
            } elseif ($user && $user->isPeminjam()) {
                $features = [
                    ['title' => 'Melihat daftar alat', 'icon' => 'fas fa-list', 'class' => 'bg-info', 'url' => route('alat.daftar')],
                    ['title' => 'Mengajukan peminjaman', 'icon' => 'fas fa-hand-holding', 'class' => 'bg-success', 'url' => route('peminjaman.ajukan')],
                    ['title' => 'Mengembalikan alat', 'icon' => 'fas fa-undo-alt', 'class' => 'bg-warning', 'url' => route('return-monitoring.saya')],
                ];
            }
        @endphp

        @if (!empty($features))
            @include('home.fitur')
        @endif
      </div>
    </section>
  </div>
@endsection
