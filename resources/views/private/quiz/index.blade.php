@extends('private.index')
@section('content')
    @php
        $arrayTitle = ['Judul Quiz', 'Jumlah Pertanyaan', 'ACTION'];
        $userRole = Auth::user()->role;
    @endphp
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="row">
                    <div class="col-6"><h3>Daftar Quiz</h3></div>
                    <div class="col-6">
                        @if ($userRole == "admin" || $userRole == "manager")
                        <div class="float-end">
                          <a href="{{ route('quiz.create') }}" class="btn btn-primary btn-icon-text">
                            <i class="bi bi-clipboard-plus btn-icon-prepend"></i> Tambah Data </a>
                        </div>
                        @endif
                    </div>
                </div>
                <p class="card-description"> tabel data quiz
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
                    @foreach ($arrayQuiz as $quiz)
                    <tr>
                        <td>{{ $quiz->judul }}</td>
                        <td>{{ $quiz->pertanyaan->count() }}</td>
                        <td>
                            <a class="btn btn-sm btn-info" href="{{ route('quiz.show', $quiz->id) }}" title="Detail Sampah"><i class="icon-eye"></i></a>
                            @if ($userRole == "admin" || $userRole == "manager")
                            <a class="btn btn-sm btn-warning" href="{{ route('quiz.edit', $quiz->id) }}" title="Detail Sampah"><i class="icon-pencil"></i></a>
                            @endif
                            @if ($userRole == "admin" || $userRole == "manager")
                            <form method="POST" action="{{ route('quiz.destroy', $quiz->id) }}" style="all:unset">
                              @csrf
                              @method('DELETE')
                              <button type="submit" title="Hapus Quiz" class="btn btn-sm btn-danger" onclick="return confirm('Anda yakin ingin menghapus data?')">
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
