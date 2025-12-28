@extends('private.index')
@section('content')
@php
$ar_judul = ['NO','Jenis Sampah','Harga'];
$no = 1;
@endphp
<h3>Daftar Data Transaksi</h3>
<br /><br />
<table class="table table-striped">
    <thead>
        <tr>
            @foreach($ar_judul as $jdl)
            <th>{{ $jdl }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($ar_datatransaksi as $a)
        <tr>
            <td>{{ $no++ }}</td>
            <td>{{ $a->nama_sampah }}</td>
            <td>Rp. {{ number_format($a->harga,0,',','.') }}</td>
            <!-- <td>
                <form method="POST" action="">
                    <button type="submit" title="Hapus Asset" class="btn btn-danger btn-sm" name="proses" value="hapus" onclick="return confirm('Anda Yakin diHapus?')">
                        <i class="bi bi-trash"></i>
                    </button>
                </form>
            </td> -->
        </tr>
        @endforeach
    </tbody>
</table>

@endsection