@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center" style="gap: 12px;">
                            <h3 class="mb-0">Table Peminjaman</h3>
                            <a href="{{ route('peminjaman.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus mr-1"></i>Tambah
                            </a>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                                <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama User</th>
                                        <th>Alat</th>
                                        <th>Kategori</th>
                                        <th>Tgl Pinjam</th>
                                        <th>Jumlah</th>
                                        <th>Status</th>
                                        <th>Pesan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($peminjaman as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->user?->name ?? '-' }}</td>
                                            <td>{{ $item->alat?->nama_alat ?? '-' }}</td>
                                            <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                                            <td>{{ $item->tanggal_dipinjam }}</td>
                                            <td>{{ $item->jumlah_pinjam ?? 1 }}</td>
                                            <td>
                                                @if (in_array($item->status, ['disetujui', 'sedang_dipinjam']))
                                                    <span class="badge badge-success">Sedang Dipinjam</span>
                                                @elseif ($item->status === 'sudah_dikembalikan')
                                                    <span class="badge badge-secondary">Sudah Dikembalikan</span>
                                                @elseif ($item->status === 'ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @else
                                                    <span class="badge badge-warning text-dark">Menunggu</span>
                                                @endif
                                            </td>
                                            <td>{{ $item->pesan ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('peminjaman.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                                <a href="{{ route('peminjaman.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
                                                    <i class="fas fa-trash mr-1"></i>Hapus
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
