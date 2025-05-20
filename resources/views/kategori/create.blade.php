@extends('layouts.main')

@section('title', 'Tambah Data Kategori')
@section('navKategori', 'active')
@section('content')
    <div class="row">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <div class="col-12">
                <h1 class="h2">Input Data Kategori</h1>

                <form action="/categories" method="post">
                    @csrf

                    {{-- Category Name --}}
                    <div class="row mb-3">
                        <label for="category_name" class="col-sm-2 col-form-label">Nama Kategori</label>
                        <div class="col-sm-10">
                            <input type="text"
                                   name="category_name"
                                   id="category_name"
                                   class="form-control @error('category_name') is-invalid @enderror"
                                   value="{{ old('category_name') }}">
                            @error('category_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="row mb-3">
                        <label for="description" class="col-sm-2 col-form-label">Deskripsi</label>
                        <div class="col-sm-10">
                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      class="form-control @error('description') is-invalid @enderror">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Tombol Submit --}}
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
