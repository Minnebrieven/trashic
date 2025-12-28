@extends('private.index')
@section('content')
<div class="page-header">
	<h3 class="page-title"> Detail Hadiah </h3>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('hadiah.index') }}">Hadiah</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail Hadiah</li>
		</ol>
	</nav>
</div>
<div class="row">
	<div class="card mb-3">
		@empty($hadiah->gambar)
		<img src="{{ asset('private/assets/img/noimage.jpg') }}" class="img-fluid rounded-start" width="300px" height="300px"/>
		@else
		<img src="{{ asset('private/assets/img') }}/{{ $hadiah->gambar }}"  width="300px" height="300px"/>
		@endempty
		<div class="card-body">
			<h4><b>{{ $hadiah->nama }}</b> </h4>
			<p class="card-text"><i class="bi bi-coin text-success"></i> Coin diperlukan : {{ $hadiah->coin_diperlukan }} TC</p>
			<i class="bi bi-box-seam"> Stock tersisa : {{ $hadiah->stok}}</i>
		</div>
	</div>
	<a href="{{ url('/hadiah') }}" class="btn btn-primary btn">Go Back</a>

</div>
@endsection