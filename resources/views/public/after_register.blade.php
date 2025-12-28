@extends('public.index')
@section('content')
<div class="card text-center">
  <div class="card-header">
    Featured
  </div>
  <div class="card-body">
    <h5 class="card-title">Registrasi User Berhasil</h5>
    <p class="card-text">
        Selamat Registrasi User Berhasil, Harap Tunggu Approval dari Admin Kami
    </p>
    <a href="{{ url('/home') }}" class="btn btn-primary">Terima Kasih</a>
  </div>
</div>
@endsection