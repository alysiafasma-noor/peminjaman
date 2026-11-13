@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kembalikan Barang Saya</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Kembalikan Barang</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title">Daftar Peminjaman Saya</h3>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Alat</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Pesan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($peminjaman as $item)
                                    @php
                                        $status = strtolower((string) ($item->status ?? 'menunggu'));
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->alat?->nama_alat ?? '-' }}</td>
                                        <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                                        <td>{{ $item->tanggal_dipinjam }}</td>
                                        <td>{{ $item->tanggal_dikembalikan ?? '-' }}</td>
                                        <td>
                                            @if (in_array($status, ['disetujui', 'sedang_dipinjam']))
                                                <span class="badge badge-success">Sedang Dipinjam</span>
                                            @elseif ($status === 'sudah_dikembalikan')
                                                <span class="badge badge-secondary">Sudah Dikembalikan</span>
                                            @elseif ($status === 'ditolak')
                                                <span class="badge badge-danger">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning text-dark">Menunggu</span>
                                            @endif
                                        </td>
                                        <td>{{ $item->pesan ?? '-' }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center text-muted py-4">Belum ada data peminjaman yang Anda miliki.</td>
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
