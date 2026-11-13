@extends('layouts.master')
@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Ajukan Peminjaman</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Ajukan Peminjaman</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-success">
                <div class="card-header">
                    <h3 class="card-title"><i class="fas fa-hand-holding mr-2"></i>Form Pengajuan Peminjaman</h3>
                </div>
                <div class="card-body">
                    <form action="{{ route('peminjaman.submit') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Alat</label>
                                <select name="id_alat" class="form-control" required>
                                    <option value="">Pilih alat</option>
                                    @foreach ($alat as $a)
                                        <option value="{{ $a->id }}">{{ $a->nama_alat }} (Stok: {{ $a->stok }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Tanggal Peminjaman</label>
                                <input type="date" name="tanggal_dipinjam" class="form-control" value="{{ old('tanggal_dipinjam') }}" required>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Jumlah yang Dipinjam</label>
                                <input type="number" name="jumlah_pinjam" class="form-control" min="1" value="{{ old('jumlah_pinjam', 1) }}" required>
                            </div>

                            <div class="col-md-12 mb-3">
                                <label class="form-label">Alasan Peminjaman</label>
                                <textarea name="alasan_peminjaman" class="form-control" rows="4" placeholder="Tuliskan alasan peminjaman" required>{{ old('alasan_peminjaman') }}</textarea>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Kirim Pengajuan</button>
                            <a href="{{ route('dashboard') }}" class="btn btn-warning">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
