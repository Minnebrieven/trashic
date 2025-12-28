@extends('public.index')
@section('content')
    <section id="jualBeliSampah" class="jualBeliSampah section-bg">
        <div class="container">

            @php
            $trashicCOIN = (!empty(Auth::user()->rekening[0]))? Auth::user()->rekening[0]->coin : 0;
            $rekening_id = (!empty(Auth::user()->rekening[0]))? Auth::user()->rekening[0]->id : 0;
            @endphp

            <div class="section-title">
                <h2>Daftar Hadiah</h2>
                <p>Coin yang dimiliki : {{ number_format($trashicCOIN, 0, ',', '.') }} <i class="bi bi-coin icon-md text-warning"></i>.</p>
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
            @if (empty(Auth::user()->rekening[0]))
            <div class="alert alert-danger">
                <ul>
                    <li>Error! Rekening belum dibuat. Hubungi staff/admin untuk membuat rekening</li>
                </ul>
            </div>
            @else

            <div class="row">
                @if ($arrayHadiah->isNotEmpty())
                @foreach ($arrayHadiah as $hadiah)
                    <div class="col-md-6">
                        <div class="card mb-4">
                            <div class="card-body">
                                <h5 class="card-title">&nbsp;
                                    <span class="text-body-primary"> {{ number_format($hadiah->coin_diperlukan, 0, ',', '.') }} <i class="bi bi-coin icon-md text-warning"></i>
                                        &nbsp;</span>
                                </h5>
                                <div class="row mt-3">
                                    <div class="col-md-12 mb-3 mb-3">
                                        <div class="thumbnail">
                                            @empty($hadiah->gambar)
                                            <img src="{{ asset('private/assets/img/noimage.jpg') }}" class="card-img" style="display:block; height: 200px;"/>
                                            @else
                                            <img src="{{ asset('private/assets/img') }}/{{ $hadiah->gambar }}" class="card-img" style="display:block; height: 200px;">
                                            @endempty
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-3 mb-3">
                                        <div class="d-flex flex-row align-items-center">
                                            <h4 class="mb-0">{{ $hadiah->nama }}</h4>
                                        </div>
                                    </div>
                                </div>
                                <form method="POST" action="{{ route('penukaran.tukar_hadiah', $hadiah->id) }}" style="all:unset">
                                    <input type="hidden" name="rekening_id" value="{{ $rekening_id }}">
                                    <p class="card-text mt-2 float-end">
                                        <small class="text-body-secondary">
                                            Tersisa {{ $hadiah->stok }} |
                                                @csrf
                                                @method('POST')
                                                <button type="submit" title="Tukar Hadiah" {{ ($hadiah->stok <= 0) ? 'disabled' : ''}} class="btn btn-sm btn-success" onclick="return confirm('Anda yakin ingin tukar hadiah {{ $hadiah->nama }}?')">
                                                    <i class="icon-checklist">Tukar</i>
                                                </button>
                                        </small>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
                @else
                <small class="text-center text-body-secondary">Belum ada transaksi</small>
                @endif
            </div>
            @endif
    </section>
@endsection
