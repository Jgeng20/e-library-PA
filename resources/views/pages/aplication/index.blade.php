@extends('layouts.app')

@section('page-header')
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Aplication Aplication</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active"><i class="fas fa-calendar mr-1"></i>Aplication Aplication
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
                        <h3 class="card-title">Pengaturan Aplikasi</h3>
                    </div>

                    <!-- form start -->
                    <form action="#" method="POST">
                        <div class="card-body">
                            <div class="collum">
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Nama Aplikasi</label>
                                        <h1>{{ $aplication->app_title }}</h1>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group collum">
                                        <label>Logo Aplikasi</label>
                                        <div class="col-md-4">
                                            <img src="{{ $aplication->app_logo ? asset('storage/' . $aplication->app_logo) : asset('https://placehold.co/400x600') }}" 
                                                 alt="{{ $aplication->app_title }}" class="img-fluid img-thumbnail">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Deskripsi Aplikasi</label>
                                        <p>{{ $aplication->app_description }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Email Aplikasi Resmi</label>
                                        <p>Email: {{ $aplication->app_email }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Nomor Resmi Aplikasi</label>
                                        <p>{{ $aplication->app_phone }}</p>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <label>Sosial Media</label>
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th>Twitter</th>
                                                    <th>Facebook</th>
                                                    <th>Instagram</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td><a href="{{ $aplication->twitter_link }}">{{ $aplication->twitter_link }}</a></td>
                                                    <td><a href="{{ $aplication->facebook_link }}">{{ $aplication->facebook_link }}</a></td>
                                                    <td><a href="{{ $aplication->instagram_link }}">{{ $aplication->instagram_link }}</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="col-12 col-lg-6 mb-5">
                                    <div class="form-group">
                                        <button type="button" class="btn btn-secondary btn-sm">
                                            <a class="dropdown-item font-weight-bold" href="{{ route('aplication.edit', ['aplication' => $aplication->id]) }}">Edit Aplikasi</a>
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
