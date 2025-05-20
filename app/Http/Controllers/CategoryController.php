<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(25);
        return view('kategori.index', ['categories' => $categories]);
    }

    public function create()
    {
        return view('kategori.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
            'description' => 'nullable|string',
        ]);

        Category::create($validated);

        return redirect('/categories')->with('success', 'Data Kategori berhasil ditambahkan!');
    }

    public function show(Category $category)
    {
        return view('kategori.show', compact('category'));
    }

    public function edit(Category $category)
    {
        return view('kategori.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect('/categories')->with('success', 'Data Kategori berhasil diupdate!');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect('/categories')->with('success', 'Data Kategori berhasil dihapus!');
    }
}
