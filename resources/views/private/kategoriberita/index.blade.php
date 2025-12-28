@extends('private.index')
@section('content')
    @php
        $no = 1;
        $arrayTitle = ['No.', 'Kategori Berita', 'Tanggal Dibuat'];
        $userRole = Auth::user()->role;
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <h3>Daftar Kategori Berita</h3>
                        </div>
                        <div class="col-6">
                            @if ($userRole == 'admin' || $userRole == 'manager')
                                <div class="float-end">
                                    <a class="btn btn-primary btn-icon-text" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="bi bi-clipboard-plus btn-icon-prepend"></i> Tambah Data </a>
                                    </div>
                                    <!-- Modal -->
                                    <div class="modal fade" id="addModal" tabindex="-1"
                                        aria-labelledby="addModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <form method="POST"
                                                    action="{{ route('kategoriberita.store') }}">
                                                    @csrf
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5"
                                                            id="tambahModalLabel">Tambah Kategori Berita</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <label for="addJenisSampah"
                                                                        class="col-sm-3 col-form-label">Nama</label>
                                                                    <div class="col-sm-9">
                                                                        <input id="addJenisSampah" type="text" name="nama" class="form-control">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                            @endif
                        </div>
                    </div>
                    <p class="card-description"> tabel data kategori berita
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
                            @foreach ($ar_kategoriberita as $kategoriBerita)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $kategoriBerita->nama }}</td>
                                    <td>{{ $kategoriBerita->created_at->toFormattedDateString() }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-warning" title="Edit Kategori Berita"
                                            data-bs-toggle="modal" data-bs-target="#editModal{{ $kategoriBerita->id }}"><i
                                                class="icon-pencil"></i></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="editModal{{ $kategoriBerita->id }}" tabindex="-1"
                                            aria-labelledby="editModalLabel{{ $kategoriBerita->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <form method="POST"
                                                        action="{{ route('kategoriberita.update', $kategoriBerita->id) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5"
                                                                id="editModalLabel{{ $kategoriBerita->id }}">Edit Kategori Berita</h1>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group row">
                                                                        <label for="editMetodePembayaran"
                                                                            class="col-sm-3 col-form-label">Nama</label>
                                                                        <div class="col-sm-9">
                                                                            <input id="editMetodePembayaran" type="text"
                                                                                name="nama" class="form-control"
                                                                                value="{{ $kategoriBerita->nama }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save
                                                                changes</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
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
