@extends('private.index')
@section('content')
@php
$userRole = Auth::user()->role;
@endphp
    <div class="page-header">
        <h3 class="page-title"> Detail Transaksi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Transaksi</li>
            </ol>
        </nav>
    </div>
    <div class="row">
        <div class="col-12">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card" style="width:auto">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-3 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-tags icon-md text-success"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ (!empty($logTransaksi->setoran_id) ? 'Setoran' : 'Penarikan') }} </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Tipe Transaksi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-person-circle icon-md text-info"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $logTransaksi->rekening->user->name }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Nasabah</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($logTransaksi->penarikan_id)) 
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-credit-card icon-md text-info"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $logTransaksi->penarikan->metode_pembayaran->nama }} </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Metode Pembayaran</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-cash-coin icon-md text-success"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0">Rp. {{ (!empty($logTransaksi->setoran_id) ? number_format($logTransaksi->setoran->total_harga, 0, ',', '.') : number_format($logTransaksi->penarikan->total_harga, 0, ',', '.') ) }}
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Total Harga</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i
                                    class="bi bi-patch-{{ $logTransaksi->status == 'diterima' ? 'check icon-md text-success' : ($logTransaksi->status == 'belum diterima' ? 'exclamation icon-md text-warning' : 'exclamation icon-md text-danger')}}"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0">
                                            <label class="badge {{ $logTransaksi->status == 'diterima' ? 'badge-success' : ($logTransaksi->status == 'belum diterima' ? 'badge-warning' : 'badge-danger') }}">{{ ucwords($logTransaksi->status) }}</label>
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Status</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (!empty($logTransaksi->setoran_id))
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-award icon-md text-info"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $logTransaksi->setoran->total_score }} </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Total Score</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-coin icon-md text-success"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $logTransaksi->setoran->total_coin }} TC</h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Total Coin</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-calendar2-week icon-md text-info"></i>
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
                    </div>
                    <br>
                    @if (!empty($logTransaksi->setoran_id))
                    <div class="row">
                        <div class="col-12">
                            <h3>Tabel Item Transaksi</h3>
                        </div>
                        <div class="col-12">
                            @php
                                $arrayTitle = ['Sampah', 'Score/sampah', 'Coin/sampah', 'Harga Satuan', 'Jumlah', 'Total', 'ACTION'];
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
                                            <td>{{ $detailSetoran->sampah->score }}</td>
                                            <td>{{ $detailSetoran->sampah->coin }}</td>
                                            <td>Rp.
                                                {{ number_format($detailSetoran->sampah->harga, 0, ',', '.') }}/{{ $detailSetoran->sampah->satuan }}
                                            </td>
                                            <td>{{ $detailSetoran->jumlah }}</td>
                                            <td>Rp.
                                                {{ number_format($detailSetoran->jumlah * $detailSetoran->sampah->harga, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                
                                                <a class="btn btn-sm btn-warning" title="Edit Detail Setoran" data-bs-toggle="modal" data-bs-target="#editModal{{$detailSetoran->id}}"><i class="icon-pencil"></i></a>
                                                <!-- Modal -->
                                                <div class="modal fade" id="editModal{{$detailSetoran->id}}" tabindex="-1"
                                                    aria-labelledby="editModalLabel{{$detailSetoran->id}}" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <form method="POST" action="{{route('detail_setoran.update', $detailSetoran->id)}}">
                                                            @csrf
                                                            @method('PUT')
                                                            <input type="hidden" name="setoran_id" value="{{$detailSetoran->setoran_id}}">
                                                            <div class="modal-header">
                                                                <h1 class="modal-title fs-5" id="editModalLabel{{$detailSetoran->id}}">Edit Item Transaksi</h1>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <label for="editSampahSelect" class="col-sm-3 col-form-label">Sampah</label>
                                                                            <div class="col-sm-9">
                                                                                <select class="form-control" id="editSampahSelect" name="sampah_id">
                                                                                    @foreach($arraySampah as $sampah)
                                                                                    <option value="{{$sampah->id}}" {{ $detailSetoran->sampah->id == $sampah->id? 'selected':''}}>{{$sampah->nama}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                          </div>
                                                                    </div>
                                                                    <div class="col-12">
                                                                        <div class="form-group row">
                                                                            <label for="editJumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                                                            <div class="col-sm-9">
                                                                                <input type="number" class="form-control" name="jumlah" id="editJumlah" value="{{$detailSetoran->jumlah}}">
                                                                            </div>
                                                                          </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save
                                                                    changes</button>
                                                            </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($userRole == "admin" || $userRole == "manager")
                                                <form method="POST" action="{{ route('detail_setoran.destroy', $detailSetoran->id) }}" style="all:unset">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" title="Hapus Detail Setoran"
                                                        class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </form>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <tfoot>
                                <center>
                                    <a href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal"><i class="bi bi-plus"></i> Tambah Item</td></a>
                                    <div class="modal fade" id="createModal" tabindex="-1"
                                        aria-labelledby="createModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST" action="{{route('detail_setoran.store')}}">
                                                @csrf
                                                @method('POST')
                                                <input type="hidden" name="setoran_id" value="{{$detailSetoran->setoran_id}}">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="createModalLabel">Tambah Item setoran</h1>
                                                    <button type="button" class="btn-close"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <label for="tambahSampahSelect" class="col-sm-3 col-form-label">Sampah</label>
                                                                <div class="col-sm-9">
                                                                    <select class="form-control" id="tambahSampahSelect" name="sampah_id">
                                                                        <option>- Pilih Sampah -</option>
                                                                        @foreach($arraySampah as $sampah)
                                                                        <option value="{{$sampah->id}}">{{$sampah->nama}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                              </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <div class="form-group row">
                                                                <label for="tambahJumlah" class="col-sm-3 col-form-label">Jumlah</label>
                                                                <div class="col-sm-9">
                                                                    <input type="number" class="form-control" name="jumlah" id="tambahJumlah">
                                                                </div>
                                                              </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save
                                                        changes</button>
                                                </div>
                                            </form>
                                            </div>
                                        </div>
                                    </div>
                                </center>
                            </tfoot>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ url('/transaksi') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
