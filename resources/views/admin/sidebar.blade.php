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
                            Dashboard
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
                 
            </div>
        </aside>