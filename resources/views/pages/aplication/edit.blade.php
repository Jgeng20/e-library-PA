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
                                            class="fas fa-laptop mr-1"></i>Aplikasi</a></li>
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
                        <h3 class="card-title">Edit Pengaturan Aplikasi</h3>
                    </div>
                    <form action="{{ route('aplication.update', ['aplication' => $aplication->id]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-body">
                            <div class="form-group">
                                <label for="app_title">Nama Aplikasi</label>
                                <input type="text" name="app_title" class="form-control" id="app_title"
                                    value="{{ old('app_title', $aplication->app_title) }}" required>
                                @if ($errors->has('app_title'))
                                    <div class="text-danger">
                                        {{ $errors->first('app_title') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="app_description">Deskripsi Aplikasi</label>
                                <textarea name="app_description" class="form-control" id="app_description" required>{{ old('app_description', $aplication->app_description) }}</textarea>
                                @if ($errors->has('app_description'))
                                    <div class="text-danger">
                                        {{ $errors->first('app_description') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="app_email">Email Aplikasi Resmi</label>
                                <input type="email" name="app_email" class="form-control" id="app_email"
                                    value="{{ old('app_email', $aplication->app_email) }}" required>
                                @if ($errors->has('app_email'))
                                    <div class="text-danger">
                                        {{ $errors->first('app_email') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="app_phone">Nomor Resmi Aplikasi</label>
                                <input type="text" name="app_phone" class="form-control" id="app_phone"
                                    value="{{ old('app_phone', $aplication->app_phone) }}" required>
                                @if ($errors->has('app_phone'))
                                    <div class="text-danger">
                                        {{ $errors->first('app_phone') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="app_phone">Instagram Aplikasi</label>
                                <input type="url" name="instagram_link" class="form-control" id="instagram_link" value="{{ old('instagram_link', $aplication->instagram_link) }}" required>
                                @if ($errors->has('instagram_link'))
                                    <div class="text-danger">
                                        {{ $errors->first('instagram_link') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="facebook_link">Facebook Aplikasi</label>
                                <input type="url" name="facebook_link" class="form-control" id="facebook_link" value="{{ old('facebook_link', $aplication->facebook_link) }}" required>
                                @if ($errors->has('facebook_link'))
                                    <div class="text-danger">
                                        {{ $errors->first('facebook_link') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="twitter_link">Twitter Aplikasi</label>
                                <input type="url" name="twitter_link" class="form-control" id="twitter_link" value="{{ old('twitter_link', $aplication->twitter_link) }}" required>
                                @if ($errors->has('twitter_link'))
                                    <div class="text-danger">
                                        {{ $errors->first('twitter_link') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="coverImage">Logo Aplikasi</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="app_logo" name="app_logo" accept=".png">
                                    <label class="custom-file-label" for="app_logo">Pilih gambar PNG</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text" id="uploadButton">Unggah</span>
                                </div>
                            </div>
                            @if($errors->has('app_logo'))
                                <div class="text-danger">
                                    {{ $errors->first('app_logo') }}
                                </div>
                            @endif
                            <button type="button" class="btn btn-danger mt-2 d-none" id="cancelUploadButton"><i class="fas fa-trash-alt"></i> Batalkan Pilihan</button>
                        </div>

                        <div class="row" id="previewContainer">
                            <div class="col-3">
                                <label for="app_logo">Pratinjau Logo</label>
                                <img id="logoPreview" src="{{ $aplication->app_logo ? asset('storage/' . $aplication->app_logo) : asset('https://placehold.co/400x600') }}" alt="Image Preview" class="img-fluid"/>
                            </div>
                            <div class="col-9">
                                <ul id="logoMetadata" class="list-unstyled mt-4">
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
            var fileName = document.getElementById("app_logo").files[0].name;
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });

        // Display image preview
        document.getElementById('app_logo').addEventListener('change', function(e) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('logoPreview').src = e.target.result;
            }
            reader.readAsDataURL(this.files[0]);
        });
    });
</script>
@endsection
