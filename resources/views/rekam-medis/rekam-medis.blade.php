<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekam Medis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylee.css') }}">

</head>

<body>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="navbar-collapse navbar">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="" style="width: 50px;">
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="{{ route('profile')}}" class="dropdown-item">Profil</a>
                                <a href="{{ route('logout')}}" class="dropdown-item">Keluar</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                            <h4>Rekam Medis</h4>
                            <!-- error -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <!-- success -->
                            @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                            @endif

                            <!-- FORM TAMBAH DATA -->
                            <form action="{{ route('insertrekammedis') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_rekammedis" class="form-label">ID Rekam Medis *</label>
                                    <input type="text" class="form-control" id="id_rekammedis" name="id_rekammedis" required>
                                </div>
                                <div class="mb-3">
                                    <label for="id_poli" class="form-label">ID Poli *</label>
                                    <input type="text" class="form-control" id="id_poli" name="id_poli" required>
                                </div>
                                <div class="mb-3">
                                    <label for="nik" class="form-label">NIK *</label>
                                    <input type="number" class="form-control" id="nik" name="nik" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_periksa" class="form-label">Tanggal Periksa *</label>
                                    <input type="date" class="form-control" id="tanggal_periksa" name="tanggal_periksa" required>
                                </div>
                                <div class="mb-3">
                                    <label for="riwayat_penyakit" class="form-label">Riwayat Penyakit *</label>
                                    <input type="text" class="form-control" id="riwayat_penyakit" name="riwayat_penyakit" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tekanan_darah" class="form-label">Tekanan Darah *</label>
                                    <input type="number" class="form-control" id="tekanan_darah" name="tekanan_darah">
                                </div>
                                <div class="mb-3">
                                    <label for="berat_badan" class="form-label">Berat Badan *</label>
                                    <input type="number" class="form-control" id="berat_badan" name="berat_badan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tinggi_badan" class="form-label">Tinggi Badan *</label>
                                    <input type="number" class="form-control" id="tinggi_badan" name="tinggi_badan" required>
                                </div>
                                <button type="submit" class="btn btn-primary">+ Tambah Data</button>
                            </form>

                            <!-- FORM PENCARIAN -->
                            <div class="pb-3" style="margin-top: 20px;">
                                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">                            
                            </div>

                            <!-- TABEL DATA -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Rekam Medis</th>
                                        <th>ID Poli</th>
                                        <th>NIK</th>
                                        <th>Tanggal Periksa</th>
                                        <th>Riwayat Penyakit</th>
                                        <th>Tekanan Darah</th>
                                        <th>Berat Badan</th>
                                        <th>Tinggi Badan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tabel as $rekammedis)
                                    <tr>
                                        <td>{{ $rekammedis->id_rekammedis }}</td>
                                        <td>{{ $rekammedis->id_poli }}</td>
                                        <td>{{ $rekammedis->nik }}</td>
                                        <td>{{ $rekammedis->tanggal_periksa }}</td>
                                        <td>{{ $rekammedis->riwayat_penyakit }}</td>
                                        <td>{{ $rekammedis->tekanan_darah }} mm/H</td>
                                        <td>{{ $rekammedis->berat_badan }}</td>
                                        <td>{{ $rekammedis->tinggi_badan }}</td>
                                        <td>
                                            <form id="deleteForm" action="{{ route('deleterekammedis') }}" method="post">
                                                @csrf
                                                <input value="{{ $rekammedis->id_rekammedis }}" type="hidden" name="id_rekammedis">
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Hapus</button>
                                            </form>

                                            <script>
                                                function confirmDelete() {
                                                    if (confirm("Apakah Anda yakin ingin menghapus Data Ini ini?")) {
                                                        document.getElementById("deleteForm").submit();
                                                    }
                                                }
                                            </script>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
            </main>
            <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        var input = document.querySelector('input[name="katakunci"]');
                        var rows = document.querySelectorAll('tbody tr');

                        input.addEventListener("input", function() {
                            var keyword = input.value.toLowerCase();

                            rows.forEach(function(row) {
                                var nik = row.querySelector('td:first-child').innerText.toLowerCase(); // Ambil nilai NIK di kolom pertama
                                if (nik.includes(keyword)) {
                                    row.style.display = "";
                                } else {
                                    row.style.display = "none";
                                }
                            });
                        });
                    });
                </script>
            <a href="#" class="theme-toggle">
                <i class="fa-regular fa-moon"></i>
                <i class="fa-regular fa-sun"></i>
            </a>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row text-muted">
                        <div class="col-6 text-start">
                            <p class="mb-0">
                                <a href="#" class="text-muted">
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/js/mainn.js')}}"></script>
</body>

</html>