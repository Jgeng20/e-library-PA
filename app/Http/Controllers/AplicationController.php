<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AplicationSetting;
use App\Http\Requests\UpdateAplicationSettingRequest;

class AplicationController extends Controller
{
    public function index()
    {
        $aplication = AplicationSetting::first();

        return view('pages.aplication.index', compact('aplication'));
    }

    public function home()
    {
        $aplication = AplicationSetting::first();

        return view('pages.home', compact('aplication'));
    }

    public function edit(AplicationSetting $aplication)
    {
        if (!$aplication) {
            return redirect()->route('aplication.index')->with('error', 'Pengaturan aplikasi tidak ditemukan.');
        }

        return view('pages.aplication.edit', compact('aplication'));
    }

    public function update(UpdateAplicationSettingRequest $request, AplicationSetting $aplication)
    {
        $validatedData = $request->validated();

        if ($request->hasFile('app_logo')) {
            $path = $request->file('app_logo')->store('logos', 'public');
            $validatedData['app_logo'] = $path;
        }

        $aplication->update($validatedData);

        return redirect()->route('aplication.index')->with('success', 'Pengaturan aplikasi berhasil diperbarui.');
    }
}
