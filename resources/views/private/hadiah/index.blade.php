@extends('private.index')
@section('content')
@php
$arrayTitle = ['Nama','Coin Diperlukan','Stok','Tanggal Dibuat','ACTION'];
@endphp
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h3>Daftar Hadiah</h3>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <a href="{{ route('hadiah.create') }}" class="btn btn-primary btn-icon-text"><i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
                        </div>
                        {{-- <div class="float-end">
                            <a href="{{ url('/berita-pdf') }}" class="btn btn-danger" title="Export to PDF"><i class="bi bi-file-earmark-pdf-fill">Download PDF</i></a>
                        </div> --}}
                    </div>
                </div>
                <p class="card-description"> tabel data hadiah
                </p>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            @foreach ($arrayTitle as $title)
                            <th>{{ $title }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrayHadiah as $hadiah)
                        <tr>
                            <td>{{ $hadiah->nama }}</td>
                            <td>{{ $hadiah->coin_diperlukan}}</td>
                            <td>{{ $hadiah->stok}}</td>
                            <td>{{ $hadiah->created_at->toFormattedDateString() }}</td>
                            <td>
                                <form method="POST" action="{{ route('hadiah.destroy', $hadiah->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-info" href="{{ route('hadiah.show', $hadiah->id) }}" title="Detail Hadiah">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('hadiah.edit', $hadiah->id) }}" title="Ubah Hadiah">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="submit" title="Hapus Hadiah" class="btn btn-danger" name="proses" value="hapus" onclick="return confirm('Anda Yakin diHapus?')">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection