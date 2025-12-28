@extends('private.index')
@section('content')
<div class="page-header">
    <h3 class="page-title"> Edit Hadiah </h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('hadiah.index') }}">Hadiah</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Hadiah</li>
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
    <div class="col-12 grid-margin stretch-card mt-3">
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('hadiah.update',$hadiah->id) }}" class="forms-sample">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nama">Nama Hadiah</label>
                                <input type="text" class="form-control" name="nama" value="{{ $hadiah->nama }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="coin_diperlukan">Coin Diperlukan</label>
                                <input type="number" class="form-control" name="coin_diperlukan" value="{{ $hadiah->coin_diperlukan }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="stok">Stok Hadiah</label>
                                <input type="number" class="form-control" name="stok" value="{{ $hadiah->stok }}">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="gambar">Gambar Hadiah</label>
                                <input type="file" class="form-control" name="gambar" />
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