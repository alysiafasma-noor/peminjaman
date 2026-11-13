@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Alat</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>Form Edit Alat</h3>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('alat.update', $alat->id) }}" method="post">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Nama Alat</label>
                                    <input type="text" name="nama_alat" class="form-control" value="{{ old('nama_alat', $alat->nama_alat) }}" required>
                                    @error('nama_alat')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Kategori</label>
                                    <select name="id_kategori" class="form-control" required>
                                        @foreach ($kategori as $k)
                                            <option value="{{ $k->id }}" {{ $k->id == $alat->id_kategori ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_kategori')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Stok</label>
                                    <input type="number" name="stok" class="form-control" min="0" value="{{ old('stok', $alat->stok) }}" required>
                                    @error('stok')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Update
                                </button>
                                <a href="{{ route('alat.index') }}" class="btn btn-warning">
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
