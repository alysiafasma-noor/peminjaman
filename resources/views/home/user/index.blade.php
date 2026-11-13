@extends('layouts.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            @if (session('success'))
                            <div class="alert alert-info">
                                {{ session('success') }}
                            </div>

                            @endif
                            <h3>Table User
                                <a href="{{ route('user.create') }}" class="btn btn-primary">
                                    <i class="fas fa-plus mr-1"></i>Tambah
                                </a>
                            </h3>

                        </div>
                        <div class="card-boady">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>role</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $u)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $u->name }}</td>
                                            <td>{{ $u->email }}</td>
                                            <td>{{ $u->role }}</td>
                                            <td>
                                                <a href="{{ route('user.edit', $u->id) }}" class="btn btn-warning">
                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                </a>
                                                <a href="{{ route('user.destroy', $u->id) }}" class="btn btn-danger" onclick="return confirm('Yakin ingin hapus?')">
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
