@extends('private.index')
@section('content')
<div class="page-header">
	<h3 class="page-title"> Detail Berita </h3>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('berita.index') }}">Berita</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail Berita</li>
		</ol>
	</nav>
</div>
<div class="row">
	<div class="card mb-3">
		@empty($rs->foto)
		<img src="{{ asset('private/assets/img/noimage.jpg') }}" class="img-fluid rounded-start" width="300px" height="300px"/>
		@else
		<img src="{{ asset('private/assets/img') }}/{{ $rs->foto }}"  width="300px" height="300px"/>
		@endempty
		<div class="card-body">
			<h4><b>{{ $rs->judul }}</b> </h4>
			<p class="card-text">{{ $rs->deskripsi }} </p>
			<i class="bi bi-person-circle"> {{ $rs->user->name}}</i>
		</div>
	</div>
	<a href="{{ url('/berita') }}" class="btn btn-primary btn">Go Back</a>

</div>
@endsection