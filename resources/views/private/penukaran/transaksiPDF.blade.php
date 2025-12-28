@php
$ar_judul = ['No','Nama Penjual','Jenis Sampah','Jumlah','Tanggal Transaksi','Alamat','Foto'];
$no = 1;
@endphp
<h3 align="center">Daftar Data Transaksi</h3>
<br/><br/>
<table border="1" align="center" cellpadding="10" cellspacing="0">
	<thead>
		<tr>
			@foreach($ar_judul as $jdl)
				<th>{{ $jdl }}</th>
			@endforeach
		</tr>
	</thead>
	<tbody>
		@foreach($ar_transaksi as $a)
			<tr>
				<td>{{ $no++ }}</td>
				<td>{{ $a->nama_penjual }}</td>
				<td>{{ $a->jenis_sampah }}</td>
				<td>{{ $a->jumlah }}</td>
				<td>{{ $a->tgl_transaksi }}</td>
				<td>{{ $a->alamat }}</td>
				<td>{{ $a->foto }}</td>
			</tr>
		@endforeach
	</tbody>
</table>