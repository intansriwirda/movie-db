<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Http\RedirectResponse;

class MovieController extends Controller
{
    public function index()
    {
        $movies = Movie::latest()->paginate(25);

        return view('movie.index', ['movies' => $movies]);
         //compact('movies') untuk menyingkat array  ['movies' => $movies]
        // $movies = Movie::with('category')->latest()->paginate(25);
    }

    public function homepage()
    {
        $movies = Movie::latest()->paginate(25);

        return view('layouts.home', ['movies' => $movies]);
         //compact('movies') untuk menyingkat array  ['movies' => $movies]
        // $movies = Movie::with('category')->latest()->paginate(25);
    }

    public function create()
    {
        return view('movie.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:movies,slug',
            'synopsis' => 'nullable|string',
            'year' => 'required|integer|min:1800|max:' . (date('Y') + 1),
            'actors' => 'required|string|max:255',
            'category_id' => 'required|integer',  // validasi category_id bigint sebagai integer
        ]);

        Movie::create($validated);

        return redirect('/movie')->with('success', 'Data Movie berhasil ditambahkan!');
    }

    public function show(Movie $movie)
    {
        return view('movie.show', compact('movie'));
    }

    public function edit(Movie $movie)
    {
        return view('movie.edit', compact('movie'));
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
        ]);

        $movie->update($validated);

        return redirect('/movie')->with('success', 'Data Movie berhasil diupdate!');
    }

    public function destroy(Movie $movie): RedirectResponse
    {
        $movie->delete();
        return redirect('/movie')->with('success', 'Data Movie berhasil dihapus!');
    }
}
