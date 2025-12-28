@extends('private.index')
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="row">
        <div class="col-12 grid-margin stretch-card mt-3">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Form Sampah</h4>
                    <p class="card-description">form tambah data sampah </p>
                    <form class="forms-sample" method="POST" action="{{ route('sampah.update', $dataSampahLama->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" value="{{ $dataSampahLama->id }}">
                        <div class="form-group">
                            <label for="inputNama">Nama Sampah</label>
                            <input type="text" class="form-control" id="inputNama" name="nama" placeholder="nama sampah" value="{{ $dataSampahLama->nama }}">
                        </div>
                        <div class="form-group">
                            <label for="selectKategoriSampah">Kategori Sampah</label>
                            <select class="form-control" id="selectKategoriSampah" name="kategori_sampah_id">
                                <option>-- Pilih Kategori Sampah --</option>
                                @foreach ($arrayKategoriSampah as $kategoriSampah)
                                    <option value="{{ $kategoriSampah->id }}" 
                                        {{ $dataSampahLama->kategori_sampah_id == $kategoriSampah->id ? 'selected' : '' }}>
                                        {{ $kategoriSampah->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputHarga">Harga</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Rp.</span>
                                        </div>
                                        <input type="number" class="form-control" id="inputHarga" name="harga"
                                            placeholder="500" value="{{ $dataSampahLama->harga }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="inputSatuan">Satuan</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">/</span>
                                        </div>
                                        <input type="text" class="form-control" id="inputSatuan" name="satuan"
                                            placeholder="botol" value="{{ $dataSampahLama->satuan }}">
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
@endsection
