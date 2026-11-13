@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Persetujuan Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Persetujuan</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success shadow-sm border-0">
                <div class="card-header bg-white border-bottom">
                    <h3 class="card-title font-weight-bold text-success">Daftar Pengajuan Peminjaman</h3>
                </div>
                <div class="card-body p-3">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover mb-0 align-middle">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 40px;">#</th>
                                    <th>Nama User</th>
                                    <th>Alat</th>
                                    <th>Kategori</th>
                                    <th>Tanggal Pinjam</th>
                                    <th>Jumlah</th>
                                    <th style="min-width: 180px;">Alasan</th>
                                    <th>Status</th>
                                    <th style="min-width: 180px;">Pesan</th>
                                    <th style="min-width: 180px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $currentUser = auth()->user();
                                    $canManageApproval = $currentUser && ($currentUser->isAdmin() || $currentUser->isPetugas());
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
                                        <td>{{ $item->jumlah_pinjam ?? 1 }}</td>
                                        <td class="text-wrap">{{ $item->alasan_peminjaman ?? '-' }}</td>
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
                                            @if ($canManageApproval && $status === 'menunggu')
                                                <div class="d-flex flex-column gap-2">
                                                    <form action="{{ route('approval.approve', $item->id) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-success btn-sm btn-block" onclick="return confirm('Setujui peminjaman ini?')">
                                                            <i class="fas fa-check mr-1"></i>Setujui
                                                        </button>
                                                    </form>

                                                    <button type="button" class="btn btn-danger btn-sm btn-block" data-toggle="collapse" data-target="#reject-form-{{ $item->id }}">
                                                        <i class="fas fa-times mr-1"></i>Tolak
                                                    </button>

                                                    <div id="reject-form-{{ $item->id }}" class="collapse mt-1">
                                                        <form action="{{ route('approval.reject', $item->id) }}" method="POST">
                                                            @csrf
                                                            <div class="input-group input-group-sm">
                                                                <input type="text" name="pesan" class="form-control" placeholder="Alasan ditolak" required>
                                                                <div class="input-group-append">
                                                                    <button type="submit" class="btn btn-danger">Kirim</button>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-muted py-4">Belum ada pengajuan peminjaman.</td>
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
