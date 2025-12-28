@extends('private.index')
@section('content')
<div class="card">
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <h5 class="card-title">Form Jenis Sampah</h5>
        <!-- No Labels Form -->
        <form class="row g-3" method="POST" action="{{ route('jenissampah.store') }}"
            enctype="multipart/form-data">
            @csrf
            <div class="col-md-12">
                <input type="text" class="form-control" name="jenis_sampah" placeholder="Jenis sampah">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="reset" class="btn btn-secondary">Batal</button>
            </div>
        </form><!-- End No Labels Form -->
    </div>
</div>
@endsection