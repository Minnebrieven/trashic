@extends('public.index')
@section('content')
    <section id="detailSetoran" class="detailSetoran section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Detail Penukaran Hadiah</h2>
                <p>informasi lebih lanjut tentang transaksi penukaran hadiah.</p>
            </div>

            <div class="row">
                <div class="card" style="width:auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="thumbnail">
                                    @empty($detailPenukaran->hadiah->gambar)
                                    <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="card-img" style="display:block; height: 200px;"/>
                                    @else
                                    <img src="{{ asset('private/assets/img') }}/{{ $detailPenukaran->hadiah->gambar }}" class="card-img" style="display:block; height: 200px;">
                                    @endempty
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="row mt-3">
                                    <div class="col-6 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-gift icon-md text-info" style="font-size: 2rem"></i>
                                            &nbsp;&nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0"> {{ $detailPenukaran->hadiah->nama }}</h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Hadiah</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-patch-{{ $detailPenukaran->status == 'diterima' ? 'check icon-md text-success' : ($detailPenukaran->status == 'ditolak' ? 'exclamation icon-md text-danger' : 'exclamation icon-md text-warning') }}" style="font-size: 2rem"></i>
                                            &nbsp;&nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">
                                                        <span class="badge {{ $detailPenukaran->status == 'diterima' ? 'bg-success' : ($detailPenukaran->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">{{ ucwords($detailPenukaran->status) }}</span>
                                                    </h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Status Penukaran</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-calendar2-week icon-md text-info" style="font-size: 2rem"></i>
                                            &nbsp;&nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0"> {{ $detailPenukaran->created_at->toFormattedDateString() }}</h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Tanggal Penukaran</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-coin icon-md text-danger" style="font-size: 2rem"></i>
                                            &nbsp;&nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">
                                                        - {{ number_format($detailPenukaran->hadiah->coin_diperlukan, 0, ',', '.') }} TC
                                                    </h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Coin Digunakan</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>
@endsection
