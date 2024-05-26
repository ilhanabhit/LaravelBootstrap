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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

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
            <main class="content px-3 py-2">
                <div class="container-fluid">
                    <div class="mb-3">
                        <div class="my-3 p-3 bg-body rounded shadow-sm">

                            <style>
                                body {
                                    color: #566787;
                                    background: #f5f5f5;
                                    font-family: 'Varela Round', sans-serif;
                                    font-size: 13px;
                                }

                                .table-responsive {
                                    margin: 30px 0;
                                }

                                .table-wrapper {
                                    background: #fff;
                                    padding: 20px 25px;
                                    border-radius: 3px;
                                    min-width: 1000px;
                                    box-shadow: 0 1px 1px rgba(0, 0, 0, .05);
                                }

                                .table-title {
                                    padding-bottom: 15px;
                                    background: #435d7d;
                                    color: #fff;
                                    padding: 16px 30px;
                                    min-width: 100%;
                                    margin: -20px -25px 10px;
                                    border-radius: 3px 3px 0 0;
                                }

                                .table-title h2 {
                                    margin: 5px 0 0;
                                    font-size: 24px;
                                }

                                .table-title .btn-group {
                                    float: right;
                                }

                                .table-title .btn {
                                    color: #fff;
                                    float: right;
                                    font-size: 13px;
                                    border: none;
                                    min-width: 50px;
                                    border-radius: 2px;
                                    border: none;
                                    outline: none !important;
                                    margin-left: 10px;
                                }

                                .table-title .btn i {
                                    float: left;
                                    font-size: 21px;
                                    margin-right: 5px;
                                }

                                .table-title .btn span {
                                    float: left;
                                    margin-top: 2px;
                                }

                                table.table tr th,
                                table.table tr td {
                                    border-color: #e9e9e9;
                                    padding: 12px 15px;
                                    vertical-align: middle;
                                }

                                table.table tr th:first-child {
                                    width: 60px;
                                }

                                table.table tr th:last-child {
                                    width: 100px;
                                }

                                table.table-striped tbody tr:nth-of-type(odd) {
                                    background-color: #fcfcfc;
                                }

                                table.table-striped.table-hover tbody tr:hover {
                                    background: #f5f5f5;
                                }

                                table.table th i {
                                    font-size: 13px;
                                    margin: 0 5px;
                                    cursor: pointer;
                                }

                                table.table td:last-child i {
                                    opacity: 0.9;
                                    font-size: 22px;
                                    margin: 0 5px;
                                }

                                table.table td a {
                                    font-weight: bold;
                                    color: #566787;
                                    display: inline-block;
                                    text-decoration: none;
                                    outline: none !important;
                                }

                                table.table td a:hover {
                                    color: #2196F3;
                                }

                                table.table td a.edit {
                                    color: #FFC107;
                                }

                                table.table td a.delete {
                                    color: #F44336;
                                }

                                table.table td i {
                                    font-size: 19px;
                                }

                                table.table .avatar {
                                    border-radius: 50%;
                                    vertical-align: middle;
                                    margin-right: 10px;
                                }

                                .pagination {
                                    float: right;
                                    margin: 0 0 5px;
                                }

                                .pagination li a {
                                    border: none;
                                    font-size: 13px;
                                    min-width: 30px;
                                    min-height: 30px;
                                    color: #999;
                                    margin: 0 2px;
                                    line-height: 30px;
                                    border-radius: 2px !important;
                                    text-align: center;
                                    padding: 0 6px;
                                }

                                .pagination li a:hover {
                                    color: #666;
                                }

                                .pagination li.active a,
                                .pagination li.active a.page-link {
                                    background: #03A9F4;
                                }

                                .pagination li.active a:hover {
                                    background: #0397d6;
                                }

                                .pagination li.disabled i {
                                    color: #ccc;
                                }

                                .pagination li i {
                                    font-size: 16px;
                                    padding-top: 6px
                                }

                                .hint-text {
                                    float: left;
                                    margin-top: 10px;
                                    font-size: 13px;
                                }

                                /* Custom checkbox */
                                .custom-checkbox {
                                    position: relative;
                                }

                                .custom-checkbox input[type="checkbox"] {
                                    opacity: 0;
                                    position: absolute;
                                    margin: 5px 0 0 3px;
                                    z-index: 9;
                                }

                                .custom-checkbox label:before {
                                    width: 18px;
                                    height: 18px;
                                }

                                .custom-checkbox label:before {
                                    content: '';
                                    margin-right: 10px;
                                    display: inline-block;
                                    vertical-align: text-top;
                                    background: white;
                                    border: 1px solid #bbb;
                                    border-radius: 2px;
                                    box-sizing: border-box;
                                    z-index: 2;
                                }

                                .custom-checkbox input[type="checkbox"]:checked+label:after {
                                    content: '';
                                    position: absolute;
                                    left: 6px;
                                    top: 3px;
                                    width: 6px;
                                    height: 11px;
                                    border: solid #000;
                                    border-width: 0 3px 3px 0;
                                    transform: inherit;
                                    z-index: 3;
                                    transform: rotateZ(45deg);
                                }

                                .custom-checkbox input[type="checkbox"]:checked+label:before {
                                    border-color: #03A9F4;
                                    background: #03A9F4;
                                }

                                .custom-checkbox input[type="checkbox"]:checked+label:after {
                                    border-color: #fff;
                                }

                                .custom-checkbox input[type="checkbox"]:disabled+label:before {
                                    color: #b8b8b8;
                                    cursor: auto;
                                    box-shadow: none;
                                    background: #ddd;
                                }

                                /* Modal styles */
                                .modal .modal-dialog {
                                    max-width: 400px;
                                }

                                .modal .modal-header,
                                .modal .modal-body,
                                .modal .modal-footer {
                                    padding: 20px 30px;
                                }

                                .modal .modal-content {
                                    border-radius: 3px;
                                    font-size: 14px;
                                }

                                .modal .modal-footer {
                                    background: #ecf0f1;
                                    border-radius: 0 0 3px 3px;
                                }

                                .modal .modal-title {
                                    display: inline-block;
                                }

                                .modal .form-control {
                                    border-radius: 2px;
                                    box-shadow: none;
                                    border-color: #dddddd;
                                }

                                .modal textarea.form-control {
                                    resize: vertical;
                                }

                                .modal .btn {
                                    border-radius: 2px;
                                    min-width: 100px;
                                }

                                .modal form label {
                                    font-weight: normal;
                                }
                            </style>

                            </head>

                            @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                            @endif

                            <!-- Tampilkan pesan sukses -->
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <!-- Tampilkan pesan kesalahan validasi -->
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <body>
                                <div class="container-xl">
                                    <div class="table-responsive">
                                        <div class="table-wrapper">
                                            <div class="table-title">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <h2> Data <b>Rekam Medis</b></h2>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a href="#addEmployeeModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Tambah Data </span></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <style>
                                                .search-container {
                                                    display: flex;
                                                    justify-content: flex-start;
                                                    align-items: center;
                                                    height: 10vh;
                                                }

                                                .search-box {
                                                    display: flex;
                                                    align-items: center;
                                                    border: 1px solid #ccc;
                                                    border-radius: 5px;
                                                    padding: 10px;
                                                    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
                                                }

                                                .search-box input[type="text"] {
                                                    border: none;
                                                    outline: none;
                                                    padding: 5px;
                                                }

                                                .search-box button {
                                                    background-color: #007bff;
                                                    color: #fff;
                                                    border: none;
                                                    padding: 5px 10px;
                                                    border-radius: 5px;
                                                    cursor: pointer;
                                                }
                                            </style>

                                            </head>

                                            <body>
                                                <div class="search-container">
                                                    <div class="search-box">
                                                        <input type="text" placeholder="Cari Berdasarkan ID Rekam Medis" id="searchInput">
                                                        <button type="button" id="searchButton"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>



                                                <table class="table table-striped">
                                                    <thead>
                                                        <tr>
                                                            <th>ID Rekam Medis</th>
                                                            <th>ID Poli</th>
                                                            <th>NIK</th>
                                                            <th>Tanggal Periksa</th>
                                                            <th>Riwayat Penyakit</th>
                                                            <th>Tekanan Darah</th>
                                                            <!-- <th>Berat Badan</th> -->
                                                            <th>Berat / Tinggi Badan</th>
                                                            <th>Aksi</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($tabel as $rekam_medis)
                                                        <tr>
                                                            <td>{{ $rekam_medis->id_rekammedis }}</td>
                                                            <td>{{ $rekam_medis->id_poli }}</td>
                                                            <td>{{ $rekam_medis->nik }}</td>
                                                            <td>{{ $rekam_medis->tanggal_periksa}}</td>
                                                            <td>{{ $rekam_medis->riwayat_penyakit }}</td>
                                                            <td>{{ $rekam_medis->tekanan_darah }} mmHg</td>
                                                            <td>{{ $rekam_medis->berat_badan }} Kg
                                                                / {{ $rekam_medis->tinggi_badan }} Cm</>
                                                            <td>
                                                                <!-- Trigger/Edit Button -->
                                                                <a href="#editEmployeeModal" class="edit" data-toggle="modal" data-rekammedis="{{ $rekam_medis->id_rekammedis }}" data-poli="{{ $rekam_medis->id_poli }}" data-nik="{{ $rekam_medis->nik }}" data-tanggal="{{ $rekam_medis->tanggal_periksa }}" data-riwayat="{{ $rekam_medis->riwayat_penyakit }}" data-tekanan="{{ $rekam_medis->tekanan_darah }}" data-berat="{{ $rekam_medis->berat_badan }}" data-tinggi="{{ $rekam_medis->tinggi_badan }}">
                                                                    <i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i>
                                                                </a>
                                                                <!-- Delete Button -->
                                                                <a href="#deleteEmployeeModal{{ $rekam_medis->id }}" class="delete" data-toggle="modal">
                                                                    <i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        <!-- Delete Modal -->
                                                        <div id="deleteEmployeeModal{{ $rekam_medis->id }}" class="modal fade">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <form action="{{ route('deleterekammedis') }}" method="post">
                                                                        @csrf
                                                                        <input type="hidden" name="id_rekammedis" value="{{ $rekam_medis->id_rekammedis }}">
                                                                        <div class="modal-header">
                                                                            <h4 class="modal-title">Hapus Data</h4>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <p>Apakah Anda Yakin Menghapus Data ini?</p>
                                                                            <p class="text-warning"><small>Setelah Data Di Hapus Tidak bisa Di Batalkan</small></p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @endforeach
                                                    </tbody>
                                                </table>

                                                </table>
                                                <div class="clearfix">
                                                    <div class="clearfix">
                                                        <div class="hint-text" id="hintText">Menampilkan <b>1</b> Dari <b>25</b> Data</div>
                                                    </div>



                                                    <ul class="pagination" id="pagination">
                                                        <li class="page-item disabled"><a href="#">Sebelumnya</a></li>
                                                        <!-- Pagination items will be added dynamically here -->
                                                        <li class="page-item active"><a href="#" class="page-link">1</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">2</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">3</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">4</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">5</a></li>
                                                        <li class="page-item"><a href="#" class="page-link">Berikutnya</a></li>
                                                    </ul>


                                                </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal HTML -->

                                    <div id="addEmployeeModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form action="{{ route('insertrekammedis') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Tambah Data Rekam Medis</h4>
                                                        <!-- error -->

                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>ID Rekam Medis*</label>
                                                            <input type="number" class="form-control" name="id_rekammedis" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_poli">ID Poli*</label>
                                                            <select class="form-control" name="id_poli" required>
                                                                <option value="POLI01">POLI01 (Poli Umum)</option>
                                                                <option value="POLI02">POLI02 (Poli Gigi)</option>
                                                                <option value="POLI03">POLI03 (Poli KIA )</option>
                                                                <option value="POLI04">POLI04 (Poli Gizi)</option>
                                                                <option value="POLI05">POLI05 (Poli MTBS)</option>
                                                                <option value="POLI06">POLI06 (Poli Imunisasi)</option>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label>NIK*</label>
                                                            <input type="number" class="form-control" name="nik" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Periksa*</label>
                                                            <input type="date" class="form-control" name="tanggal_periksa" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Riwayat Penyakit*</label>
                                                            <input type="text" class="form-control" name="riwayat_penyakit" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tekanan Darah*</label>
                                                            <input type="number" class="form-control" name="tekanan_darah" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Berat Badan*</label>
                                                            <input type="number" class="form-control" name="berat_badan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tinggi Badan*</label>
                                                            <input type="number" class="form-control" name="tinggi_badan" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                                                        <input type="submit" class="btn btn-success" value="Tambah ">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Edit Modal HTML -->
                                    <div id="editEmployeeModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form id="editForm" action="{{ route('updaterekammedis')}}" method="post">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Edit Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="form-group">
                                                            <label>ID Rekam Medis*</label>
                                                            <input type="number" class="form-control" name="id_rekammedis" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="id_poli">ID Poli*</label>
                                                            <select class="form-control" name="id_poli" required>
                                                                <option value="POLI01">POLI01 (Poli Umum)</option>
                                                                <option value="POLI02">POLI02 (Poli Gigi)</option>
                                                                <option value="POLI03">POLI03 (Poli KIA )</option>
                                                                <option value="POLI04">POLI04 (Poli Gizi)</option>
                                                                <option value="POLI05">POLI05 (Poli MTBS)</option>
                                                                <option value="POLI06">POLI06 (Poli Imunisasi)</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>NIK*</label>
                                                            <input type="number" class="form-control" name="nik" required readonly>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tanggal Periksa*</label>
                                                            <input type="date" class="form-control" name="tanggal_periksa" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Riwayat Penyakit*</label>
                                                            <input type="text" class="form-control" name="riwayat_penyakit" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tekanan Darah*</label>
                                                            <input type="number" class="form-control" name="tekanan_darah" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Berat Badan*</label>
                                                            <input type="number" class="form-control" name="berat_badan" required>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Tinggi Badan*</label>
                                                            <input type="number" class="form-control" name="tinggi_badan" required>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                                                        <input type="submit" class="btn btn-info" value="Simpan">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Delete Modal HTML -->
                                    <div id="deleteEmployeeModal" class="modal fade">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form>
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Hapus Data</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Apakah Anda Yakin Menghapus Data ini?</p>
                                                        <p class="text-warning"><small>Setelah Data Di Hapus Tidak bisa Di Batalkan</small></p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input type="button" class="btn btn-default" data-dismiss="modal" value="Batal">
                                                        <input type="submit" class="btn btn-danger" value="Hapus">
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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

                        <script>
                            $(document).ready(function() {
                                // Menangani peristiwa klik pada tombol edit
                                $('.edit').click(function() {
                                    // Mengambil nilai-nilai dari atribut data
                                    var idRekamMedis = $(this).data('rekammedis');
                                    var idPoli = $(this).data('poli');
                                    var nik = $(this).data('nik');
                                    var tanggalPeriksa = $(this).data('tanggal');
                                    var riwayatPenyakit = $(this).data('riwayat');
                                    var tekananDarah = $(this).data('tekanan');
                                    var beratBadan = $(this).data('berat');
                                    var tinggiBadan = $(this).data('tinggi');

                                    // Menempatkan nilai-nilai ke dalam form modal
                                    $('#editEmployeeModal input[name="id_rekammedis"]').val(idRekamMedis);
                                    $('#editEmployeeModal input[name="id_poli"]').val(idPoli);
                                    $('#editEmployeeModal input[name="nik"]').val(nik);
                                    $('#editEmployeeModal input[name="tanggal_periksa"]').val(tanggalPeriksa);
                                    $('#editEmployeeModal input[name="riwayat_penyakit"]').val(riwayatPenyakit);
                                    $('#editEmployeeModal input[name="tekanan_darah"]').val(tekananDarah);
                                    $('#editEmployeeModal input[name="berat_badan"]').val(beratBadan);
                                    $('#editEmployeeModal input[name="tinggi_badan"]').val(tinggiBadan);
                                });
                            });
                        </script>

                        <!-- menampilkan etri data  -->
                        <script>
                            // Jalankan kode JavaScript setelah semua elemen HTML dimuat
                            document.addEventListener("DOMContentLoaded", function() {
                                // Ambil jumlah total entri dari tabel
                                var totalEntries = document.querySelectorAll('.table-striped tbody tr').length;

                                // Update teks pada elemen hint-text
                                document.getElementById('hintText').innerHTML = 'Menampilkan <b>' + totalEntries + '</b> Dari <b>' + totalEntries + '</b> entries';
                            });
                        </script>

                        <!-- per halaman -->
                        <script>
                            var currentPageNum = 1; // Variabel untuk menyimpan nomor halaman saat ini

                            // Fungsi untuk menampilkan data sesuai dengan halaman yang dipilih
                            function showPage(pageNum) {
                                var entriesPerPage = 10; // Jumlah entri per halaman
                                var startIndex = (pageNum - 1) * entriesPerPage; // Indeks awal data untuk halaman tersebut
                                var endIndex = startIndex + entriesPerPage; // Indeks akhir data untuk halaman tersebut

                                // Semua baris tabel
                                var tableRows = document.querySelectorAll('.table-striped tbody tr');

                                // Sembunyikan semua baris
                                tableRows.forEach(function(row) {
                                    row.style.display = 'none';
                                });

                                // Tampilkan baris untuk halaman yang dipilih
                                for (var i = startIndex; i < endIndex && i < tableRows.length; i++) {
                                    tableRows[i].style.display = 'table-row';
                                }

                                currentPageNum = pageNum; // Perbarui nomor halaman saat ini
                            }

                            document.addEventListener("DOMContentLoaded", function() {
                                // Ambil jumlah total entri dari tabel
                                var totalEntries = document.querySelectorAll('.table-striped tbody tr').length;

                                // Tentukan jumlah halaman
                                var totalPages = Math.ceil(totalEntries / 10); // Misalnya, menampilkan 10 entri per halaman

                                // Dapatkan elemen ul pagination
                                var pagination = document.getElementById('pagination');

                                // Kosongkan ul pagination
                                pagination.innerHTML = '';

                                // Tambahkan tombol Sebelumnya
                                pagination.innerHTML += '<li class="page-item disabled"><a href="#" class="page-link" onclick="showPreviousPage()">Sebelumnya</a></li>';

                                // Tambahkan nomor halaman
                                for (var i = 1; i <= totalPages; i++) {
                                    // Tambahkan nomor halaman dengan kelas aktif pada halaman pertama
                                    if (i === 1) {
                                        pagination.innerHTML += '<li class="page-item active"><a href="#" class="page-link" onclick="showPage(' + i + ')">' + i + '</a></li>';
                                    } else {
                                        pagination.innerHTML += '<li class="page-item"><a href="#" class="page-link" onclick="showPage(' + i + ')">' + i + '</a></li>';
                                    }
                                }

                                // Tambahkan tombol Berikutnya
                                pagination.innerHTML += '<li class="page-item"><a href="#" class="page-link" onclick="showNextPage()">Berikutnya</a></li>';

                                // Tampilkan halaman pertama saat halaman dimuat
                                showPage(1);
                            });

                            // Fungsi untuk menampilkan halaman sebelumnya
                            function showPreviousPage() {
                                if (currentPageNum > 1) {
                                    currentPageNum--;
                                    showPage(currentPageNum);
                                }
                            }

                            // Fungsi untuk menampilkan halaman berikutnya
                            function showNextPage() {
                                var totalPages = document.querySelectorAll('.pagination .page-item').length - 2; // Mendapatkan jumlah total halaman
                                if (currentPageNum < totalPages) {
                                    currentPageNum++;
                                    showPage(currentPageNum);
                                }
                            }
                        </script>

                        <!-- pencarian -->

                        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
                        <script>
                            document.getElementById("searchButton").addEventListener("click", function() {
                                var searchTerm = document.getElementById("searchInput").value.toLowerCase(); // Mengambil nilai pencarian dan mengonversinya ke huruf kecil
                                var tableRows = document.querySelectorAll("tbody tr"); // Mengambil semua baris tabel

                                tableRows.forEach(function(row) {
                                    var idRekamMedis = row.cells[0].innerText.toLowerCase(); // Mengambil nilai ID Rekam Medis dari setiap baris tabel dan mengonversinya ke huruf kecil
                                    if (idRekamMedis.includes(searchTerm)) { // Memeriksa apakah nilai ID Rekam Medis mengandung kata kunci pencarian
                                        row.style.display = ""; // Menampilkan baris jika cocok
                                    } else {
                                        row.style.display = "none"; // Menyembunyikan baris jika tidak cocok
                                    }
                                });
                            });
                        </script>



</body>

</html>