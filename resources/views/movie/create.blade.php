@extends('layouts.main')
@section('title', 'Tambah Data Movie')
@section('navMovie', 'active')

@section('content')
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-12">
                <h1 class="h2">Input Data Movie</h1>

                <form action="/movie" method="post">
                    @csrf

                    <div class="row mb-3">
                        <label for="title" class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-10">
                            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="title" value="{{ old('title') }}">
                            @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="slug" class="col-sm-2 col-form-label">Slug</label>
                        <div class="col-sm-10">
                            <input type="text" name="slug" class="form-control @error('slug') is-invalid @enderror" id="slug" value="{{ old('slug') }}">
                            @error('slug') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="synopsis" class="col-sm-2 col-form-label">Synopsis</label>
                        <div class="col-sm-10">
                            <textarea name="synopsis" id="synopsis" rows="4" class="form-control @error('synopsis') is-invalid @enderror">{{ old('synopsis') }}</textarea>
                            @error('synopsis') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="category_id" class="col-sm-2 col-form-label">ID Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" name="category_id" class="form-control @error('category_id') is-invalid @enderror" id="category_id" value="{{ old('category_id') }}">
                            @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="year" class="col-sm-2 col-form-label">Tahun</label>
                        <div class="col-sm-10">
                            <input type="text" name="year" class="form-control @error('year') is-invalid @enderror" id="year" value="{{ old('year') }}">
                            @error('year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="actors" class="col-sm-2 col-form-label">Aktor</label>
                        <div class="col-sm-10">
                            <input type="text" name="actors" class="form-control @error('actors') is-invalid @enderror" id="actors" value="{{ old('actors') }}">
                            @error('actors') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    {{-- Submit Button --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
