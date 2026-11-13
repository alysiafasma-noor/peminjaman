@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Data Alat</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header d-flex align-items-center" style="gap: 12px;">
                            <h3 class="mb-0">Table Alat</h3>
                            <a href="{{ route('alat.create') }}" class="btn btn-primary">
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
                                        <th>Nama Alat</th>
                                        <th>Kategori</th>
                                        <th>Stok</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($alat as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_alat }}</td>
                                            <td>{{ $item->kategori?->nama_kategori ?? '-' }}</td>
                                            <td>{{ $item->stok }}</td>
                                            <td>
                                                <a href="{{ route('alat.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                                <a href="{{ route('alat.destroy', $item->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus?')">
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
