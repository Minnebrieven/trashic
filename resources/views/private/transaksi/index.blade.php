@extends('private.index')
@section('content')
@php
$userRole = Auth::user()->role;
@endphp
    @php
        $arrayTitle = ['Tipe Transaksi', 'Nama Nasabah', 'Total Harga', 'Total Coin', 'Status Pembayaran', 'Tanggal Transaksi', 'ACTION'];
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Daftar Transaksi</h3>
                        </div>
                        <div class="col-6">
                            @if ($userRole == "admin" || $userRole == "manager")
                            <div class="float-end">
                              <button type="button" class="btn btn-primary btn-icon-text" data-toggle="modal" data-target="#tambahDataModal">
                                <i class="bi bi-clipboard-plus btn-icon-prepend"></i> Tambah Data </button>
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="tambahDataModal" tabindex="-1" role="dialog" aria-labelledby="tambahDataModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="tambahDataModalLabel">Pilih Tipe Transaksi</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                    <div class="row justify-content-evenly">
                                        <div class="col-md-6">
                                            <a href="{{ route('transaksi.setoran.create') }}" class="btn btn-primary btn-icon-text">Setoran</a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ route('transaksi.penarikan.create') }}" class="btn btn-primary btn-icon-text">Penarikan</a>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endif
                        </div>
                        {{-- <div class="col-6">
                            <div class="float-end">
                                <a href="{{ route('setoran.create') }}" class="btn btn-primary btn-icon-text">
                                    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
                            </div>
                        </div> --}}
                    </div>
                    <p class="card-description"> tabel data transaksi
                    </p>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                @foreach ($arrayTitle as $title)
                                    <th>{{ $title }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($arrayLogTransaksi as $logTransaksi)
                                <tr>
                                    <td>{{ (!empty($logTransaksi->setoran_id) ? 'Setoran' : 'Penarikan') }}</td>
                                    <td>{{ $logTransaksi->rekening->user->name }}</td>
                                    <td>Rp. {{ (!empty($logTransaksi->setoran_id) ? number_format($logTransaksi->setoran->total_harga, 0, ',', '.') : number_format($logTransaksi->penarikan->total_harga, 0, ',', '.') ) }}</td>
                                    <td>{{ (!empty($logTransaksi->setoran_id) ? $logTransaksi->setoran->total_coin : '-' )}}</td>
                                    {{-- <td>{{ (!empty($logTransaksi->setoran_id) ? $logTransaksi->setoran->total_score : '-' ) }}</td> --}}
                                    <td>
                                        <label class="badge {{ $logTransaksi->status == 'diterima' ? 'badge-success' : ($logTransaksi->status == 'ditolak' ? 'badge-danger' : 'badge-warning') }}">{{ ucwords($logTransaksi->status) }}</label>
                                        @if ($logTransaksi->status != 'diterima' && $logTransaksi->status != 'ditolak')
                                        <form method="POST" action="{{ route('transaksi.konfirmasi', $logTransaksi->id) }}" style="all:unset">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" title="Konfirmasi Transaksi" class=" badge btn-sm btn-info" onclick="return confirm('Anda yakin ingin mengkonfirmasi transaksi?')">
                                                <i class="icon-checklist">Konfirmasi</i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>{{ $logTransaksi->created_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('transaksi.show', $logTransaksi->id) }}"
                                            title="Detail Transaksi">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('transaksi.edit', $logTransaksi->id) }}" title="Edit Transaksi">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        @if ($userRole == "admin" || $userRole == "manager")
                                        <form method="POST" action="{{ route('transaksi.destroy', $logTransaksi->id) }}" style="all:unset">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Transaksi" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection