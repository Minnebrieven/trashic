@extends('public.index')
@section('content')
<!-- ======= Services Section ======= -->
<section id="menu" class="menu">
    <div class="container">

        <div class="section-title">
            <h2>Welcome</h2>
            <p>Mari bersama-sama menjelajahi dunia literasi sampah untuk menciptakan perubahan positif dalam kehidupan sehari-hari kita. Di sini, kami berbagi pengetahuan, ide, dan inspirasi untuk membantu Anda memahami peran penting kita dalam menjaga kebersihan dan keberlanjutan bumi.</p>
            <br>
            <h2>Sampah</h2>
            <p>
                Sampah merupakan permasalahan yang sangat umum yang terjadi di masyarakat global.
                Sampah merupakan material sisa hasil aktivitas yang dibuang sebagai hasil dari proses produksi, baik itu dalam industri maupun rumah tangga.
                Dapat dikatakan sampah adalah sesuatu yang tidak diinginkan oleh manusia setelah proses dan penggunaannya berakhir.
            </p>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6">
                <a href="{{url('/organik')}}" style="all:unset">
                <div class="icon-box">
                    <div class="icon"><i class="fas fa-trash-alt"></i></div>
                    <h4>
                        <a class="organik" href="#">Jenis Sampah Organik</a>
                    </h4>
                    <p>Klik di sini untuk mencari tahu.</p>
                </div>
                </a>    
            </div>

            <div class="col-lg-6 col-md-6">
                <a href="{{url('/nonorganik')}}" style="all:unset">
                <div class="icon-box">
                    <div class="icon"><i class="fas fa-trash"></i></div>
                    <h4>
                        <a class="nonorganik" href="#">Jenis Sampah Non Organik</a>
                    </h4>
                    <p>Informasi terbaru seputar sampah.</p>
                </div>
                </a>
            </div>

            <div class="col-lg-6 col-md-6">
                <a href="{{route('setoran.create')}}" style="all:unset">
                <div class="icon-box">
                    <div class="icon"><i class="fas fa-dollar-sign"></i></div>
                    <h4><a href="">Penjualan</a></h4>
                    <p>Informasi penjualan sampah dll.</p>
                </div>
                </a>
            </div>

            <div class="col-lg-6 col-md-6">
                <a href="{{url('/news')}}" style="all:unset">
                <div class="icon-box">
                    <div class="icon"><i class="fas fa-book-reader"></i></div>
                    <h4><a href="">Berita</a></h4>
                    <p>Berita terbaru</p>
                </div>
                </a>
            </div>
        </div>
    </div>
</section><!-- End Services Section -->
@endsection