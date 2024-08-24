@extends('layouts.app')

@section('page-header')
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Account</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><i class="fas fa-calendar mr-1"></i>Account
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card">
                    <!-- /.card-header -->
                    <div class="card-header">
                        <h3 class="card-title">Pengaturan Akun</h3>
                    </div>

                    <!-- form start -->
                    <form action="#" method="POST">
                        <div class="card-body">
                            <div class="collum">
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Nama Akun</label>
                                        <h1>{{ $user->name }}</h1>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group collum">
                                        <label>Foto Profil</label>
                                        <div class="col-md-4">
                                            <img src="{{ $user->profile_foto ? asset('storage/' . $user->profile_foto) : asset('https://placehold.co/400x600') }}" 
                                                 alt="{{ $user->profile_foto }}" class="img-fluid img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Alamat User</label>
                                        <p>{{ $user->address }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Email User</label>
                                        <p>Email: {{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Nomor User</label>
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Pekerjaan</label>
                                        <p>{{ $user->phone }}</p>
                                    </div>
                                </div>
                            
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary btn-sm">
                                            <a class="dropdown-item font-weight-bold" href="{{ route('account.edit', ['account' => $user->id]) }}">Edit Aplikasi</a>
                                        </button>      
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
