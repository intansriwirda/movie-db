<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Daftar Film</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Movie App</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a href="{{ url('/movies') }}" class="nav-link">Daftar Film</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <main class="container">
        <h1 class="mb-4">Daftar Film</h1>

        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark text-center">
                    <tr>
                        <th>Cover</th>
                        <th>Judul</th>
                        <th>Slug</th>
                        <th>Sinopsis</th>
                        <th>Category ID</th>
                        <th>Nama Kategori</th>
                        <th>Tahun</th>
                        <th>Pemeran</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($movies as $movie)
                        <tr>
                            <td class="text-center">
                                @if ($movie->cover_image)
                                    <img src="{{ asset('storage/' . $movie->cover_image) }}" alt="{{ $movie->title }}" width="100" class="img-thumbnail">
                                @else
                                    <span class="text-muted">Tidak ada gambar</span>
                                @endif
                            </td>
                            <td>{{ $movie->title }}</td>
                            <td>{{ $movie->slug }}</td>
                            <td>{{ Str::limit($movie->synopsis, 100) }}</td>
                            <td class="text-center">{{ $movie->category_id }}</td>
                            <td>{{ $movie->category->category_name ?? '-' }}</td>
                            <td class="text-center">{{ $movie->year }}</td>
                            <td>{{ $movie->actors }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted">Tidak ada data film.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </main>

    <footer class="bg-light text-center py-3 mt-4">
        <small>© {{ date('Y') }} Movie App</small>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
