@extends('private.index')
@section('content')
<div class="page-header">
	<h3 class="page-title"> Detail Sampah </h3>
	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ route('sampah.index') }}">Sampah</a></li>
			<li class="breadcrumb-item active" aria-current="page">Detail Sampah</li>
		</ol>
	</nav>
</div>
<div class="row mt-3">
	<div class="col-12">
		<div class="card" style="width: auto;">
			<div class="card-body">
				<div class="row">
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-trash icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> {{ $sampah->nama }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Nama Sampah</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-recycle icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> {{ $sampah->kategori_sampah->jenis_sampah->nama }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Jenis Sampah</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-person-circle icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> Rp. {{ number_format($sampah->harga,0,',','.') }}/{{ $sampah->satuan }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Harga/Satuan</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-recycle icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> {{ $sampah->kategori_sampah->nama }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Kategori Sampah</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-calendar2-week icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> {{ $sampah->created_at->toDayDateTimeString() }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Tanggal Dibuat</small>
								</div>
							</div>
						</div>
					</div>
					<div class="col-6 mb-3">
						<div class="d-flex flex-row align-items-center">
							<i class="bi bi-calendar2-week icon-md text-info"></i>
							<div class="row ml-1">
								<div class="col-12">
									<h4 class="mb-0"> {{ $sampah->updated_at->toDayDateTimeString() }}</h4>
								</div>
								<div class="col-12">
									<small class="text-muted mb-0">Tanggal Diupdate</small>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12 mt-3">
		<a href="{{ url()->previous() }}" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Go Back</a>
	</div>
</div>
@endsection