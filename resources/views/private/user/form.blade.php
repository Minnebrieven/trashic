@extends('private.index')
@section('content')
<div class="card">
    <div class="card-body">
        <br />
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h5 class="card-title">Form Asset</h5>
        <!-- No Labels Form -->
        <form class="row g-3" method="POST" action="{{ route('asset.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <input type="text" class="form-control @error('nama') is-invalid @else is-valid @enderror" name="nama"
                    value="{{ old('nama') }}" placeholder="Nama Asset">
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12">
                <select name="kategori_id" 
                    class="form-select @error('kategori_id') is-invalid @else is-valid @enderror">
                    <option>-- Pilih Kategori Asset --</option>
                    @foreach($ar_kategori as $k)
                        @php $sel = ( old('kategori_id') == $k->id ) ? 'selected' : ''; @endphp
                        <option value="{{ $k->id }}" {{ $sel }}>{{ $k->nama }}</option>
                    @endforeach
                </select>
                @error('kategori_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control @error('thn_beli') is-invalid @else is-valid @enderror"
                    name="thn_beli" value="{{ old('thn_beli') }}" placeholder="Tahun Beli">
                @error('thn_beli')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control @error('harga') is-invalid @else is-valid @enderror" 
                 name="harga" value="{{ old('harga') }}" placeholder="Harga">
                 @error('harga')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror 
            </div>
            <div class="col-md-6">
                <input type="text" class="form-control @error('masa_umur') is-invalid @else is-valid @enderror" 
                 name="masa_umur" value="{{ old('masa_umur') }}" placeholder="Masa Umur">
                 @error('masa_umur')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror  
            </div>
            <div class="col-md-6">
                <fieldset class="row mb-3r">
                    <legend class="col-form-label col-sm-2 pt-0">Kondisi</legend>
                    <div class="col-sm-10">
                        @foreach($ar_kondisi as $k )
                            @php $cek = ( old('kondisi') == $k ) ? 'checked' : ''; @endphp
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="kondisi" value="{{ $k }}" {{ $cek }}>
                                <label class="form-check-label">
                                    {{ $k }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </fieldset>
                <br/>
                @error('kondisi')
                    <font color="red">{{ $message }}</font>
                @enderror 

            </div>
            
            <div class="col-6">
                <label for="basic-url" class="form-label">Lokasi</label>
                <textarea class="form-control @error('lokasi') is-invalid @else is-valid @enderror" 
                 name="lokasi" cols="50" rows="5">{{ old('lokasi') }}</textarea>
                 @error('lokasi')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror  
            </div>
            <div class="col-md-6">
                <label for="basic-url" class="form-label">Foto</label>
                <input type="file" class="form-control @error('foto') is-invalid @else is-valid @enderror" 
                 name="foto" value="{{ old('foto') }}" />
                 @error('foto')
                    <div class="invalid-feedback">{{ $message }}</div>
                 @enderror   
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                <a href="{{ url('/asset') }}" class="btn btn-secondary btn-sm">Batal</a>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</div>
@endsection
