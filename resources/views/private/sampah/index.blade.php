@extends('private.index')
@section('content')
    @php
        $arrayTitle = ['Nama', 'Kategori Sampah', 'Jenis Sampah', 'Score/satuan', 'Coin/satuan', 'Harga', 'ACTION'];
        $userRole = Auth::user()->role;
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-6"><h3>Daftar Sampah</h3></div>
                    <div class="col-6">
                        @if ($userRole == "admin" || $userRole == "manager")
                        <div class="float-end">
                          <a href="{{ route('sampah.create') }}" class="btn btn-primary btn-icon-text">
                            <i class="bi bi-clipboard-plus btn-icon-prepend"></i> Tambah Data </a>
                        </div>
                        @endif
                    </div>
                </div>
                <p class="card-description"> tabel data sampah
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
                    @foreach ($arraySampah as $sampah)
                    <tr>
                        <td>{{ $sampah->nama }}</td>
                        <td>{{ $sampah->kategori_sampah->nama }}</td>
                        <td>{{ $sampah->kategori_sampah->jenis_sampah->nama }}</td>
                        <td>{{ (!empty($sampah->score) ? $sampah->score.'/'.$sampah->satuan : '-') }}</td>
                        <td>{{ (!empty($sampah->coin) ? $sampah->coin.' TC/'.$sampah->satuan : '-' ) }}</td>
                        <td>Rp. {{ number_format($sampah->harga, 0, ',', '.') }}/{{ $sampah->satuan }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('sampah.show', $sampah->id) }}" title="Detail Sampah"><i class="icon-eye"></i></a>
                            @if ($userRole == "admin" || $userRole == "manager")
                            <a class="btn btn-sm btn-warning" href="{{ route('sampah.edit', $sampah->id) }}" title="Detail Sampah"><i class="icon-pencil"></i></a>
                            @endif
                            @if ($userRole == "admin" || $userRole == "manager")
                            <form method="POST" action="{{ route('sampah.destroy', $sampah->id) }}" style="all:unset">
                              @csrf
                              @method('DELETE')
                              <button type="submit" title="Hapus Sampah" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data?')">
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
