        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
            <ul class="nav">
              <li class="nav-item nav-category">
                <span class="nav-link">Dashboard</span>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{url('dashboard')}}">
                  <span class="menu-title">Dashboard</span>
                  <i class="icon-screen-desktop menu-icon"></i>
                </a>
              </li>
              <li class="nav-item nav-category"><span class="nav-link">Data</span></li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('sampah.index')}}">
                  <span class="menu-title">Sampah</span>
                  <i class="bi bi-recycle menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('transaksi.index')}}">
                  <span class="menu-title">Transaksi</span>
                  <i class="bi bi-receipt-cutoff menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('berita.index')}}">
                  <span class="menu-title">Berita</span>
                  <i class="bi bi-newspaper menu-icon"></i>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a class="nav-link" href="{{route('quiz.index')}}">
                  <span class="menu-title">Quiz</span>
                  <i class="bi bi-newspaper menu-icon"></i>
                </a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link" href="{{route('hadiah.index')}}">
                  <span class="menu-title">Hadiah</span>
                  <i class="bi bi-newspaper menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('penukaran.index')}}">
                  <span class="menu-title">Penukaran</span>
                  <i class="bi bi-newspaper menu-icon"></i>
                </a>
              </li>
              <li class="nav-item nav-category"><span class="nav-link">Master Data</span></li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('jenissampah.index')}}">
                  <span class="menu-title">Jenis Sampah</span>
                  <i class="icon-grid menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('kategorisampah.index')}}">
                  <span class="menu-title">Kategori Sampah</span>
                  <i class="icon-grid menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('metode_pembayaran.index')}}">
                  <span class="menu-title">Metode Pembayaran</span>
                  <i class="icon-grid menu-icon"></i>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('kategoriberita.index')}}">
                  <span class="menu-title">Kategori Berita</span>
                  <i class="icon-grid menu-icon"></i>
                </a>
              </li>
              <li class="nav-item nav-category"><span class="nav-link">Back to Main Page</span></li>
              <li class="nav-item">
                <a class="btn btn-primary btn-block" href="{{url('/home')}}">
                <i class="bi bi-arrow-left-circle"></i> Kembali 
                </a>
              </li>
            </ul>
          </nav>
        <!-- partial -->