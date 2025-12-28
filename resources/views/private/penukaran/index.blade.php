@extends('private.index')
@section('content')
@php
$userRole = Auth::user()->role;
@endphp
    @php
        $arrayTitle = ['Nama Nasabah', 'Hadiah', 'Status', 'Tanggal Tukar', 'ACTION'];
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Daftar Penukaran</h3>
                        </div>
                        {{-- <div class="col-6">
                            <div class="float-end">
                                <a href="{{ route('setoran.create') }}" class="btn btn-primary btn-icon-text">
                                    <i class="icon-plus btn-icon-prepend"></i> Tambah Data </a>
                            </div>
                        </div> --}}
                    </div>
                    <p class="card-description"> tabel data penukaran
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
                            @foreach ($arrayPenukaran as $penukaran)
                                <tr>
                                    <td>{{ $penukaran->rekening->user->name }}</td>
                                    <td>{{ $penukaran->hadiah->nama }}</td>
                                    <td>
                                        <label class="badge {{ $penukaran->status == 'diterima' ? 'badge-success' : ($penukaran->status == 'ditolak' ? 'badge-danger' : 'badge-warning') }}">{{ ucwords($penukaran->status) }}</label>
                                        @if ($penukaran->status != 'diterima' && $penukaran->status != 'ditolak')
                                        <form method="POST" action="{{ route('penukaran.konfirmasi', $penukaran->id) }}" style="all:unset">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" title="Konfirmasi Penukaran" class=" badge btn-sm btn-info" onclick="return confirm('Anda yakin ingin mengkonfirmasi penukaran hadiah?')">
                                                <i class="icon-checklist">Konfirmasi</i>
                                            </button>
                                        </form>
                                        @endif
                                    </td>
                                    <td>{{ $penukaran->created_at->toDayDateTimeString() }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-info" href="{{ route('penukaran.show', $penukaran->id) }}"
                                            title="Detail Penukaran">
                                            <i class="icon-eye"></i>
                                        </a>
                                        <a class="btn btn-sm btn-warning"
                                            href="{{ route('penukaran.edit', $penukaran->id) }}" title="Edit Penukaran">
                                            <i class="icon-pencil"></i>
                                        </a>
                                        @if ($userRole == "admin" || $userRole == "manager")
                                        <form method="POST" action="{{ route('penukaran.destroy', $penukaran->id) }}" style="all:unset">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" title="Hapus Penukaran" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data?')">
                                                <i class="icon-trash"></i>
                                            </button>
                                        </form>
                                        @endif
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