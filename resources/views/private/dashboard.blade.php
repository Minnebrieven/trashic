@extends('private.index')
@section('content')
    <script>
        var doughnutPieData = {
            datasets: [{
                data: [
                @foreach ($chart as $key => $ch) 
                    @if ($key != "total")
                    '{{ $ch }}', 
                    @endif
                @endforeach],
                backgroundColor: [
                    '#ffca00',
                    '#38ce3c',
                    '#ff4d6b'
                ],
                borderColor: [
                    '#ffca00',
                    '#38ce3c',
                    '#ff4d6b'
                ],
            }],

            // These labels appear in the legend and in the tooltips when hovering different arcs
            labels: [@foreach ($chart as $key) '{{ $key }}', @endforeach]
        };
        var doughnutPieOptions = {
            cutoutPercentage: 75,
            animationEasing: "easeOutBounce",
            animateRotate: true,
            animateScale: false,
            responsive: true,
            maintainAspectRatio: true,
            showScale: true,
            legend: {
                display: false
            },
            layout: {
                padding: {
                    left: 0,
                    right: 0,
                    top: 0,
                    bottom: 0
                }
            }
        };

        document.addEventListener("DOMContentLoaded", () => {
            new Chart(document.querySelector('#doughnutChart'), {
                type: 'doughnut',
                data: doughnutPieData,
                options: doughnutPieOptions
            });
        });
    </script>
    <!-- Quick Action Toolbar Starts-->
    <br>
    <br>
    <div class="row quick-action-toolbar">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Quick Actions</h5>
                </div>
                <div class="d-md-flex row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button class="btn px-0" {{ Auth::user()->role != 'admin'? 'disabled':'' }}> <i class="icon-user mr-2"></i>Aktivasi User</button>
                    </div>
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button onclick="location.href = '{{ route('sampah.create') }}';" class="btn px-0" {{ Auth::user()->role == 'admin'? '':'disabled' }}><i
                                class="icon-docs mr-2"></i>Tambah Sampah</button>
                    </div>
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button onclick="location.href = '{{ route('transaksi.create') }}';" class="btn px-0" {{ Auth::user()->role == 'admin' || 'manager' || 'staff' ? '':'disabled' }}><i
                                class="icon-folder mr-2"></i>Konfirmasi Transaksi</button>
                    </div>
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <button onclick="location.href = '{{ route('berita.create') }}';" class="btn px-0" {{ Auth::user()->role == 'admin' || 'manager' || 'staff'? '':'disabled' }}><i
                                class="icon-book-open mr-2"></i>Tambah Berita</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Action Toolbar Ends-->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-sm-flex align-items-baseline report-summary-header">
                                <h5 class="font-weight-semibold">Report Summary</h5>
                            </div>
                        </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                        <div class=" col-md-2 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Total Transaksi Setor</span>
                                <h4>Rp. {{ number_format($reportSummary['totalHargaTransaksiSetor'], 2, ',', '.') }}</h4>
                                
                            </div>
                            <div class="inner-card-icon bg-danger">
                                <i class="icon-chart"></i>
                            </div>
                        </div>
                        <div class=" col-md-2 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Total Transaksi Penarikan</span>
                                <h4>Rp. {{ number_format($reportSummary['totalHargaTransaksiTarik'], 2, ',', '.') }}</h4>
                            </div>
                            <div class="inner-card-icon bg-success">
                                <i class="icon-rocket"></i>
                            </div>
                        </div>
                        <div class="col-md-2 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Transaksi Belum Diterima</span>
                                <h4>{{ $reportSummary['jumlahTransaksiBelumDiterima'] }}</h4>
                            </div>
                            <div class="inner-card-icon bg-danger">
                                <i class="icon-briefcase"></i>
                            </div>
                        </div>
                        <div class="col-md-2 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Transaksi Diterima</span>
                                <h4>{{ $reportSummary['jumlahTransaksiDiterima'] }}</h4>
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-globe-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-2 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">Transaksi Ditolak</span>
                                <h4>{{ $reportSummary['jumlahTransaksiDitolak'] }}</h4>
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-globe-alt"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Sampah Terkumpul Berdasarkan Jenis</h4>
                    <div class="aligner-wrapper">
                        <div class="chartjs-size-monitor">
                            <div class="chartjs-size-monitor-expand">
                                <div class=""></div>
                            </div>
                            <div class="chartjs-size-monitor-shrink">
                                <div class=""></div>
                            </div>
                        </div>
                        <canvas id="doughnutChart" height="210"></canvas>
                        <div class="wrapper d-flex flex-column justify-content-center absolute absolute-center">
                            <h2 class="text-center mb-0 font-weight-bold">{{ $chart['total'] }}</h2>
                            <small class="d-block text-center text-muted  font-weight-semibold mb-0">Total</small>
                        </div>
                    </div>
                    <div class="wrapper mt-4 d-flex flex-wrap align-items-cente">
                        <div class="d-flex">
                            <span class="square-indicator bg-success ml-2"></span>
                            <p class="mb-0 ml-2">Organik</p>
                        </div>
                        <div class="d-flex">
                            <span class="square-indicator bg-warning ml-2"></span>
                            <p class="mb-0 ml-2">Non Organik</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Users Berdasarkan Role</div>
                    <canvas id="pieChart" height="210"></canvas>
                    <script>
                        var lbl2 = [@foreach($grafik_pie as $gp) '{{ $gp->role }}', @endforeach];
                        var total = [@foreach($grafik_pie as $gp) {{ $gp->total }}, @endforeach];
                        document.addEventListener("DOMContentLoaded", () => {
                            new Chart(document.querySelector('#pieChart'), {
                                type: 'pie',
                                data: {
                                    /*
                                    labels: [
                                        'Red',
                                        'Blue',
                                        'Yellow'
                                    ],
                                    */
                                    labels:lbl2,
                                    datasets: [{
                                        label: 'Total User berdasarkan Role',
                                        //data: [300, 50, 100],
                                        data: total,
                                        backgroundColor: [
                                            'rgb(255, 99, 132)',
                                            'rgb(54, 162, 235)',
                                            'rgb(255, 205, 86)',
                                            'rgb(60, 179, 113)',
                                            'rgb(106, 90, 205)'
                                        ],
                                        hoverOffset: 4
                                    }]
                                }
                            });
                        });

                    </script>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title mb-sm-0">Latest Transaction</h4>
                        <a href="{{ route('transaksi.index') }}" class="text-dark ml-auto mb-3 mb-sm-0"> View all
                            Transaction</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table class="table">
                            <thead>
                                <tr>
                                    @foreach ($transactionData['title'] as $title)
                                        <th class="font-weight-bold">{{ $title }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transactionData['data'] as $transaksi)
                                <tr>
                                    <td>{{ (!empty($transaksi->setoran_id) ? 'Setor': 'Tarik') }}</td>
                                    <td>{{ $transaksi->rekening->user->name }}</td>
                                    <td>Rp. {{ (!empty($transaksi->setoran_id) ? number_format($transaksi->setoran->total_harga, 0, ',', '.') : number_format($transaksi->penarikan->total_harga, 0, ',', '.')) }}</td>
                                    <td><label class="badge {{ $transaksi->status == 'diterima' ? 'badge-success' : ($transaksi->status == 'belum diterima' ? 'badge-warning' : 'badge-danger') }}">{{ ucwords($transaksi->status) }}</label></td>
                                    <td>{{ $transaksi->created_at->toDayDateTimeString() }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
