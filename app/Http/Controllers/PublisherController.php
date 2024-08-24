<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Publisher;
use App\Http\Requests\StorePublisherRequest;
use App\Http\Requests\UpdatePublisherRequest;

class PublisherController extends Controller
{
    public function index()
    {
        $publisher = Publisher::withCount('books')->get();
        return view('pages.publisher.index', compact('publisher'));
    }

    public function create()
    {
        $publisher = Publisher::all();
        return view('pages.publisher.create', compact('publisher'));
    }

    public function store(StorePublisherRequest $request)
    {
        // Validated data will be automatically available here
        $validatedData = $request->validated();

        Publisher::create($validatedData);

        return redirect()->route('publisher.index')->with('success', 'publisher berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $publisher = Publisher::findOrFail($id);
        return view('pages.publisher.edit', compact('publisher'));
    }

    public function update(UpdatePublisherRequest $request, $id)
    {
        $publisher = Publisher::findOrFail($id);
        $validatedData = $request->validated();

        $publisher->update($validatedData);

        return redirect()->route('publisher.index')->with('success', 'publisher berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $publisher = Publisher::findOrFail($id);
        $publisher->delete();

        return redirect()->route('publisher.index')->with('success', 'publisher berhasil dihapus.');
    }

    public function getBooksCountByPublisher()
    {
        $publisher = Publisher::withCount('books')->get();
        $data = $publisher->map(function ($publisher) {
            return [
                'publisher' => $publisher->name,
                'books_count' => $publisher->books_count
            ];
        });

        return response()->json($data);
    }
}
