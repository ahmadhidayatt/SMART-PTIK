@extends('layouts.main')

@section ('container')
@if (session('status'))
<div class="alert alert-success" role="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  {{ session('status') }}
</div>
@elseif(session('failed'))
<div class="alert alert-danger" role="alert">
  <button type="button" class="close" data-dismiss="alert">×</button>
  {{ session('failed') }}
</div>
@endif

<!-- <form class="navbar-form" style="
    margin-block-end: auto;">
  <div class="input-group no-border">
    <input type="text" value="" class="form-control" placeholder="Search...">
      <button type="submit" class="btn btn-default btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
      </button>
  </div>
</form> -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Daftar Mata Kuliah</h4>
            <p class="card-category"> Pendidikan Teknik Informatika dan Komputer</p>
          </div>
          <div class="card-body">
            <a href="{{route('mkuliah.create')}}" class="btn btn-primary active" role="button" aria-pressed="true">tambah</a>
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tableMk">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>Dosen</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @forelse ($matkuls as $matkul)
                  <tr>
                    <td>{{$matkul->matkul}}</td>
                    <td>{{$matkul->name}}</td>


                    <td class="text-center">
                      <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('mkuliah.destroy', $matkul->id_mk) }}" method="POST">
                        <a href="{{ route('mkuliah.edit', $matkul->id_mk) }}" class="btn btn-sm btn-primary">EDIT</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
                      </form>
                    </td>

                    @empty
                    <div class="alert alert-danger">
                      Mata Kuliah belum Tersedia.
                    </div>
                    @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <script>
        $(document).ready(function() {
          $('#tableMk').DataTable();
        });
      </script>

      @endsection