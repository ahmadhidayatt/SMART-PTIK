@extends('layouts.main')

@section ('container')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Rekapitulasi Absensi Dosen</h4>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tableRekap">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @forelse ($kelass as $kelas)
                  <tr>
                    <td>{{$kelas->matkul}}</td>
                    <td>{{$kelas->hari}}</td>
                    <td>{{$kelas->jam}}</td>
                    <td><a href="{{ route('rekap.edit', $kelas->id_kelas) }}" class="btn btn-success active">Lihat</a></td>
                  </tr>
                  @empty
                  <div class="alert alert-danger">
                    Data rekap belum Tersedia.
                  </div>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#tableRekap').DataTable();
  });
</script>

@endsection