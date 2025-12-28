@extends('private.index')
@section('content')
    @php
        $no = 1;
        $arrayTitle = ['No.', 'Kategori Sampah', 'Jenis Sampah', 'Tanggal Dibuat', 'ACTIONS'];
        $userRole = Auth::user()->role;
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-6"><h3>Daftar Kategori Sampah</h3></div>
                    <div class="col-6">
                        @if ($userRole == "admin" || $userRole == "manager")
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
                                        action="{{ route('kategorisampah.store') }}">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5"
                                                id="tambahModalLabel">Tambah Kategori Sampah</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label for="formNamaKategoriSampah"
                                                            class="col-sm-3 col-form-label">Nama</label>
                                                        <div class="col-sm-9">
                                                            <input id="formNamaKategoriSampah" type="text" name="nama" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <label for="selectJenisSampah"
                                                            class="col-sm-3 col-form-label">Jenis Sampah</label>
                                                        <div class="col-sm-9">
                                                            <select name="jenis_sampah_id" class="form-select" id="selectJenisSampah">
                                                                <option>- Jenis Sampah -</option>
                                                                @foreach ($ar_jenis_sampah as $jenis_sampah)
                                                                    <option value="{{ $jenis_sampah->id }}"> {{ ucwords($jenis_sampah->nama) }} </option>
                                                                @endforeach
                                                            </select>
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
                <p class="card-description"> tabel data kategori sampah
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
                    @foreach ($ar_kategori_sampah as $kategoriSampah)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $kategoriSampah->nama }}</td>
                        <td>{{ $kategoriSampah->jenis_sampah->nama }}</td>
                        <td>{{ $kategoriSampah->created_at->toFormattedDateString() }}</td>
                        <td>
                            <a class="btn btn-sm btn-warning" title="Edit Detail Transaksi"
                                data-bs-toggle="modal" data-bs-target="#editModal{{ $kategoriSampah->id }}"><i
                                    class="icon-pencil"></i></a>
                            <!-- Modal -->
                            <div class="modal fade" id="editModal{{ $kategoriSampah->id }}" tabindex="-1"
                                aria-labelledby="editModalLabel{{ $kategoriSampah->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form method="POST"
                                            action="{{ route('kategorisampah.update', $kategoriSampah->id) }}">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5"
                                                    id="editModalLabel{{ $kategoriSampah->id }}">Edit Kategori Sampah</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="editKategoriSampah"
                                                                class="col-sm-3 col-form-label">Nama</label>
                                                            <div class="col-sm-9">
                                                                <input id="editKategoriSampah" type="text" name="nama" class="form-control" value="{{ $kategoriSampah->nama }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <label for="editSelectJenisSampah"
                                                                class="col-sm-3 col-form-label">Jenis Sampah</label>
                                                            <div class="col-sm-9">
                                                                <select name="jenis_sampah_id" class="form-select" id="editSelectJenisSampah">
                                                                    <option>- Jenis Sampah -</option>
                                                                    @foreach ($ar_jenis_sampah as $jenisSampah)
                                                                        <option value="{{ $jenisSampah->id }}" {{ $kategoriSampah->jenis_sampah_id == $jenisSampah->id ? 'selected' : '' }}> {{ ucwords($jenisSampah->nama) }} </option>
                                                                    @endforeach
                                                                </select>
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