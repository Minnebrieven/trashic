@extends('private.index')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="page-header">
                        <h3 class="page-title"> Setor Sampah Nasabah </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{ route('transaksi.index') }}">Transaksi</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Setor</li>
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
                    <form method="POST" action="{{ route('transaksi.setoran.store') }}">
                        @csrf
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="form-label">Nasabah</label>
                                    <select name="rekening_id" id="user_id" class="form-control" required>
                                        <option value="">-- Pilih Nasabah --</option>
                                        @foreach($rekening as $rkng)
                                            <option value="{{ $rkng->id }}">
                                                {{ $rkng->user->name }} ({{ $rkng->user->email }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="row" id="containerSampah">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-8 form-group mt-3 ">
                                            <select name="sampah[0][sampah_id]" class="form-select" id="selectSampah" onchange="ubahInputHargaHidden(this, 'inputHiddenHarga0')">
                                                <option>Pilih Sampah</option>
                                                @foreach ($kategori_sampah as $ktgrSmph)
                                                    <optgroup label="{{ $ktgrSmph->nama }}">
                                                        @foreach ($sampah as $smph)
                                                            @if ($smph->kategori_sampah_id == $ktgrSmph->id)
                                                                <option value="{{ $smph->id }}">{{ $smph->nama }} - {{ $smph->harga }}/{{ $smph->satuan }}</option>
                                                            @endif
                                                        @endforeach
                                                    </optgroup>
                                                @endforeach
                                            </select>
                                            <div class="validate"></div>
                                        </div>
                                        <div class="col-md-3 form-group mt-3">
                                            <input type="number" step="0.1" class="form-control" name="sampah[0][jumlah]" id="jumlah" placeholder="masukan jumlah" data-rule="jumlah" data-msg="Please enter a valid jumlah" required>
                                            <div class="validate"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-3 text-center">
                                <a class="btn btn-info" id="add_form_field"><i class="bi bi-plus"></i></a>
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

<script type="text/javascript">
        var x = 0;
        var hargaSampah = 
        {
            @foreach($sampah as $smph) {{$smph->id}}: {{$smph->harga}}, @endforeach
        }

        $(document).ready(function() {
            var max_fields = {{ $sampah->count() - 1 }};
            var wrapper = $("#containerSampah");
            var add_button = $("#add_form_field");

            
            $(add_button).click(function(e) {
                e.preventDefault();
                if (x < max_fields) {
                    x++;
                    $(wrapper).append(
                        `
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-8 form-group mt-3">
                                    <select name="sampah[`+x+`][sampah_id]" class="form-select" id="selectSampah` + x + `" onchange="ubahInputHargaHidden(this, 'inputHiddenHarga`+x+`')">
                                        <option>Pilih Sampah</option>` +
                                        @foreach ($kategori_sampah as $ktgrSmpah)
                                            `<optgroup label="{{ $ktgrSmpah->nama }}">` +
                                            @foreach ($sampah as $smph)
                                                @if ($smph->kategori_sampah_id == $ktgrSmpah->id)
                                                    `<option value="{{ $smph->id }}">{{ $smph->nama }} - {{ $smph->harga }}/{{ $smph->satuan }}</option>
                                                    ` +
                                                @endif
                                            @endforeach
                                            `</optgroup>` +
                                        @endforeach
                                    `</select>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-md-3 form-group mt-3">
                                    <input type="number" step="0.1" class="form-control" name="sampah[`+x+`][jumlah]" id="jumlah` + x + `"
                                        placeholder="masukan jumlah" data-rule="jumlah" data-msg="Please enter a valid jumlah" required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-md-1 form-group mt-3">
                                    <a class="btn btn-danger delete"><i class="bi bi-x"></i></a>
                                </div>
                            </div>
                            </div>
                        </div>
                        `
                    ); //add input box
                } else {
                    alert('You Reached the limits')
                }
            });

            $(wrapper).on("click", ".delete", function(e) {
                e.preventDefault();
                $(this).parent('div').parent('div').remove();
                x--;
            })

            function ubahInputHargaHidden(selectedSampahElement, inputHiddenID) {
                var sampahID = selectedSampahElement.value;
                var inputHarga = document.getElementById(inputHiddenID);
                var harga = hargaSampah[sampahID];
                
                inputHarga.value = harga;
            }

            function kalkulasiHarga() {
                i = x;
                


                var totalHarga;
                while (x <= max_fields) {
                    totalHarga = $('#selectSampah')
                    i++;
                    document.getElementById("result").value += val
                }
            }
        });
</script>

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
