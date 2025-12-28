<header id="header" class="top">
    <div class="container d-flex align-items-center">
        <h1 class="logo me-auto"><a href="index.html">Trashic</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html" class="logo me-auto"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

        <nav id="navbar" class="navbar order-last order-lg-0">
            <ul>
                <li><a class="nav-link scrollto {{ request()->is('home') ? 'active' : '' }}" href=" ">Home</a></li>
                <li><a class="nav-link scrollto {{ request()->is('menu') ? 'active' : '' }}" href="{{ ('/menu') }}">About</a></li>
                {{-- <li><a class="nav-link scrollto {{ request()->is('Tim') ? 'active' : '' }}" href="{{ ('/Tim') }}">Tim</a></li> --}}
                <li class="dropdown"><a href="#"><span>Menu</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{route('daftar_harga_sampah.index')}}">Harga Sampah</a></li>
                        <li><a href="{{route('setoran.create')}}">Setor Sampah</a></li>
                        <li><a href="{{route('penarikan.create')}}">Tarik Saldo</a></li>
                        <li><a href="{{route('transaksiku')}}">Daftar Transaksi</a></li>
                        <li><a href="{{url('/news')}}">Berita</a></li>
                    </ul>
                </li>
                
                <li class="dropdown"><a href="#"><span>TCorner</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{route('scoreboard.index')}}">Scoreboard</a></li>
                        @auth
                        <li><a href="{{route('hadiah.list')}}">Hadiah</a></li>
                        <li><a href="{{route('penukaran.log', (!empty(Auth::user()->rekening[0]) ? Auth::user()->rekening[0]->id : 0 ))}}">Log Penukaran</a></li>
                        @endauth
                    </ul>
                </li>
                @auth
                <li class="dropdown"><a href="#"><img src="{{ asset('private/assets/images/faces/face8.jpg') }}" alt="profile picture" class="rounded-circle img-fluid" style="height: 30px"><span>{{Auth::user()->name}}</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('hadiah.list') }}"><i class="bi bi-coin icon-md text-warning"><span> : {{ (!empty(Auth::user()->rekening[0]->coin))? Auth::user()->rekening[0]->coin : '0' }} TCoin</span></i></a></li>
                        <li><a href="{{ route('scoreboard.index') }}"><i class="bi bi-star-fill icon-md text-warning"><span> : {{ (!empty(Auth::user()->rekening[0]->score))? Auth::user()->rekening[0]->score : '0' }} pts</span></i></a></li>
                        <li><a href="#"><i class="bi bi-wallet2 icon-md text-success"><span> : Rp. {{ (!empty(Auth::user()->rekening[0]->saldo))? number_format(Auth::user()->rekening[0]->saldo, 0, ',', '.') : '0' }}</span></i></a></li>
                        {{-- <li class="dropdown"><a href="#">Profile</a>
                        <ul>
                            <li><a href="#"></a></li>
                        </ul>
                        </li> --}}
                        @if (Auth::user()->role != "pelanggan")
                            <li><a href="{{route('dashboard')}}">Dashboard</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
                @endauth
            </ul>
            <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

        @guest
        <a href="{{ ('/login') }}" class="appointment-btn scrollto"><span class="d-none d-md-inline">Log</span> in</a>
        @endguest
    </div>
</header><!-- End Header -->