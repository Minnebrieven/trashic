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
                    <h4 class="card-title">Form Quiz</h4>
                    <p class="card-description">form tambah data quiz </p>
                    <form class="forms-sample" method="POST" action="{{ route('quiz.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="inputNama">Judul Quiz</label>
                            <input type="text" class="form-control" id="inputNama" name="judul" placeholder="judul quiz">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                        <button type="reset" class="btn btn-light">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
