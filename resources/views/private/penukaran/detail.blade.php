@extends('private.index')
@section('content')
@php
$userRole = Auth::user()->role;
@endphp
    <div class="page-header">
        <h3 class="page-title"> Detail Penukaran Hadiah </h3>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('penukaran.index') }}">Penukaran</a></li>
                <li class="breadcrumb-item active" aria-current="page">Detail Penukaran</li>
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
                        <div class="col-12 mb-3">
                            <div class="thumbnail">
                                @empty($detailPenukaran->hadiah->gambar)
                                <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="card-img img-fluid" style="display:block; height: 200px;"/>
                                @else
                                <img src="{{ asset('private/assets/img') }}/{{ $detailPenukaran->hadiah->gambar }}" class="card-img img-fluid" style="display:block; height: 200px;">
                                @endempty
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6 mb-3 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-gift icon-md text-success"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $detailPenukaran->hadiah->nama }} </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Hadiah</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-person-circle icon-md text-info"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $detailPenukaran->rekening->user->name }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Nasabah</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i
                                    class="bi bi-patch-{{ $detailPenukaran->status == 'diterima' ? 'check icon-md text-success' : ($detailPenukaran->status == 'belum diterima' ? 'exclamation icon-md text-warning' : 'exclamation icon-md text-danger')}}"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0">
                                            <label class="badge {{ $detailPenukaran->status == 'diterima' ? 'badge-success' : ($detailPenukaran->status == 'belum diterima' ? 'badge-warning' : 'badge-danger') }}">{{ ucwords($detailPenukaran->status) }}</label>
                                        </h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Status</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-6 mb-3">
                            <div class="d-flex flex-row align-items-center">
                                <i class="bi bi-calendar2-week icon-md text-info"></i>
                                <div class="row ml-1">
                                    <div class="col-12">
                                        <h4 class="mb-0"> {{ $detailPenukaran->created_at->toFormattedDateString() }}</h4>
                                    </div>
                                    <div class="col-12">
                                        <small class="text-muted mb-0">Tanggal Transaksi</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{ route('penukaran.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
