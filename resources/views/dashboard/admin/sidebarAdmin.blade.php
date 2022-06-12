<div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link {{Request::is('dashboard') ? 'active' : ''}}" aria-current="page" href="/dashboard">
              <span data-feather="home" class="align-text-bottom"></span>
              Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('barang') ? 'active' : ''}}" href="/barang">
              <span data-feather="file-plus" class="align-text-bottom"></span>
              Tambah Produk
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{Request::is('kategori') ? 'active' : ''}}" href="/kategori">
              <span data-feather="file-plus" class="align-text-bottom"></span>
              Tambah Kategori
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="">
              <span data-feather="percent" class="align-text-bottom"></span>
              Tambah Diskon
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <span data-feather="users" class="align-text-bottom"></span>
               Daftar Transaksi
            </a>
          </li>
        </ul>
      </div>
    </nav>