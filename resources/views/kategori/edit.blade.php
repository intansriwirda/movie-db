@extends('layouts.main')
@section('title', 'Edit Category')
@section('content')

<h1>Edit Data Kategori</h1>

{{-- Tampilkan pesan error jika ada --}}
@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('categories.update', $category->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="category_name" class="form-label">Nama Kategori</label>
        <input
            type="text"
            name="category_name"
            class="form-control @error('category_name') is-invalid @enderror"
            id="category_name"
            value="{{ old('category_name', $category->category_name) }}"
            required>
        @error('category_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Deskripsi</label>
        <textarea
            name="description"
            id="description"
            rows="4"
            class="form-control @error('description') is-invalid @enderror"
            required>{{ old('description', $category->description) }}</textarea>
        @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-success">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Batal</a>
</form>

@endsection
