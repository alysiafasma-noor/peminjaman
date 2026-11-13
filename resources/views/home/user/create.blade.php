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
                            <h3>Table User
                            </h3>

                        </div>
                        <div class="card-boady">
                            <form action="{{ route('user.store') }}" method="post">
                                @csrf
                                <div class="mb-3">
                                    <label for="" class="form-label">Name</label>
                                    <input type="text" class="form-control" name="name" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('name') }}" />
                                </div>
                                    @error('name')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror

                                <div class="mb-3">
                                    <label for="" class="form-label">Email</label>
                                    <input type="text" class="form-control" name="email" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('email') }}" />
                                </div>
                                    @error('email')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror

                                <div class="mb-3">
                                    <label for="" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="" aria-describedby="helpId" placeholder=""
                                     />
                                </div>
                                    @error('password')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror

                                <div class="mb-3">
                                    <label for="" class="form-label">Role</label>
                                    <input type="text" class="form-control" name="role" id="" aria-describedby="helpId" placeholder=""
                                        value="{{ old('role') }}" />
                                </div>
                                    @error('role')
                                        <div class="alert alert-danger mt-2">{{ $message }}</div>
                                    @enderror

                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save mr-1"></i>Submit
                                </button>
                                <a class="btn btn-warning" href="{{ route('user.index') }}">
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
