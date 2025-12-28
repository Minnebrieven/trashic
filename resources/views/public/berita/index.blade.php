@extends('public.index')
@section('content')
    <section id="news" class="news section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Berita</h2>
                <p>kumpulan berita.</p>
            </div>

            <div class="row">
                @php
                    $contentCounter = 0;
                @endphp
                @foreach ($beritaArray as $berita)
                    @if ($contentCounter == 0 || $contentCounter == 3)
                        <div class="col-md-12 mb-3">
                            <a href="{{url('/news', $berita->id)}}" style="all:unset">
                                <div class="card text-bg-dark">
                                    @empty($berita->foto)
                                    <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="card-img"/>
                                    @else
                                    <img src="{{ asset('private/assets/img') }}/{{ $berita->foto }}" class="card-img"/>
                                    @endempty
                                    <div class="card-img-overlay">
                                    <h5 class="card-title">{{ $berita->judul }}</h5>
                                    <p class="card-text"><small>{{ $berita->created_at->diffForHumans() }}</small></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @php
                            $contentCounter = 0;
                        @endphp
                    @elseif ($contentCounter == 1 || $contentCounter == 2)
                    <div class="col-md-6 mb-3">
                        <a href="{{url('/news', $berita->id)}}" style="all:unset">
                        <div class="card text-bg-dark">
                            @empty($berita->foto)
                            <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="card-img"/>
                            @else
                            <img src="{{ asset('private/assets/img') }}/{{ $berita->foto }}" class="card-img"/>
                            @endempty
                            <div class="card-img-overlay">
                            <h5 class="card-title">{{ $berita->judul }}</h5>
                            <p class="card-text"><small>{{ $berita->created_at->diffForHumans() }}</small></p>
                            </div>
                        </div>
                        </a>
                    </div>
                    @endif
                @php
                    $contentCounter++;
                @endphp
                @endforeach
            </div>
    </section>
@endsection
