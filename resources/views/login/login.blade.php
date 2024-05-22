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

    </div>
    <div class="container" id="container">
        <div class="form-container sign-up">
            <form id="form-register" action="{{ route('register') }}" method="post">
                @csrf
                <h1 style="margin-bottom: 10px;">Lupa Sandi</h1>            
                <input type="number" name="nip" placeholder="NIP">
                <input type="password" name="kata_sandi" id="kata_sandi" placeholder="Kata Sandi Baru">
                <input type="password" name="konfirmasi_kata_sandi" id="konfirmasi_kata_sandi" placeholder="Konfirmasi Kata Sandi">
                <p id="pesan_konfirmasi" style="color: red; display: none;">Konfirmasi kata sandi tidak cocok!</p>
                <button type="submit" id="submit_button" disabled>Konfirmasi</button>                
            </form>
            
        </div>
        <div class="form-container sign-in">
            <form action="{{ route('login')}}" method="post">
                @csrf
                <h1 style="margin-bottom: 25px;">Masuk</h1>
                <span>Masuk Dengan NIP dan Kata Sandi</span>
                <input type="number" placeholder="NIP (Nomor Induk Pegawai)" id="nip" name="nip">
                <input type="password" placeholder="Kata Sandi" id="password" name="password"> <!-- Perubahan pada atribut name di sini -->
                <input type="submit" id="submit" value="Masuk" style="background-color: #37517e; color: white;"></input>

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
                    <p>Klik "Lupa Kata Sandi" di bawah </p>
                    <button class="hidden" id="register">Lupa Sandi</button>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script>
                document.getElementById("konfirmasi_kata_sandi").addEventListener("keyup", function() {
                    var kataSandiBaru = document.getElementById("kata_sandi").value;
                    var konfirmasiKataSandi = this.value;
                    var submitButton = document.getElementById("submit_button");
                    var pesanKonfirmasi = document.getElementById("pesan_konfirmasi");

                    if (kataSandiBaru === konfirmasiKataSandi) {
                        submitButton.disabled = false;
                        pesanKonfirmasi.style.display = "none";
                    } else {
                        submitButton.disabled = true;
                        pesanKonfirmasi.style.display = "block";
                    }
                });
            </script>

</body>

</html>