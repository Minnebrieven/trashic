@extends('private.index')
@section('content')
@php
$ar_judul = ['No','Nama','Email','Role','IsActive','Action'];
$no = 1;
@endphp
@if(Auth::user()->role == 'admin')
<h3>Daftar User</h3>
<a href="" class="btn btn-primary" title="Tambah Data">
    <i class="bi bi-clipboard-plus"></i>
</a>
<br/><br/>
<table class="table datatable">
	<thead>
		<tr>
			@foreach($ar_judul as $jdl)
				<th>{{ $jdl }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($ar_user as $u)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $u->name }}</td>
				<td>{{ $u->email }}</td>
				<td>{{ $u->role }}</td>
				<td>{{ $u->isactive }}</td>
                <td>
					<form method="POST" action="">
					@csrf
                    @method('DELETE')		
					<a class="btn btn-info btn-sm" href="" title="Detail User">
                        <i class="bi bi-eye"></i>
                    </a>
                    <a class="btn btn-warning btn-sm" href="" title="Ubah User">
                        <i class="bi bi-pencil-fill"></i>
                    </a>
					<button type="submit" class="btn btn-danger btn-sm show-alert-delete-box" title="Hapus User">
						<i class="bi bi-trash"></i>
					</button>
					</form>
				</td>
			</tr>
		@endforeach
	</tbody>
</table>
@else
	@include('private.access_denied')
@endif
@endsection