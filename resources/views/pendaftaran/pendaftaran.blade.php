<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Antrian</title>
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
                            <h4>Pendaftaran</h4>
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
                            <form action="{{ route('insertpendaftaran') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="id_pendaftaran" class="form-label">ID Pendaftaran *</label>
                                    <input type="text" class="form-control" id="id_pendaftaran" name="id_pendaftaran" required>
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
                                    <label for="tanggal_periksa" class="form-label">Tanggal Pendaftaran *</label>
                                    <input type="date" class="form-control" id="tanggal_pendaftaran" name="tanggal_pendaftaran" required>
                                </div>
                                <div class="mb-3">
                                    <label for="deskripsi_keluhan" class="form-label">Deskripsi Keluhan *</label>
                                    <input type="text" class="form-control" id="deskripsi_keluhan" name="deskripsi_keluhan" required>
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status *</label>
                                    <input type="text" class="form-control" id="status" name="status" required>
                                </div>
                                <div class="mb-3">
                                    <label for="antrian" class="form-label">Antrian *</label>
                                    <input type="number" class="form-control" id="antrian" name="antrian" required>
                                </div>
                                <button type="submit" class="btn btn-primary">+ Tambah Data</button>
                            </form>


                            <!-- FORM PENCARIAN -->
                            <div class="pb-3" style="margin-top: 20px;">
                                <form class="d-flex" action="" method="get">
                                    <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                                    <button class="btn btn-secondary" type="submit">Cari</button>
                                </form>
                            </div>

                            <!-- TABEL DATA -->
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID Pendaftaran</th>
                                        <th>NIK</th>
                                        <th>ID Poli</th>
                                        <th>Tanggal Pendaftaran</th>
                                        <th>Deskripsi Keluhan</th>
                                        <th>Status</th>
                                        <th>Antrian</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tabel as $pendaftaran)
                                    <tr>
                                        <td>{{ $pendaftaran->id_pendaftaran }}</td>
                                        <td>{{ $pendaftaran->nik }}</td>
                                        <td>{{ $pendaftaran->id_poli }}</td>
                                        <td>{{ $pendaftaran->tanggal_pendaftaran }}</td>
                                        <td>{{ $pendaftaran->deskripsi_keluhan }}</td>
                                        <td>{{ $pendaftaran->status }}</td>
                                        <td>{{ $pendaftaran->antrian }}</td>
                                        <td>
                                            <form id="deleteForm{{ $pendaftaran->id_pendaftaran }}" action="{{ route('deletependaftaran') }}" method="post">
                                                @csrf
                                                <input value="{{ $pendaftaran->id_pendaftaran }}" type="hidden" name="id_pendaftaran">
                                                <button type="button" class="btn btn-danger" onclick="confirmDelete('{{ $pendaftaran->id_pendaftaran }}')">Hapus</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
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