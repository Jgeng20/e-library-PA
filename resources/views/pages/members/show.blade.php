@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ $member->full_name }}</h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ $member->member_image ? asset('storage/' . $member->member_image) : asset('https://placehold.co/400x600') }}"
                                    alt="{{ $member->full_name }}" class="img-fluid img-thumbnail">
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="full_name">Pengguna</label>
                                    <p>{{ $member->full_name }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <p>{{ $member->address }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="phone">Telepon</label>
                                    <p>{{ $member->phone }}</p>
                                </div>

                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <p>{{ $member->email }}</p>
                                </div>
                            </div>
                        </div>
                        
                        <a href="{{ route('members.index') }}" class="btn btn-primary mt-3"><i class="fas fa-arrow-left mr-1"></i> Kembali ke Daftar Anggota</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
