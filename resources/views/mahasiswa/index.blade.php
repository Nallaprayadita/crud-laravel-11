<!DOCTYPE html>
<html>
<head>
    <title>Daftar Mahasiswa</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <!-- Header & Tombol -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h1 class="h3 text-primary">📋 Daftar Mahasiswa</h1>
            <div>
                <a href="{{ route('mahasiswa.cetak') }}" class="btn btn-danger me-2" target="_blank">
                    <i class="bi bi-file-earmark-pdf"></i> Cetak PDF
                </a>
                <a href="{{ route('mahasiswa.exportExcel') }}" class="btn btn-success me-2">
                    <i class="bi bi-file-earmark-excel"></i> Export Excel
                </a>
                <a href="{{ route('mahasiswa.create') }}" class="btn btn-primary">
                    + Tambah Mahasiswa
                </a>
            </div>
        </div>

        <!-- 🔍 Form Pencarian: sekarang DI BAWAH tombol -->
        <div class="row mb-4">
            <div class="col-md-6">
                <form action="{{ route('mahasiswa.index') }}" method="GET">
                    <div class="input-group">
                        <span class="input-group-text bg-primary text-white">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" class="form-control"
                            placeholder="Cari nama, NIM, atau email..."
                            value="{{ request('search') }}">
                        <button class="btn btn-primary" type="submit">Cari</button>
                        @if(request('search'))
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Reset</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>

        <!-- Tabel Data -->
        <div class="card shadow-sm">
            <div class="card-body">
                <table class="table table-striped table-bordered align-middle">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>Nama</th>
                            <th>NIM</th>
                            <th>Email</th>
                            <th width="150">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswa as $m)
                        <tr>
                            <td>{{ $m->nama }}</td>
                            <td>{{ $m->nim }}</td>
                            <td>{{ $m->email }}</td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('mahasiswa.edit',$m->id) }}" class="btn btn-warning btn-sm">✏ Edit</a>
                                    <form action="{{ route('mahasiswa.destroy',$m->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">🗑 Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if($mahasiswa->isEmpty())
                    <p class="text-center text-muted">Belum ada data mahasiswa.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
