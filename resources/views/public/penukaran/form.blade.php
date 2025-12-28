@extends('public.index')
@section('content')
    <section id="jualBeliSampah" class="jualBeliSampah section-bg">
        <div class="container">
            
            <div class="section-title">
                <h2>Setor Sampah</h2>
                <p>Isi Form dibawah untuk setor sampah melalui platform kami.</p>
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
            <form method="POST" action="{{ route('setoran.store') }}" role="form">
                @csrf
                @method('POST')
                
                <input type="hidden" name="rekening_id" value="{{ Auth::user()->rekening[0]->id }}">
                {{-- <div class="row">
                    <div class="col-md-6 form-group">
                        <select name="tipe_transaksi" id="tipe_transaksi" class="form-select" required>
                            <option>Pilih Tipe Transaksi</option>
                            <option value="jual">Jual Sampah</option>
                            <option value="beli">Beli Sampah</option>
                        </select>
                        <div class="validate"></div>
                    </div>
                    <div class="col-md-6 form-group mt-3 mt-md-0">
                        <select name="metode_pembayaran_id" id="metode_pembayaran" class="form-select" required>
                            <option>Pilih Metode Pembayaran </option>
                            @foreach ($arrayMetodePembayaran as $metodePembayaran)
                                <option value="{{ $metodePembayaran->id }}">{{ $metodePembayaran->nama }}</option>
                            @endforeach
                        </select>
                        <div class="validate"></div>
                    </div>
                </div> --}}
                <div class="row" id="containerSampah">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-8 form-group mt-3">
                                <select name="sampah[0][sampah_id]" class="form-select" id="selectSampah" onchange="ubahInputHargaHidden(this, 'inputHiddenHarga0')">
                                    <option>Pilih Sampah</option>
                                    @foreach ($arrayKategoriSampah as $kategoriSampah)
                                        <optgroup label="{{ $kategoriSampah->nama }}">
                                            @foreach ($arraySampah as $sampah)
                                                @if ($sampah->kategori_sampah_id == $kategoriSampah->id)
                                                    <option value="{{ $sampah->id }}">{{ $sampah->nama }} - {{ $sampah->harga }}/{{ $sampah->satuan }}</option>
                                                @endif
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                <div class="validate"></div>
                            </div>
                            <div class="col-md-3 form-group mt-3">
                                <input type="number" class="form-control" name="sampah[0][jumlah]" id="jumlah" placeholder="masukan jumlah" data-rule="jumlah" data-msg="Please enter a valid jumlah" required>
                                <div class="validate"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        <h5 class="float-end">Total Harga : <p id="grand-total">Rp. 0</p>
                        </h5>
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
            @endif
        </div>
        </div>
    </section>
    <script type="text/javascript">
        var x = 0;
        var hargaSampah = 
        {
            @foreach($arraySampah as $sampah) {{$sampah->id}}: {{$sampah->harga}}, @endforeach
        }

        $(document).ready(function() {
            var max_fields = {{ $arraySampah->count() - 1 }};
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
                                        @foreach ($arrayKategoriSampah as $kategoriSampah)
                                            `<optgroup label="{{ $kategoriSampah->nama }}">` +
                                            @foreach ($arraySampah as $sampah)
                                                @if ($sampah->kategori_sampah_id == $kategoriSampah->id)
                                                    `<option value="{{ $sampah->id }}">{{ $sampah->nama }} - {{ $sampah->harga }}/{{ $sampah->satuan }}</option>
                                                    ` +
                                                @endif
                                            @endforeach
                                            `</optgroup>` +
                                        @endforeach
                                    `</select>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-md-3 form-group mt-3">
                                    <input type="number" class="form-control" name="sampah[`+x+`][jumlah]" id="jumlah` + x + `"
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
@endsection
