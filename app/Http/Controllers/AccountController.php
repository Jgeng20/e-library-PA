<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Requests\UpdateUserRequest;

class AccountController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('pages.account.index', compact('user'));
    }

    public function home()
    {
        $user = Auth::user();
        return view('pages.home', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.account.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, User $account)
    {
        // $account sudah terisi dengan instance User berdasarkan ID
        $validatedData = $request->validated();

        if ($request->hasFile('profile_foto')) {
            $path = $request->file('profile_foto')->store('profile_photos', 'public');
            $validatedData['profile_foto'] = $path;
        }

        $account->update($validatedData);

        return redirect()->route('account.index')->with('success', 'Akun berhasil diperbarui.');
    }
}
