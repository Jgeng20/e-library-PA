<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('books')->get();
        return view('pages.category.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.category.create', compact('categories'));
    }

    public function store(StoreCategoryRequest $request)
    {
        // Validated data will be automatically available here
        $validatedData = $request->validated();

        Category::create($validatedData);

        return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $categories = Category::findOrFail($id);
        return view('pages.category.edit', compact('categories'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $categories = Category::findOrFail($id);
        $validatedData = $request->validated();

        $categories->update($validatedData);

        return redirect()->route('category.index')->with('success', 'category berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        return redirect()->route('category.index')->with('success', 'category berhasil dihapus.');
    }

    public function getBooksCountByCategory()
    {
        $categories = Category::withCount('books')->get();
        $data = $categories->map(function ($category) {
            return [
                'category' => $category->name,
                'books_count' => $category->books_count
            ];
        });

        return response()->json($data);
    }
}
