@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Tambah Peminjaman</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Form Peminjaman</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('peminjaman.store') }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">User</label>
                                    <select name="id_user" class="form-control" required>
                                        <option value="">Pilih User</option>
                                        @foreach ($user as $u)
                                            <option value="{{ $u->id }}">{{ $u->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_user')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Alat</label>
                                    <select name="id_alat" class="form-control" required>
                                        <option value="">Pilih Alat</option>
                                        @foreach ($alat as $a)
                                            <option value="{{ $a->id }}">{{ $a->nama_alat }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_alat')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Peminjaman</label>
                                    <input type="date" name="tanggal_dipinjam" class="form-control" value="{{ old('tanggal_dipinjam') }}" required>
                                    @error('tanggal_dipinjam')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pengembalian</label>
                                    <input type="date" name="tanggal_dikembalikan" class="form-control" value="{{ old('tanggal_dikembalikan') }}">
                                    @error('tanggal_dikembalikan')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Submit
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
