<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Borrowing;
use App\Models\Book;
use App\Models\Member;
use Carbon\Carbon;

class Dashboard extends Model
{
    public static function getDashboardData($month = 'year')
    {
        $year = Carbon::now()->year;

        if ($month === 'year') {
            $borrowings = Borrowing::whereYear('borrow_date', $year)->get();
            $books = Book::whereYear('created_at', $year)->get();
            $members = Member::whereYear('created_at', $year)->get();
        } else {
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

        $rentedBooks = $borrowings->whereNull('return_date')->count();
        $overdueBooks = $borrowings->where('return_date', '<', Carbon::now())->count();
        $onTimeReturns = $borrowings->where('return_date', '>=', Carbon::now())->count();
        $totalBooks = Book::count('stock');
        $totalMembers = Member::count();

        $percentageChangeRented = null;
        $percentageChangeOverdue = null;
        $percentageChangeOnTimeReturns = null;
        $percentageChangeTotalBooks = null;
        $percentageChangeTotalMembers = null;

        return compact(
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
        );
    }
}
