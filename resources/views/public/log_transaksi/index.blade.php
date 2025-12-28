@extends('public.index')
@section('content')
    <section id="jualBeliSampah" class="jualBeliSampah section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Daftar Transaksi</h2>
                <p>list transaksi nasabah.</p>
            </div>

            <div class="row">
                @if ($logTransaksi->isNotEmpty())
                @foreach ($logTransaksi as $trk)
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">&nbsp;
                                    <span class="text-body-secondary"> {{ $trk->created_at->toFormattedDateString() }}
                                        &nbsp;</span>
                                    <span class="badge @if ($trk->status == 'diterima') bg-success @elseif ($trk->status == 'ditolak') bg-danger @else bg-warning @endif">
                                        {{ $trk->status }} </span>
                                </h5>
                                <div class="row mt-3">
                                    <div class="col-md-6 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <i class="bi bi-tags text-info" style="font-size: 2rem"></i> &nbsp;
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">@if (!empty($trk->setoran_id)) Setor @else Tarik @endif</h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Tipe Transaksi</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            @if (!empty($trk->setoran_id))
                                            <i class="bi bi-cash-coin icon-md text-success" style="font-size: 2rem"></i> &nbsp;
                                            @else
                                            <i class="bi bi-cash-coin icon-md text-danger" style="font-size: 2rem"></i> &nbsp;
                                            @endif
                                            <div class="row ml-1">
                                                <div class="col-12">
                                                    <h4 class="mb-0">@if (!empty($trk->setoran_id)) + Rp. {{ number_format($trk->setoran->total_harga, 0, ',', '.') }} @elseif (!empty($trk->penarikan_id)) - Rp. {{ number_format($trk->penarikan->total_harga, 0, ',', '.') }} @else 0 @endif </h4>
                                                </div>
                                                <div class="col-12">
                                                    <small class="text-muted mb-0">Total Harga</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <p class="card-text mt-2 float-end">
                                    <small class="text-body-secondary">
                                        <a href="@if (!empty($trk->setoran_id)) {{route('transaksiku.show.setoran', $trk->id)}} @elseif(!empty($trk->penarikan_id)) {{route('transaksiku.show.penarikan', $trk->id)}} @else # @endif">Lihat Detail Transaksi</a>
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
