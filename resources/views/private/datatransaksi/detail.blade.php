@extends('private.index')
@section('content')
<div class="card" style="width: 18rem;">
	<div class="card-body">
		<h5 class="card-title">{{ $rs->nama_sampah }}</h5>
		<p class="card-text">
			Harga: Rp. {{ number_format($a->harga,0,',','.') }}
		</p>
		<a href="{{ url('/datatransaksi') }}" class="btn btn-primary">Go Back</a>
	</div>
</div>
@endsection