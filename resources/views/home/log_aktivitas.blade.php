@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Log Aktivitas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Log Aktivitas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-primary">
                <div class="card-header d-flex align-items-center" style="gap: 12px;">
                    <h3 class="card-title mb-0">
                        <i class="fas fa-history mr-2"></i>Riwayat Aktivitas Peminjaman
                    </h3>
                    <a href="{{ route('laporan') }}" class="btn btn-success btn-sm">
                        <i class="fas fa-print mr-1"></i>Cetak Laporan
                    </a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered mb-0">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Nama User</th>
                                    <th>Nama Alat</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Waktu</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($logs as $log)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $log['nama_user'] }}</td>
                                        <td>{{ $log['nama_alat'] }}</td>
                                        <td>{{ $log['kategori'] }}</td>
                                        <td>{{ $log['tanggal_dipinjam'] }}</td>
                                        <td>{{ $log['tanggal_dikembalikan'] ?: '-' }}</td>
                                        <td>
                                            @if ($log['status'] === 'Selesai')
                                                <span class="badge badge-success">{{ $log['status'] }}</span>
                                            @else
                                                <span class="badge badge-warning text-dark">{{ $log['status'] }}</span>
                                            @endif
                                        </td>
                                        <td>{{ $log['waktu'] }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center py-4 text-muted">
                                            Belum ada data aktivitas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
