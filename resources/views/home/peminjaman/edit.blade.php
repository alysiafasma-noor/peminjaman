@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Form Edit Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('peminjaman.update', $peminjaman->id) }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <select name="id_user" class="form-control" required>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}" {{ $u->id == $peminjaman->id_user ? 'selected' : '' }}>{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}" {{ $k->id == $peminjaman->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alat</label>
                                    <select name="id_alat" class="form-control" required>
                                        @foreach ($alat as $a)
                                            <option value="{{ $a->id }}" {{ $a->id == $peminjaman->id_alat ? 'selected' : '' }}>{{ $a->nama_alat }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Peminjaman</label>
                                    <input type="date" name="tanggal_dipinjam" class="form-control" value="{{ old('tanggal_dipinjam', $peminjaman->tanggal_dipinjam) }}" required>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ old('tanggal_dikembalikan', $peminjaman->tanggal_dikembalikan) }}">
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Update
                                </button>
                                <a href="{{ route('peminjaman.index') }}" class="btn btn-warning">
                                    <i class="fas fa-arrow-left mr-1"></i>Kembali
                                </a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
