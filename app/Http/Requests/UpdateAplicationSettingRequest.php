<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAplicationSettingRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'app_title' => 'required|string|max:255',
            'app_logo' => 'nullable|image|mimes:png|max:2048',
            'app_description' => 'required|string',
            'app_email' => 'required|email',
            'app_phone' => 'required|string|max:15',
            'instagram_link' => 'nullable|string|max:255',
            'facebook_link' => 'nullable|string|max:255',
            'twitter_link' => 'nullable|string|max:255',
        ];
    }

    public function message()
    {
        return [
            'app_title' => 'Nama Aplikasi Tidak Boleh Kosong',
            'app_logo.file' => 'Gambar Aplikasi harus berupa berkas.',
            'app_logo.mimes' => 'Gambar Aplikasi harus berformat PNG.',
            'app_logo.max' => 'Gambar Aplikasi tidak boleh lebih dari 2MB.',
            'app_description' => 'Deskripsi Aplikasi Perlu Diisi',
            'app_email' => 'Aplikasi Memerlukan Email Resmi',
            'app_phone' => 'Aplikasi Memerlukan Nomer Telepon Resmi',
            'instagram_link' => 'Isi Dengan Link Akun Sosial Media Instagram',
            'facebook_link' => 'Isi Dengan Sosial Media Facebook',
            'twitter_link' => 'Isi Dengan Sosial Media Twitter',
        ];
    }
}