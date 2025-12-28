@extends('public.index')
@section('title', 'Daftar Harga Sampah')
@section('content')
<div class="container mt-5">
    <h2 class="text-center mb-4"> Daftar Harga Sampah Non-Organik</h2>

    <p class="text-center text-muted mb-5">
        Harga dapat berubah sesuai kondisi pasar dan kualitas sampah. Sampah dikelompokkan berdasarkan kategori untuk memudahkan pemilahan
    </p>

    @forelse($kategori as $ktgr)
        <div class="mb-5">
            <h4 class="mb-3 text-success">
                {{ strtoupper($ktgr->nama) }}
            </h4>

            <div class="row">
                @forelse($ktgr->sampah as $smph)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-sm h-100 border-success">
                            <div class="card-body text-center">
                                <h5 class="fw-bold">{{ $smph->nama }}</h5>
                                <hr>
                                <p class="mb-2">
                                    💰 <strong>
                                        Rp{{ number_format($smph->harga, 0, ',', '.') }}
                                    </strong> / {{ $smph->satuan }}
                                </p>
                                <p class="mb-1">⭐ {{ ($smph->poin <= 0) ? '0' : $smph->poin}} poin / {{ $smph->satuan }}</p>
                                <p class="mb-0">🥮 {{ ($smph->coin <= 0) ? '0' : $smph->coin}} coin / {{ $smph->satuan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12">
                        <div class="alert alert-warning">
                            Belum ada data sampah di kategori ini.
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    @empty
        <div class="alert alert-danger text-center">
            Data kategori sampah belum tersedia.
        </div>
    @endforelse
</div>
@endsection
