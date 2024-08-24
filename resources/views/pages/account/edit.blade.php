@extends('layouts.app')

@section('page-header')
    <div class="row">
        <div class="col-12 col-lg-8 offset-lg-2">
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Edit Buku</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="{{ route('aplication.index') }}"><i
                                            class="fas fa-laptop mr-1"></i>Akun</a></li>
                                <li class="breadcrumb-item active">Edit</li>
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
                    <div class="card-header">
                        <h3 class="card-title">Edit Akun</h3>
                    </div>
                    <form action="{{ route('account.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name">Nama Akun</label>
                                <input type="text" name="name" class="form-control" id="name"
                                    value="{{ old('name', $user->name) }}" required>
                                @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{ $errors->first('name') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="address">Alamat User</label>
                                <input type="text" name="address" class="form-control" id="address"
                                    value="{{ old('address', $user->address) }}" required>
                                @if ($errors->has('address'))
                                    <div class="text-danger">
                                        {{ $errors->first('address') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="email">Email User</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    value="{{ old('email', $user->email) }}" required>
                                @if ($errors->has('email'))
                                    <div class="text-danger">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="phone">Nomor User</label>
                                <input type="text" name="phone" class="form-control" id="phone"
                                    value="{{ old('phone', $user->phone) }}" required>
                                @if ($errors->has('phone'))
                                    <div class="text-danger">
                                        {{ $errors->first('phone') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coverImage">Foto Profil</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="profile_foto" name="profile_foto" accept=".png, .jpg">
                                    <label class="custom-file-label" for="profile_foto">Pilih gambar PNG / JPG</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="uploadButton">Unggah</span>
                                </div>
                            </div>
                            @if($errors->has('profile_foto'))
                                <div class="text-danger">
                                    {{ $errors->first('profile_foto') }}
                                </div>
                            @endif
                            <button type="button" class="btn btn-danger mt-2 d-none" id="cancelUploadButton"><i class="fas fa-trash-alt"></i> Batalkan Pilihan</button>
                        </div>

                        <div class="row" id="previewContainer">
                            <div class="col-3">
                                <label for="profile_foto">Pratinjau Logo</label>
                                <img id="fotoPreview" src="{{ $user->profile_foto ? asset('storage/' . $user->profile_foto) : asset('https://placehold.co/400x600') }}" alt="Image Preview" class="img-fluid"/>
                            </div>
                            <div class="col-9">
                                <ul id="fotoMetadata" class="list-unstyled mt-4">
                                    <li><span id="fileName"></span></li>
                                    <li><span id="fileSize"></span></li>
                                    <li><span id="fileType"></span></li>
                                </ul>
                                <div class="text-danger d-none" id="fileError">File terlalu besar, maksimal ukuran 2 MB.</div>
                                <div class="text-danger d-none" id="fileError2">File melebihi ukuran 2 MB, tidak dapat diunggah.</div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Update label with selected file name
        document.querySelector('.custom-file-input').addEventListener('change', function(e) {
            var fileName = document.getElementById("profile_foto").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });

        // Display image preview
        document.getElementById('profile_foto').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('fotoPreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection
