@extends('private.index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <h3 class="page-title"> Tarik Saldo Nasabah </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Tarik Saldo</li>
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
                    <form method="POST" action="{{ route('transaksi.penarikan.store') }}">
                        @csrf
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Nasabah</label>
                                    <select name="rekening_id" id="user_id" class="form-control" required>
                                        <option value="">-- Pilih Nasabah --</option>
                                        @foreach($rekening as $rkng)
                                            <option value="{{ $rkng->id }}">
                                                {{ $rkng->user->name }} ({{ $rkng->user->email }}) - Rp.{{ $rkng->saldo }}
                                            </option>
                                        @endforeach
                                    </select>
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
                            </div>
                        </div>
                        <br>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Setor</button>
                            <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                    </form>
                </div>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        $('#user_id').select2({
            placeholder: "Ketik nama nasabah...",
            allowClear: true,
            width: '100%'
        });
    });

    const waste = document.getElementById('waste');
    const berat = document.getElementById('berat');

    function hitung() {
        const opt = waste.options[waste.selectedIndex];
        const harga = opt.dataset.harga || 0;
        const score = opt.dataset.score || 0;
        const coin = opt.dataset.coin || 0;
        const b = berat.value || 0;

        document.getElementById('total').innerText = harga * b;
        document.getElementById('score').innerText = score * b;
        document.getElementById('coin').innerText = coin * b;
    }

    waste.addEventListener('change', hitung);
    berat.addEventListener('input', hitung);
</script>
@endsection
