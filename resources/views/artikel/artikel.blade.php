<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
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
                            <h4>Artikel</h4>
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
                            <form action="{{ route('insertartikel') }}" method="POST"> <!-- Mengganti route dari 'insertrekammedis' menjadi 'insertartikel' -->
                                @csrf
                                <div class="mb-3">
                                    <label for="id_artikel" class="form-label">ID Artikel *</label> <!-- Mengganti 'ID Rekam Medis' menjadi 'ID Artikel' -->
                                    <input type="text" class="form-control" id="id_artikel" name="id_artikel" required> <!-- Mengganti 'id_rekammedis' menjadi 'id_artikel' -->
                                </div>
                                <div class="mb-3">
                                    <label for="judul" class="form-label">Judul *</label>
                                    <input type="text" class="form-control" id="judul" name="judul" required>
                                </div>
                                <div class="mb-3">
                                    <label for="tanggal_publikasi" class="form-label">Tanggal Publikasi *</label>
                                    <input type="date" class="form-control" id="tanggal_publikasi" name="tanggal_publikasi" required>
                                </div>
                                <div class="mb-3">
                                    <label for="img_artikel" class="form-label">Gambar Artikel *</label> <!-- Mengganti 'img_artikel' menjadi 'Gambar Artikel' -->
                                    <input type="text" class="form-control" id="img_artikel" name="img_artikel" required> <!-- Mengganti 'img_artikel' menjadi 'img_artikel' -->
                                </div>
                                <div class="mb-3">
                                    <label for="isi_artikel" class="form-label">Isi Artikel *</label> <!-- Mengganti 'riwayat_penyakit' menjadi 'Isi Artikel' -->
                                    <input type="text" class="form-control" id="isi_artikel" name="isi_artikel" required> <!-- Mengganti 'riwayat_penyakit' menjadi 'isi_artikel' -->
                                </div>
                                <div class="mb-3">
                                    <label for="nip" class="form-label">NIP *</label> <!-- Menambahkan field untuk NIP -->
                                    <input type="text" class="form-control" id="nip" name="nip" required>
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
                                        <th>ID Artikel</th>
                                        <th>Judul</th>
                                        <th>Tanggal Publikasi</th>
                                        <th>Gambar Artikel</th> <!-- Mengganti 'img_artikel' menjadi 'Gambar Artikel' -->
                                        <th>Isi Artikel</th> <!-- Mengganti 'riwayat_penyakit' menjadi 'Isi Artikel' -->
                                        <th>NIP</th> <!-- Menambahkan kolom NIP -->
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tabel as $artikel) <!-- Mengganti $rekammedis menjadi $artikel -->
                                    <tr>
                                        <td>{{ $artikel->id_artikel }}</td> <!-- Mengganti 'id_rekammedis' menjadi 'id_artikel' -->
                                        <td>{{ $artikel->judul }}</td>
                                        <td>{{ $artikel->tanggal_publikasi }}</td>
                                        <td>{{ $artikel->img_artikel }}</td> <!-- Mengganti 'img_artikel' menjadi 'Gambar Artikel' -->
                                        <td>{{ $artikel->isi_artikel }}</td> <!-- Mengganti 'riwayat_penyakit' menjadi 'Isi Artikel' -->
                                        <td>{{ $artikel->nip }}</td> <!-- Menambahkan kolom NIP -->
                                        <td>
                                            <form id="deleteForm" action="{{ route('deleteartikel') }}" method="post"> <!-- Mengganti route dari 'deleterekammedis' menjadi 'deleteartikel' -->
                                                @csrf
                                                <input value="{{ $artikel->id_artikel }}" type="hidden" name="id_artikel"> <!-- Mengganti 'id_rekammedis' menjadi 'id_artikel' -->
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