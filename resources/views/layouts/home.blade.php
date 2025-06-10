@extends('layouts.main')
@section('title', 'Data Home')
@section('navHome','active')

@section('content')

<h1 class="mt-5">Daftar Movie</h1>
<div class="row">
    @foreach ($movies as $movie)
    <div class="col-lg-6">
        <div class="card mb-3" style="max-width: 540px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="{{ asset('storage/' . $movie->cover_image) }}" class="img-fluid rounded-start" alt="{{ $movie->title }}">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">{{ $movie->title }}</h5>
                        <p class="card-text">{{ Str::limit($movie->synopsis, 100) }}</p>
                        <p class="card-text"><strong>Year:</strong> {{ $movie->year }}</p>
                        <p class="card-text"><strong>Category:</strong> {{ $movie->category->category_name ?? 'Tidak ada' }}</p>
                        <p class="card-text"><strong>Actors:</strong> {{ $movie->actors }}</p>
                        <a href="{{ route('movie.detail', ['id' => $movie->id, 'slug' => $movie->slug]) }}" class="btn btn-success">Read More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

{{-- Pagination --}}
<div class="d-flex justify-content-center mt-4">
    {{ $movies->links() }}
</div>

@endsection
