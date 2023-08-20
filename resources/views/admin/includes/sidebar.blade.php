   <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-icon rotate-n-15">
                    {{-- <i class="fas fa-laugh-wink"></i> --}}
                </div>
                <div class="sidebar-brand-text mx-3">Edza Second Store<sup></sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Tables -->
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kategori') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Kategori</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('produk') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Produk</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pesanan') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Pesanan</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('slider') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Slider</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('metode') }}">
                    <i class="fas fa-fw fa-table"></i>
                    <span>Info Rekening</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->