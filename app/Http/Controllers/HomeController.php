<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        // Menghitung jumlah total buku
        $totalBooks = Book::count();

        // Menghitung persentase perubahan total buku (contoh logika)
        $previousTotalBooks = Book::where('created_at', '<', Carbon::now()->subMonth())->count();
        $percentageChangeTotalBooks = $previousTotalBooks > 0 ? (($totalBooks - $previousTotalBooks) / $previousTotalBooks) * 100 : 0;

        // Menghitung jumlah total anggota
        $totalMembers = Member::count();

        // Menghitung persentase perubahan total anggota (contoh logika)
        $previousTotalMembers = Member::where('created_at', '<', Carbon::now()->subMonth())->count();
        $percentageChangeTotalMembers = $previousTotalMembers > 0 ? (($totalMembers - $previousTotalMembers) / $previousTotalMembers) * 100 : 0;

        return view('pages.home', compact('totalBooks', 'percentageChangeTotalBooks', 'totalMembers', 'percentageChangeTotalMembers'));
    }
}