@extends('public.index')
@section('content')
    <section id="jualBeliSampah" class="jualBeliSampah section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Daftar Penukaran Hadiah</h2>
                <p>list transaksi penukaran hadiah.</p>
            </div>

            <div class="row">
                @if ($arrayPenukaran->isNotEmpty())
                @foreach ($arrayPenukaran as $penukaran)
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">&nbsp;
                                    <span class="text-body-secondary"> {{ $penukaran->created_at->toFormattedDateString() }}
                                        &nbsp;</span>
                                    <span class="badge @if ($penukaran->status == 'diterima') bg-success @elseif ($penukaran->status == 'ditolak') bg-danger @else bg-warning @endif">
                                        {{ $penukaran->status }} </span>
                                </h5>
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-gift text-info" style="font-size: 2rem"></i> &nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">{{ $penukaran->hadiah->nama }}</h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Hadiah</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-coin icon-md text-danger" style="font-size: 2rem"></i> &nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">- {{ $penukaran->hadiah->coin_diperlukan }} TC</h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Coin Digunakan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text mt-2 float-end">
                                    <small class="text-body-secondary">
                                        <a href="{{route('penukaran.detail', $penukaran->id)}}">Lihat Detail Penukaran</a>
                                    </small>
                                </p>
                            </div>
                        </div>
                @endforeach
                @else
                <small class="text-center text-body-secondary">Belum ada transaksi</small>
                @endif
            </div>
    </section>
@endsection
