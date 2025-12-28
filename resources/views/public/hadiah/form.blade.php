@extends('public.index')
@section('content')
    <section id="penarikanForm" class="penarikanForm section-bg">
        <div class="container">
            
            <div class="section-title">
                <h2>Tarik Saldo</h2>
                <p>Isi Form dibawah untuk tarik saldo melalui platform kami.</p>
            </div>

            <div class="row">
                <div class="col-12">
                    @if (is_string($errors))
                        <div class="alert alert-danger">
                            <h5>{{ $errors }}</h5>
                        </div>
                    @elseif ($errors->any())
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
            <form method="POST" action="{{ route('penarikan.store') }}" role="form">
                @csrf
                @method('POST')
                <input type="hidden" name="rekening_id" value="{{ Auth::user()->rekening[0]->id }}">
                <div class="row" id="containerPenarikan">
                    <div class="col-md-12 text-center">
                        <div class="row">
                            <div class="col-md-6 form-group mt-3">
                                <h5>Nomor Rekening :  {{ Auth::user()->rekening[0]->nomor_rekening }}</h5>
                            </div>
                            <div class="col-md-6 form-group mt-3">
                                <h5>Saldo :  Rp. {{ Auth::user()->rekening[0]->saldo }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 form-group mt-3">
                        <select name="metode_pembayaran_id" id="metode_pembayaran" class="form-select" required>
                            <option>Pilih Metode Pembayaran </option>
                            @foreach ($arrayMetodePembayaran as $metodePembayaran)
                                <option value="{{ $metodePembayaran->id }}">{{ $metodePembayaran->nama }}</option>
                            @endforeach
                        </select>
                        <div class="validate"></div>
                    </div>
                    <div class="col-md-6 form-group mt-3">
                        <input type="number" class="form-control" name="total_harga" id="total_harga" placeholder="masukan jumlah saldo yang ingin ditarik" data-rule="total_harga" data-msg="Please enter a valid saldo" required>
                        <div class="validate"></div>
                    </div>
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Tarik</button>
                    <button type="reset" class="btn btn-secondary">Reset</button>
                </div>
            </form>
        @endif
        </div>
        </div>
    </section>
@endsection
