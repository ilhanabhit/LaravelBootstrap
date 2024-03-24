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
                    <!-- START DATA -->
                    <div class="my-3 p-3 bg-body rounded shadow-sm">
                        <!-- FORM PENCARIAN -->
                        <div class="pb-3">
                            <form class="d-flex" action="" method="get">
                                <input class="form-control me-1" type="search" name="katakunci" value="{{ Request::get('katakunci') }}" placeholder="Masukkan kata kunci" aria-label="Search">
                                <button class="btn btn-secondary" type="submit">Cari</button>
                            </form>
                        </div>

                        <!-- TOMBOL TAMBAH DATA -->
                        <div class="pb-3">
                            <a href='' class="btn btn-primary">+ Tambah Data</a>
                        </div>

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="col-md-1">no</th>
                                    <th class="col-md-1">NIK</th>
                                    <th class="col-md-1">Nama Pasien</th>
                                    <th class="col-md-1">Jenis Kelamin</th>
                                    <th class="col-md-1">No BPJS</th>
                                    <th class="col-md-1">Email</th>
                                    <th class="col-md-1" style="min-width: 100px;">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>08363742837</td>
                                    <td>Ani</td>
                                    <td>perempuan</td>
                                    <td>8176473264</td>
                                    <td>iagsf@gmail.com</td>
                                    <td>
                                        <a href='' class="btn btn-warning btn-sm">Edit</a>
                                        <a href='' class="btn btn-danger btn-sm">Del</a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>08363742837</td>
                                    <td>Ani</td>
                                    <td>perempuan</td>
                                    <td>8176473264</td>
                                    <td>iagsf@gmail.com</td>
                                    <td>
                                        <a href='' class="btn btn-warning btn-sm">Edit</a>
                                        <a href='' class="btn btn-danger btn-sm">Del</a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- AKHIR DATA -->
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