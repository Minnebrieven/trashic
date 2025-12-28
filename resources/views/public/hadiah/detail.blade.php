@extends('public.index')
@section('content')
    <section id="detailSetoran" class="detailSetoran section-bg">
        <div class="container">

            <div class="section-title">
                <h2>Detail Transaksi</h2>
                <p>informasi lebih lanjut tentang transaksi nasabah.</p>
            </div>

            <div class="row">
                <div class="card" style="width:auto">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6 mb-3 mb-3">
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-tags icon-md text-{{ !empty($logTransaksi->setoran_id) ? 'success' : 'warning' }}" style="font-size: 2rem"></i>
                                    &nbsp;&nbsp;
                                    <div class="row ml-1">
                                        <div class="col-12">
                                            <h4 class="mb-0"> {{ !empty($logTransaksi->setoran_id) ? 'Setor' : 'Tarik' }}</h4>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted mb-0">Tipe Transaksi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-patch-{{ $logTransaksi->status == 'diterima' ? 'check icon-md text-success' : ($logTransaksi->status == 'ditolak' ? 'exclamation icon-md text-danger' : 'exclamation icon-md text-warning') }}" style="font-size: 2rem"></i>
                                    &nbsp;&nbsp;
                                    <div class="row ml-1">
                                        <div class="col-12">
                                            <h4 class="mb-0">
                                                <span class="badge {{ $logTransaksi->status == 'diterima' ? 'bg-success' : ($logTransaksi->status == 'ditolak' ? 'bg-danger' : 'bg-warning') }}">{{ ucwords($logTransaksi->status) }}</span>
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted mb-0">Status Transaksi</small>
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
                                            <h4 class="mb-0"> {{ $logTransaksi->created_at->toFormattedDateString() }}</h4>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted mb-0">Tanggal Transaksi</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-3">
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-cash-coin icon-md text-success {{-- {{ $logTransaksi->tipe_transaksi == 'setor' ? 'success' : 'danger' }} --}}" style="font-size: 2rem"></i>
                                    &nbsp;&nbsp;
                                    <div class="row ml-1">
                                        <div class="col-12">
                                            <h4 class="mb-0">
                                                @if (!empty($logTransaksi->setoran_id)) Rp. {{ number_format($logTransaksi->setoran->total_harga, 0, ',', '.') }}
                                                @elseif (!empty($logTransaksi->penarikan_id)) Rp. {{ number_format($logTransaksi->penarikan->total_harga, 0, ',', '.') }}
                                                @endif
                                            </h4>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted mb-0">Total Harga</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (!empty($logTransaksi->penarikan_id))
                            <div class="col-6 mb-3">
                                <div class="d-flex flex-row align-items-center">
                                    <i class="bi bi-credit-card icon-md text-info" style="font-size: 2rem"></i>
                                    &nbsp;&nbsp;
                                    <div class="row ml-1">
                                        <div class="col-12">
                                            <h4 class="mb-0"> {{ ucwords($logTransaksi->penarikan->metode_pembayaran->nama) }} </h4>
                                        </div>
                                        <div class="col-12">
                                            <small class="text-muted mb-0">Metode Pembayaran</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        <br>
                        @if (!empty($logTransaksi->setoran_id))
                        <div class="row">
                            <div class="col-12">
                                <h3>Tabel Item Transaksi</h3>
                            </div>
                            <div class="col-12">
                                @php
                                    $arrayTitle = ['Sampah', 'Jumlah', 'Harga Satuan', 'Total'];
                                @endphp
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            @foreach ($arrayTitle as $title)
                                                <th>{{ $title }}</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($logTransaksi->setoran->detail_setoran as $detailSetoran)
                                            <tr>
                                                <td>{{ ucfirst($detailSetoran->sampah->nama) }}</td>
                                                <td>{{ $detailSetoran->jumlah }}</td>
                                                <td>Rp.
                                                    {{ number_format($detailSetoran->sampah->harga, 0, ',', '.') }}/{{ $detailSetoran->sampah->satuan }}
                                                </td>
                                                <td>Rp.
                                                    {{ number_format($detailSetoran->jumlah * $detailSetoran->sampah->harga, 0, ',', '.') }}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
    </section>
@endsection
