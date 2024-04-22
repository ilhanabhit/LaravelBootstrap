<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pasien</title>
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
                        <h4>Data Pasien</h4>
                    </div>
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
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                    <form action="{{ route('insertpasien') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="nik" class="form-label">NIK *</label>
                            <input type="number" class="form-control" id="nik" name="nik" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama *</label>
                            <input type="text" class="form-control" id="nama" name="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir *</label>
                            <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir" required>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_kelamin" class="form-label">Jenis Kelamin *</label>
                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="no_bpjs" class="form-label">Nomor BPJS</label>
                            <input type="number" class="form-control" id="no_bpjs" name="no_bpjs">
                        </div>
                        <button type="submit" class="btn btn-primary">+ Tambah Data</button>
                    </form>

                </div>

                <!-- AKHIR FORM -->

                <!-- START DATA -->
                <div class="my-3 p-3 bg-body rounded shadow-sm">
                    <!-- FORM PENCARIAN -->
                    <div class="pb-3" style="margin-top: 20px;">
                        <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                    </div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>No. BPJS</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tabel as $pasien)
                            <tr>
                                <td>{{ $pasien->nik }}</td>
                                <td>{{ $pasien->nama }}</td>
                                <td>{{ $pasien->tanggal_lahir }}</td>
                                <td>{{ $pasien->jenis_kelamin }}</td>
                                <td>{{ $pasien->no_bpjs }}</td>
                                <td>
                                    <form id="deleteForm" action="{{ route('deletepasien') }}" method="post">
                                        @csrf
                                        <input value="{{ $pasien->nik }}" type="hidden" name="nik">
                                        <button type="submit" class="btn btn-danger" onclick="return confirmDelete()">Hapus</button>
                                    </form>

                                    <script>
                                        function confirmDelete() {
                                            return confirm("Apakah Anda yakin ingin menghapus data ini?");
                                        }
                                    </script>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- AKHIR DATA -->
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

            </main>
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