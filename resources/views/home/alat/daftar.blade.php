@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Daftar Alat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Daftar Alat</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-list mr-2"></i>List Barang yang Tersedia</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        @forelse ($alat as $item)
                            <div class="col-md-4 col-sm-6 mb-3">
                                <div class="card h-100 shadow-sm">
                                    <div class="card-body">
                                        <span class="badge badge-info mb-2">{{ $item->kategori?->nama_kategori ?? '-' }}</span>
                                        <h5 class="card-title mb-2">{{ $item->nama_alat }}</h5>
                                        <p class="mb-1"><strong>Stok:</strong> {{ $item->stok }}</p>
                                        <p class="mb-0 text-muted">Tersedia untuk dipinjam sesuai kebutuhan.</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-warning mb-0">Belum ada data alat.</div>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
