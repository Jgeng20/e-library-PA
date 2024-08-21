<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\{
    BorrowingController,
    BookController,
    DashboardController,
    HomeController,
    MemberController,
    UserController,
    AplicationController,
};

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Define route for home page
Route::get('/', [HomeController::class, 'index']);

// Auth routes
Auth::routes(['register' => false, 'reset' => false]);

// Protect the routes with auth middleware
Route::middleware('auth')->group(function () {
    // Dashboard routes
    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
        Route::get('/data/books-by-month', [DashboardController::class, 'getBooksByMonthData'])->name('dashboard.data.books_by_month');
        Route::get('/data/books-by-category', [DashboardController::class, 'getBooksByCategory'])->name('dashboard.data.books_by_category');
        Route::get('/data/books-status-data', [DashboardController::class, 'getBooksStatusData'])->name('dashboard.data.books_statue_data');
        Route::get('/data/books-amount-data', [DashboardController::class, 'getBooksAmountData'])->name('dashboard.data.books_amount_data');
        Route::get('/dashboard/data/top_borrowed_books', [DashboardController::class, 'getTopBorrowedBooks'])->name('dashboard.data.top_borrowed_books');

    });

    // Member routes
    Route::resource('members', MemberController::class);

    // Book routes including soft deletes
    Route::prefix('books')->group(function () {
        Route::get('trashed', [BookController::class, 'trashed'])->name('books.trashed');
        Route::post('{id}/restore', [BookController::class, 'restore'])->name('books.restore');
        Route::delete('{id}/force-delete', [BookController::class, 'forceDelete'])->name('books.force-delete');
    });

    Route::resource('books', BookController::class);

    // Borrowing routes
    Route::resource('borrowings', BorrowingController::class);

    // User routes protected with role middleware
    Route::resource('users', UserController::class)->middleware('role:admin');

    Route::get('samples/datepicker', function () {
        return view('pages.samples.datepicker');
    })->name('samples.datepicker');

    Route::resource('aplication', AplicationController::class)->middleware('role:admin');
});
