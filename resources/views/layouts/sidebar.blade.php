<div class="sidenav-header">
    <i class="fas fa-times p-3 cursor-pointer text-dark opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
        aria-hidden="true" id="iconSidenav"></i>
    <a class="navbar-brand px-4 py-3 m-0" href=" https://demos.creative-tim.com/material-dashboard/pages/dashboard "
        target="_blank">
        <img src="../assets/img/logo-ct-dark.png" class="navbar-brand-img" width="26" height="26" alt="main_logo" />
        <span class="ms-1 text-sm text-dark">Manager</span>
    </a>
</div>
<hr class="horizontal dark mt-0 mb-2" />
<div class="collapse navbar-collapse w-auto" id="sidenav-collapse-main">
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link active bg-gradient-dark text-white" href="">
                <i class="material-symbols-rounded opacity-5">Home</i>
                <span class="nav-link-text ms-1">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-dark" href="{{ route(name: 'dashboard.table') }}">
                <i class="material-symbols-rounded opacity-5">Group</i>
                <span class="nav-link-text ms-1">Anggota</span>
            </a>
        </li>
        <!--Start SUrat-->
        <li class="nav-item">
            <a class="nav-link text-dark d-flex justify-content-between" data-bs-toggle="collapse" href="#submenuSurat"
                role="button" aria-expanded="false">
                <div>
                    <i class="material-symbols-rounded opacity-5">receipt_long</i>
                    <span class="nav-link-text ms-1">Surat</span>
                </div>
            </a>
            <div class="collapse" id="submenuSurat">
                <ul class="nav flex-column ms-3">
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route(name: 'suratMasuk.index') }}">
                            <i class="material-symbols-rounded opacity-5">inbox</i>
                            <span class="ms-1">Surat Masuk</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-dark" href="{{ route(name: 'suratKeluar.index') }}">
                            <i class="material-symbols-rounded opacity-5">send</i>
                            <span class="ms-1">Surat Keluar</span>
                        </a>
                    </li>
                </ul>
            </div>
        </li>
        <!--end Surat-->
        <li class="nav-item">
            <a class="nav-link text-dark" href="">
                <i class="material-symbols-rounded opacity-5">Person</i>
                <span class="nav-link-text ms-1">Karyawan</span>
            </a>
        </li>
    </ul>
</div>