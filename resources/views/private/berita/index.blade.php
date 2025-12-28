@extends('private.index')
@section('content')
@php
$arrayTitle = ['AUTHOR','JUDUL','TANGGAL DIBUAT','ACTION'];
@endphp
<div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h3>Daftar Berita</h3>
                    </div>
                    <div class="col-6">
                        <div class="float-end">
                            <a href="{{ route('berita.create') }}" class="btn btn-primary btn-icon-text"><i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
                        </div>
                        <div class="float-end">
                            <a href="{{ url('/berita-pdf') }}" class="btn btn-danger" title="Export to PDF"><i class="bi bi-file-earmark-pdf-fill">Download PDF</i></a>
                        </div>
                    </div>
                </div>
                <p class="card-description"> tabel data berita
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
                        @foreach ($ar_berita as $a)
                        <tr>
                            <td>{{ $a->user->name }}</td>
                            <td>{{ $a->judul}}</td>
                            <td>{{ $a->created_at->toFormattedDateString() }}</td>
                            <td>
                                <form method="POST" action="{{ route('berita.destroy', $a->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <a class="btn btn-info" href="{{ route('berita.show', $a->id) }}" title="Detail Berita">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a class="btn btn-warning" href="{{ route('berita.edit', $a->id) }}" title="Ubah Berita">
                                        <i class="bi bi-pencil-fill"></i>
                                    </a>
                                    <button type="submit" title="Hapus Berita" class="btn btn-danger" name="proses" value="hapus" onclick="return confirm('Anda Yakin diHapus?')">
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