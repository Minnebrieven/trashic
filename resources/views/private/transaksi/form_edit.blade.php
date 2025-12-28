@extends('private.index')
@section('content')
    <div class="page-header">
        <h3 class="page-title"> Edit Transaksi </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit Transaksi</li>
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
    @php
        $statusTransaksi = ['belum diterima', 'diterima', 'ditolak'];
    @endphp
    <div class="row">
        <div class="col-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('transaksi.update', $logTransaksi->id) }}" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputNama">Nama Nasabah</label>
                                    <input type="text" class="form-control" id="inputNama"
                                        value="{{ $logTransaksi->rekening->user->name }}" disabled>
                                    <input type="hidden" name="user_id" value="{{$logTransaksi->rekening->user->id}}">
                                </div>
                            </div>
                            @if (!empty($logTransaksi->penarikan_id))
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="metode_pembayaran">Metode Pembayaran</label>
                                    <select name="metode_pembayaran_id" class="form-select" id="metode_pembayaran">
                                        <option>- Metode Pembayaran -</option>
                                        @foreach ($arrayMetodePembayaran as $metodePembayaran)
                                            <option value="{{ $metodePembayaran->id }}"
                                                {{ $logTransaksi->penarikan->metode_pembayaran->id == $metodePembayaran->id ? 'selected' : '' }}>
                                                {{ $metodePembayaran->nama }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            @endif
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="status">Status Transaksi</label>
                                    <select name="status" class="form-select" id="status">
                                        <option>- Status Bayar -</option>
                                        @foreach ($statusTransaksi as $status)
                                            <option value="{{ $status }}"
                                                {{ $logTransaksi->status == $status ? 'selected' : '' }}>
                                                {{ ucwords($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="total_harga">Total Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control" id="total_harga" name="total_harga"
                                            value="{{ (!empty($logTransaksi->setoran) ? $logTransaksi->setoran->total_harga : $logTransaksi->penarikan->total_harga) }}" placeholder="500" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-12">
            <a href="{{ url('/transaksi') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Go Back</a>
        </div>
    </div>
@endsection
