@extends('public.index')
@section('content')
    <section id="news" class="news section-bg">
        <div class="container">

            <div class="section-title">
                <h2>{{$berita->judul}}</h2>
                <p>{{$berita->kategori_berita->nama}}</p>
                &nbsp;
                <small>{{ $berita->created_at->diffForHumans() }}</small>
            </div>

            <div class="row">
                @empty($berita->foto)
                    <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="img-fluid"/>
                    @else
                    <img src="{{ asset('private/assets/img') }}/{{ $berita->foto }}" class="img-fluid"/>
                    @endempty
                <div class="col-md-12 mt-3">
                    <p>{{$berita->deskripsi}}</p>
                    <br>
                    <small>Source : <a href="http://{{$berita->url}}" target="_blank">Sumber {{$berita->judul}}</a></small>
                </div>
            </div>
    </section>
@endsection
