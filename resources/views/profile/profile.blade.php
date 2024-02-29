<div class="container-xl px-4 mt-4">
    <!-- Account page navigation-->
    <title>Profil</title>
    <link href="{{ asset('assets/img/image 1464') }}.png" rel="icon">
    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">


    <!-- <hr class="mt-0 mb-4"> -->
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Gambar Profil</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                    <!-- Profile picture help block-->
                    <div class="small font-italic text-muted mb-4">JPG or PNG no larger than 5 MB</div>
                    <!-- Profile picture upload button-->
                    <button class="btn btn-primary" type="button">Upload Gambar</button>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Detail Akun</div>
                <div class="card-body">
                    <form>
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputUsername">NIP (Nomor Induk Pegawai)</label>
                            <input class="form-control" id="inputUsername" type="number" placeholder="NIP" value="">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Nama</label>
                                <input class="form-control" id="inputFirstName" type="text" placeholder="Nama" value="">
                            </div>
                        </div>
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Email</label>
                            <input class="form-control" id="inputPhone" type="email" placeholder="Email" value="">
                        </div>
                        <!-- Form Group (birthday)-->
                        <!-- Form Row        -->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (organization name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputOrgName">Tanggal Lahir</label>
                                <input class="form-control" id="inputOrgName" type="date" placeholder="Tanggal Lahir" value="">
                            </div>

                            <!-- Form Group (location)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLocation">Jenis Kelamin</label>
                                <select class="form-control" id="inputLocation">
                                    <option value="lainnya">Lainnya</option>
                                    <option value="laki-laki">Laki-laki</option>
                                    <option value="perempuan">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <!-- Form Group (email address)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputEmailAddress">Jabatan</label>
                            <input class="form-control" id="inputEmailAddress" type="email" placeholder="Jabatan" value="">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">


                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="button">Edit Data</button>
                        <a class="btn btn-primary" href="{{ url()->previous() }}">Kembali</a>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>