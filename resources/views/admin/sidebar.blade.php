<aside id="sidebar" class="js-sidebar">
    <!-- Content For Sidebar -->
    <div class="h-100" style="background-color:#37517e ;">
        <div class="sidebar-logo">
            <img src="{{ asset('assets/img/renaldi.png') }}" width="50px">
            <a style="margin-left: 10px; color: white;">PUSLINE</a>
        </div>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a href="{{ ('dashboard')}}" class="sidebar-link">
                    <i class="fa-solid fa-list pe-2"></i>
                    Beranda
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('data-pasien')}}" class="sidebar-link">
                    <i class="fa-solid fa-user-injured pe-2"></i>
                    Data Pasien
                </a>
            <li class="sidebar-item">
                <a href="{{ route('rekam-medis')}}" class="sidebar-link">
                    <i class="fa-solid fa-notes-medical pe-2"></i>
                    Rekam Medis
                </a>
            <li class="sidebar-item">
            <li class="sidebar-item">
                <a href="{{ route ('pendaftaran')}}" class="sidebar-link">
                    <i class="fa-solid fa-ticket-alt pe-2"></i>
                    Antrian
                </a>
            </li>
        </ul>
        <li class="sidebar-item">
            <a href="{{ ('artikel')}}" class="sidebar-link">
                <i class="fa-solid fa-newspaper pe-2"></i>
                Artikel
            </a>
            </ul>
            <li class="sidebar-item">
    <a href="#" class="sidebar-link" id="logout-button">
        <i class="fa-solid fa-sign-out-alt pe-2"></i>
        Keluar
    </a>
</li>

<!-- Modal konfirmasi -->
<div class="modal fade" id="confirmLogoutModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin keluar?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <a href="{{ ('logout') }}" class="btn btn-danger" id="confirmLogoutButton">Keluar</a>
            </div>
        </div>
    </div>
</div>

<script>
    // Mendapatkan tombol "Keluar"
    var logoutButton = document.getElementById('logout-button');
    var confirmLogoutButton = document.getElementById('confirmLogoutButton');

    // Menambahkan event listener untuk menampilkan modal konfirmasi ketika tombol "Keluar" diklik
    logoutButton.addEventListener('click', function(event) {
        event.preventDefault(); // Mencegah perilaku default dari link

        // Menampilkan modal konfirmasi
        var confirmModal = new bootstrap.Modal(document.getElementById('confirmLogoutModal'));
        confirmModal.show();
    });

    // Menambahkan event listener untuk mengarahkan ke halaman logout saat tombol "Keluar" di modal diklik
    confirmLogoutButton.addEventListener('click', function(event) {
        confirmModal.hide(); // Menyembunyikan modal konfirmasi
        window.location.href = "{{ ('logout') }}"; // Mengarahkan ke halaman logout
    });
</script>




    </div>
</aside>