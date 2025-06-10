<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(4);
        return view('movie.index', ['movies' => $movies]);
    }

    public function detail($id, $slug)
    {
        $movie = Movie::find($id);
        return view('layouts.detailmovie', compact('movie'));
    }

    public function homepage()
    {
        $movies = Movie::latest()->paginate(25);
        return view('layouts.home', ['movies' => $movies]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('movie.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $slug = Str::slug($request->title);

        // Tambahkan slug ke dalam request
        $request->merge(['slug' => $slug]);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'year' => 'required | integer| min:1950 | max: ' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,webp,|max:2048',
        ]);
        $slug = Str::slug($request->title);
        // Simpan input ke storage
        $cover = null;

        if ($request->hasFile('cover_image')) {
            $cover  = $request->file('cover_image')->store('covers', 'public');
        }
        //simpan ke tabel movies database
        Movie::create(
            [
                'title' => $validated['title'],
                'slug' => $slug,
                'synopsis' => $validated['synopsis'],
                'category_id' => $validated['category_id'],
                'year' => $validated['year'],
                'actors' => $validated['actors'],
                'cover_image' => $cover,
            ]
        );

        return redirect('home')->with('success', 'Data berhasil disimpan!');
    }

    public function show(Movie $movie)
    {
        return view('movie.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('movie.edit', compact('movie', 'categories'));
    }

    public function update(Request $request, Movie $movie): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug,' . $movie->id,
            'synopsis' => 'nullable|string',
            'year' => 'required|integer|min:1800|max:' . (date('Y') + 1),
            'actors' => 'required|string|max:255',
            'category_id' => 'required|integer',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('cover_image')) {
            // Hapus cover lama jika ada
            if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
                Storage::disk('public')->delete($movie->cover_image);
            }

            $path = $request->file('cover_image')->store('cover_images', 'public');
            $validated['cover_image'] = $path;
        }

        $movie->update($validated);

        return redirect('/movie')->with('success', 'Data Movie berhasil diupdate!');
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        // Cek otorisasi terlebih dahulu
        if (!Gate::allows('delete', $movie)) {
            abort(403);
        }

        // Hapus file cover image dari storage jika ada
        if ($movie->cover_image && Storage::disk('public')->exists($movie->cover_image)) {
            Storage::disk('public')->delete($movie->cover_image);
        }

        // Hapus data movie dari database
        $movie->delete();

        return redirect('/movie')->with('success', 'Data Movie berhasil dihapus!');
    }
}
