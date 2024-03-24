<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{ asset('assets/css/styless.css') }}">
    <title>Masuk</title>
</head>

<body>

    <div class="container" id="container">
        <div class="form-container sign-up">
            <form action="{{ route('register') }}" method="post">
                @csrf
                <h1 style="margin-bottom: 10px;">Buat Akun</h1>
                <span>Isi Formulir Tersebut</span>
                <input type="number" name="nip" placeholder="NIP">
                <input type="text" name="nama" placeholder="Nama">
                <input type="email" name="email" placeholder="Email">
                <input type="date" id="tanggal_lahir" name="tanggal_lahir">
                <select name="jenis_kelamin" class="form-select">
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <input type="text" name="jabatan" placeholder="Jabatan">
                <input type="password" name="kata_sandi" placeholder="Kata Sandi">
                <button type="submit">Daftar</button>
            </form>

        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login')}}" method="post">
                @csrf
                <h1 style="margin-bottom: 25px;">Masuk</h1>
                <span>Masuk Dengan NIP dan Kata Sandi</span>
                <input type="number" placeholder="NIP (Nomor Induk Pegawai)" id="nip" name="nip">
                <input type="password" placeholder="Kata Sandi" id="password" name="password"> <!-- Perubahan pada atribut name di sini -->
                <a href="">Lupa Password?</a>
                <input type="submit" id="submit" value="masuk"></input>

                @if(session('errorlogin'))
                <span class="text-danger">
                    {{session('errorlogin')}}
                    @endif
                </span>
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