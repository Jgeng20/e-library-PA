<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $month = $request->input('month', 'year'); // Default ke 'year' jika tidak ada yang dipilih
        $year = Carbon::now()->year; // Menggunakan tahun sekarang secara default

        // Filter data berdasarkan bulan yang dipilih atau seluruh tahun
        if ($month === 'year') {
            // Jika 'Tahun Ini' dipilih, ambil semua data di tahun tersebut
            $borrowings = Borrowing::whereYear('borrow_date', $year)->get();
            $books = Book::whereYear('created_at', $year)->get();
            $members = Member::whereYear('created_at', $year)->get();
        } else {
            // Jika bulan dipilih, filter data berdasarkan bulan tersebut
            $borrowings = Borrowing::whereYear('borrow_date', $year)
                ->whereMonth('borrow_date', $month)
                ->get();
            $books = Book::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();
            $members = Member::whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->get();
        }

        // Menghitung jumlah buku yang sedang dipinjam
        $rentedBooks = $borrowings->whereNull('return_date')->count();

        // Menghitung jumlah buku yang terlambat dikembalikan
        $overdueBooks = $borrowings->where('return_date', '<', Carbon::now())->count();

        // Menghitung jumlah buku yang dikembalikan tepat waktu
        $onTimeReturns = $borrowings->filter(function ($borrowing) {
            $borrowDate = Carbon::parse($borrowing->borrow_date);
            $dueDate = $borrowDate->copy()->addDays(7);
            return $borrowing->return_date && Carbon::parse($borrowing->return_date)->lte($dueDate);
        })->count();

        if ($month !== 'year') {
            $previousMonth = Carbon::createFromDate($year, $month)->subMonth();
            $previousMonthBorrowings = Borrowing::whereYear('borrow_date', $previousMonth->year)
                ->whereMonth('borrow_date', $previousMonth->month)
                ->get();
            $previousMonthRentedBooks = $previousMonthBorrowings->whereNull('return_date')->count();
            $previousMonthOverdueBooks = $previousMonthBorrowings->where('return_date', '<', Carbon::now())->count();
            $previousMonthOnTimeReturns = $previousMonthBorrowings->filter(function ($borrowing) {
                $borrowDate = Carbon::parse($borrowing->borrow_date);
                $dueDate = $borrowDate->copy()->addDays(7);
                return $borrowing->return_date && Carbon::parse($borrowing->return_date)->lte($dueDate);
            })->count();

            $percentageChangeRented = $previousMonthRentedBooks > 0
                ? (($rentedBooks - $previousMonthRentedBooks) / $previousMonthRentedBooks) * 100
                : null;

            $percentageChangeOverdue = $previousMonthOverdueBooks > 0
                ? (($overdueBooks - $previousMonthOverdueBooks) / $previousMonthOverdueBooks) * 100
                : null;

            $percentageChangeOnTimeReturns = $previousMonthOnTimeReturns > 0
                ? (($onTimeReturns - $previousMonthOnTimeReturns) / $previousMonthOnTimeReturns) * 100
                : null;

            $previousMonthBooks = Book::whereYear('created_at', $previousMonth->year)
                ->whereMonth('created_at', $previousMonth->month)
                ->count();
            $previousMonthMembers = Member::whereYear('created_at', $previousMonth->year)
                ->whereMonth('created_at', $previousMonth->month)
                ->count();

            $totalBooks = Book::whereYear('created_at', '<=', $year)
                ->whereMonth('created_at', '<=', $month)
                ->count();
            $totalMembers = Member::whereYear('created_at', '<=', $year)
                ->whereMonth('created_at', '<=', $month)
                ->count();

            $percentageChangeTotalBooks = $previousMonthBooks > 0
                ? (($totalBooks - $previousMonthBooks) / $previousMonthBooks) * 100
                : null;

            $percentageChangeTotalMembers = $previousMonthMembers > 0
                ? (($totalMembers - $previousMonthMembers) / $previousMonthMembers) * 100
                : null;
        } else {
            $totalBooks = Book::count('stock'); // Menghitung semua buku di database
            $totalMembers = Member::count(); // Menghitung semua anggota di database

            $percentageChangeRented = null;
            $percentageChangeOverdue = null;
            $percentageChangeOnTimeReturns = null;
            $percentageChangeTotalBooks = null;
            $percentageChangeTotalMembers = null;
        }

        // Return data to view or as JSON
        return view('pages.dashboard.index', compact(
            'totalBooks',
            'totalMembers',
            'rentedBooks',
            'overdueBooks',
            'onTimeReturns',
            'percentageChangeRented',
            'percentageChangeOverdue',
            'percentageChangeOnTimeReturns',
            'percentageChangeTotalBooks',
            'percentageChangeTotalMembers'
        ));
    }


    public function getBooksByMonthData(Request $request)
    {
        // Get all borrowings for the year 2024 and process them in PHP
        $borrowings = Borrowing::whereYear('borrow_date', 2024)->get()->groupBy(function ($date) {
            return Carbon::parse($date->borrow_date)->format('m'); // Group by months
        });

        $borrowingsCount = [];
        $borrowMonths = [];
        foreach ($borrowings as $key => $value) {
            $borrowingsCount[(int)$key] = count($value); // Count the number of borrowings for each month
            $borrowMonths[(int)$key] = Carbon::create()->month($key)->locale('id')->isoFormat('MMM'); // Get the month name in Indonesian
        }

        ksort($borrowingsCount);
        ksort($borrowMonths);

        return response()->json([
            'borrowings' => array_values($borrowingsCount),
            'months' => array_values($borrowMonths),
        ]);
    }
    public function getBooksByCategory()
    {
        $categories = Category::withCount('books')->get();
        $data = $categories->map(function ($category) {
            return [
                'name' => $category->name,
                'y' => $category->books_count
            ];
        });

        return response()->json($data);
    }

    public function getBooksStatusData()
    {
        // Menghitung jumlah buku yang tersedia
        $totalBooks = Book::sum('stock');

        // Menghitung jumlah buku yang sedang disewa
        $rentedBooks = Borrowing::whereNull('return_date')->count();

        // Menghitung jumlah buku yang belum kembali
        $overdueBooks = Borrowing::where('return_date', '<', Carbon::now())->count();

        // Menghitung jumlah buku yang tersedia (total buku - buku yang disewa)
        $availableBooks = max(0, $totalBooks - $rentedBooks);

        return response()->json([
            'availableBooks' => $availableBooks,
            'rentedBooks' => $rentedBooks,
            'overdueBooks' => $overdueBooks,
        ]);

        /* Logika Yang Seharusnya Terjadi seperti dibawah, namun akibat seeder terlalu berlebihan dimana jumlah buku yang disewa dan 
        belum di kembalikanmelebihi stok buku, sehingga akhirnya terjadi bug. Next time seedernya mohon dibuat tidak terlalu brutal seperti 
        sekarang ada hampir 1000 seeder (dummy data) yang bahkan hanya mencakup 2 kategori saja dan membuat beberapa logika tidak berjalan

        // Menghitung total stok buku
        $totalBooks = Book::sum('stock');

        // Menghitung jumlah buku yang sedang disewa
        $rentedBooks = Borrowing::whereNull('return_date')->count();

        // Menghitung jumlah buku yang belum dikembalikan dan sudah terlambat
        $overdueBooks = Borrowing::whereNull('returned_at')
                                ->where('return_date', '<', Carbon::now())
                                ->count();

        // Menghitung jumlah buku yang tersedia (stok total - buku yang disewa)
        $availableBooks = $totalBooks - $rentedBooks;

        // Mengurangi buku yang terlambat dari buku yang disewa untuk mendapatkan buku yang disewa dan tidak terlambat
        $rentedBooks = $rentedBooks - $overdueBooks;

        return response()->json([
            'availableBooks' => $availableBooks,
            'rentedBooks' => $rentedBooks,
            'overdueBooks' => $overdueBooks,
        ]);

         */
    }

    public function getBooksAmountData(Request $request)
    {
        $year = Carbon::now()->year;
        $monthlyData = [];

        $months = [];
        $totalRevenues = [];
        $totalRentalFees = [];
        $totalFines = [];

        for ($month = 1; $month <= 12; $month++) {
            $borrowings = Borrowing::whereYear('borrow_date', $year)
                ->whereMonth('borrow_date', $month)
                ->get();

            $months[] = Carbon::create()->month($month)->format('F');
            $totalRevenues[] = $borrowings->sum('total_amount');
            $totalRentalFees[] = $borrowings->sum('rental_fee');
            $totalFines[] = $borrowings->sum('fine_amount');
        }

        return response()->json([
            'months' => $months,
            'totalRevenue' => $totalRevenues,
            'totalRentalFees' => $totalRentalFees,
            'totalFines' => $totalFines,
        ]);
    }

    public function getTopBorrowedBooks()
    {
        $topBooks = Borrowing::select('book_id', DB::raw('count(*) as total'))
            ->groupBy('book_id')
            ->orderBy('total', 'desc')
            ->with('book')
            ->take(10) // Ambil 10 buku teratas
            ->get();

        $books = $topBooks->map(function ($borrowing) {
            return [
                'title' => $borrowing->book->title,
                'total' => $borrowing->total
            ];
        });

        return response()->json($books);
    }
}
