@extends('layouts.main')

@section('title', 'Daftar Kategori')
@section('navKategori', 'active')

@section('content')
    <h1 class="mb-4">Daftar Kategori</h1>

    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">
        <i class="bi bi-plus-circle"></i> Input Data Kategori
    </a>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="success-alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <script>
            setTimeout(() => {
                const alert = document.getElementById('success-alert');
                if (alert) {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }
            }, 2000); // alert hilang setelah 2 detik
        </script>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-bordered align-middle">
            <thead class="table-dark">
                <tr>
                    <th scope="col" style="width:5%;">No</th>
                    <th scope="col" style="width:20%;">Nama Kategori</th>
                    <th scope="col">Deskripsi</th>
                    <th scope="col" style="width:15%;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        {{-- <td>{{ $categories->firstItem() + $loop->index }}</td> --}}
                        <td>{{ $category->category_name }}</td>
                        <td>{{ $category->description }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </a>

                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Hapus">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div>
        {{ $categories->links() }}
    </div>
@endsection
