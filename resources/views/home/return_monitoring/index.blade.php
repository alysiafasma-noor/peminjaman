@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Memantau Pengembalian</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pengembalian</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card card-outline card-warning shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h3 class="card-title font-weight-bold text-warning">Status Pengembalian Alat</h3>
                </div>
                <div class="card-body p-3">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0 align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Nama User</th>
                                    <th>Alat</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Tanggal Kembali</th>
                                    <th>Status</th>
                                    <th>Pesan</th>
                                    <th style="min-width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentUser = auth()->user();
                                    $canProcessReturn = $currentUser && ($currentUser->isAdmin() || $currentUser->isPetugas());
                                @endphp
                                @forelse ($peminjaman as $item)
                                    @php
                                        $status = strtolower((string) ($item->status ?? 'menunggu'));
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->user?->name ?? '-' }}</td>
                                        <td>{{ $item->alat?->nama_alat ?? '-' }}</td>
                                        <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                                        <td>{{ $item->tanggal_dipinjam }}</td>
                                        <td>{{ $item->tanggal_dikembalikan ?? '-' }}</td>
                                        <td>
                                            @if (in_array($status, ['disetujui', 'sedang_dipinjam']))
                                                <span class="badge badge-success px-2 py-2">Sedang Dipinjam</span>
                                            @elseif ($status === 'sudah_dikembalikan')
                                                <span class="badge badge-secondary px-2 py-2">Sudah Dikembalikan</span>
                                            @elseif ($status === 'ditolak')
                                                <span class="badge badge-danger px-2 py-2">Ditolak</span>
                                            @else
                                                <span class="badge badge-warning text-dark px-2 py-2">Menunggu</span>
                                            @endif
                                        </td>
                                        <td class="text-wrap">{{ $item->pesan ?? '-' }}</td>
                                        <td>
                                            @if ($canProcessReturn && in_array($status, ['disetujui', 'sedang_dipinjam']) && empty($item->tanggal_dikembalikan))
                                                <form action="{{ route('return-monitoring.kembali', $item->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm btn-block" onclick="return confirm('Apakah barang ini sudah kembali?')">
                                                        <i class="fas fa-check mr-1"></i>Barang Kembali
                                                    </button>
                                                </form>
                                            @elseif ($status === 'sudah_dikembalikan')
                                                <span class="text-muted font-weight-bold">Selesai</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center text-muted py-4">Belum ada data pengembalian.</td>
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
