<!DOCTYPE html>
<html lang="en" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/ae360af17e.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/stylee.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sb-admin-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/sb-admin-2.min.css') }}">
    <!-- Custom fonts for this template-->

</head>

<body>
    <div class="wrapper">
        @include('admin.sidebar')
        <div class="main">
            <nav class="navbar navbar-expand px-3 border-bottom">
                <button class="btn" id="sidebar-toggle" type="button">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </nav>




            <!-- Content Row -->
            <div class="row">

                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        laki-laki</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $data->where('jenis_kelamin', 'Laki-laki')->count();}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-male fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Perempuan</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{  $data->where('jenis_kelamin', 'Perempuan')->count();}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-female fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Earnings (Monthly) Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Orang Sakit</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{$rekammedis->count();}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-procedures fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Pending Requests Card Example -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $data->count() + $rekammedis->count()}}</div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-users fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Content Row -->

            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-8 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <canvas id="myChart" width="400" height="200"></canvas>

                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Data yang akan ditampilkan di grafik
                            var ctx = document.getElementById('myChart').getContext('2d');
                            var myChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Laki-laki', 'Perempuan', 'Orang Sakit'],
                                    datasets: [{
                                        label: 'Jumlah',
                                        data: [ {{  $data->where('jenis_kelamin', 'Laki-laki')->count()}}
                                            , {{  $data->where('jenis_kelamin', 'Perempuan')->count();}}
                                            , {{$rekammedis->count()}}], // Tambahkan nilai baru untuk jumlah
                                        backgroundColor: [
                                            '#68D2E8', // Warna untuk laki-laki
                                            '#0A6847', // Warna untuk perempuan
                                            '#F3CA52', // Warna untuk orang sakit

                                        ],
                                        borderColor: [
                                            '#68D2E8', // Warna garis batas untuk laki-laki
                                            '#0A6847', // Warna garis batas untuk perempuan
                                            '#F3CA52', // Warna garis batas untuk orang sakit

                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>

                <!-- Pie Chart -->
                <div class="col-xl-4 col-lg-5">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">

                            <canvas id="genderChart" width="100" height="50"></canvas>
                        </div>
                        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                        <script>
                            // Data yang akan ditampilkan di grafik
                            var ctx = document.getElementById('genderChart').getContext('2d');
                            var genderChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Laki-laki', 'Perempuan'],
                                    datasets: [{
                                        label: 'Jenis Kelamin',
                                        data: [{{  $data->where('jenis_kelamin', 'Laki-laki')->count()}},
                                        {{  $data->where('jenis_kelamin', 'Perempuan')->count();}}
                                        ], // Ubah nilai sesuai dengan data yang sesuai
                                        backgroundColor: [
                                            '#68D2E8', // Warna untuk laki-laki
                                            '#0A6847' // Warna untuk perempuan
                                        ],
                                        borderColor: [
                                            '#68D2E8', // Warna garis batas untuk laki-laki
                                            '#0A6847' // Warna garis batas untuk perempuan
                                        ],
                                        borderWidth: 1
                                    }]
                                },
                                options: {
                                    scales: {
                                        y: {
                                            beginAtZero: true
                                        }
                                    }
                                }
                            });
                        </script>

                    </div>
                </div>
            </div>

            <!-- Scroll to Top Button-->
            <a class="scroll-to-top rounded" href="#page-top">
                <i class="fas fa-angle-up"></i>
            </a>

            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="login.html">Logout</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

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