@php
$ar_judul = ['KATEGORI BERITA','AUTHOR','JUDUL','LINK','DESKRIPSI','TANGGAL'];
$no = 1;
@endphp
<h3 align="center">Data Berita</h3>
<br/>
<table border="1" align="center" cellpadding="10" cellspacing="0">
	<thead>
		<tr>
			@foreach($ar_judul as $jdl)
				<th>{{ $jdl }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($ar_berita as $a)
			<tr>
				<td>{{ $a->kategori_berita->nama }}</td>
				<td>{{ $a->user->name }}</td>
				<td>{{ $a->judul }}</td>
				<td><a href="http://{{ $a->url }}" target="_blank">Sumber</a></td>
				<td>{{ $a->deskripsi }}</td>
				<td>{{ $a->created_at->toFormattedDateString() }}</td>
			</tr>
		@endforeach
	</tbody>
</table>