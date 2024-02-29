<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/styless.css') }}">
    <title>Masuk</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form>
                <h1 style="margin-bottom: 10px;">Buat Akun</h1>
                <span>Isi Formulir Tersebut</span>
                <input type="NIP" placeholder="NIP">
                <input type="Nama" placeholder="Nama">
                <input type="Email" placeholder="Email">
                <input type="date" id="tanggal_lahir" name="tanggal lahir">
                <input type="Jenis_Kelamin" placeholder="Jenis Kelamin">
                <input type="Jabatan" placeholder="Jabatan">
                <input type="password" placeholder="Password">
                <button>Daftar</button>
            </form>
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login')}}" method="post">
                @csrf
                <h1 style="margin-bottom: 25px;">Masuk</h1>
                <span>Masuk Dengan NIP dan Kata Sandi</span>
                <input type="NIP (Nomor Induk Pegawai) " placeholder="NIP (Nomor Induk Pegawai) ">
                <input type="password" placeholder="Kata Sandi">
                <a href="#">Lupa Password?</a>
                <button href="">Masuk</button>
            </form>
        </div>
        <div class="toggle-container">
            <div class="toggle">
                <div class="toggle-panel toggle-left">
                    <h1>Selamat Datang</h1>
                    <p>Sudah Punya Akun </p>
                    <button class="hidden" id="login">Masuk</button>
                </div>
                <div class="toggle-panel toggle-right">
                    <h1>Selamat Datang</h1>
                    <p>Isi pendaftaran dengan informasi yang diperlukan seperti NIP, Nama, Tanggal Lahir,Jenis Kelamin,Jabatan,Email,Kata Sandi yang aman.</p>
                    <button class="hidden" id="register">Buat Akun</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>