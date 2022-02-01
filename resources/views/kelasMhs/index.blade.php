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
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Daftar kelas</h4>
            <p class="card-category"> Pendidikan Teknik Informatika dan Komputer</p>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">

              <table class="table table-hover" id="tableKelasMhs">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>Dosen</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Slot</th>
                  
                  <th>Action</th>

                </thead>
                <tbody>
                  @forelse ($kelass as $kelas)
                  <tr>
                    <td>{{$kelas->matkul}}</td>
                    <td>{{$kelas->name}}</td>
                    <td>{{$kelas->hari}}</td>
                    <td>{{$kelas->jam}}</td>
                    <td>{{$kelas->total}}/{{$kelas->slot}}</td>
                   


                    <td class="text-center">
                      <form onsubmit="return confirm('Apakah Anda Ingin Bergabung ?');" action="{{ route('kelasMhs.store', $kelas->id_kelas) }}" method="POST">
                        @csrf
                        <input type="text" class="form-control @error('dosen') is-invalid @enderror" id="id_kelas" name="id_kelas" value="{{$kelas->id_kelas}}" style="display:none">
                        <button type="submit" class="btn btn-sm btn-info">Masuk</button>
                      </form>
                    </td>
                  </tr>
                  @empty
                  <div class="alert alert-danger">
                    Data kelas belum Tersedia.
                  </div>
                  @endforelse
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Kelas saya</h4>
                <p class="card-category"> Pendidikan Teknik Informatika dan Komputer</p>
              </div>
              <div class="card-body">
                <div class="card-body table-responsive">
                  <table class="table table-hover" id="tableKelasMhsSaya">
                    <thead class="text-dark">
                      <th>Mata Kuliah</th>
                      <th>Dosen</th>
                      <th>Hari</th>
                      <th>Jam</th>
                      <th>Slot</th>
                      <th>Info</th>
                      <th>Action</th>
                    </thead>
                    <tbody>
                      @forelse ($kelassayas as $kelassaya)
                      <tr>
                        <td>{{$kelassaya->matkul}}</td>
                        <td>{{$kelassaya->name}}</td>
                        <td>{{$kelassaya->hari}}</td>
                        <td>{{$kelassaya->jam}}</td>
                        <td>{{$kelassaya->total}}/{{$kelassaya->slot}}</td>
                        <td>{{$kelassaya->info}}</td>


                        <td class="text-center">
                          <form onsubmit="return confirm('Apakah Anda Tidak Ingin Bergabung ?');" action="{{ route('kelasMhs.destroyKelas')}}" method="post">
                            @csrf


                            <input type="text" class="form-control" id="id_kelas" name="id_kelas" value="{{$kelassaya->id_kelas}}" style="display:none">

                            <button type="submit" class="btn btn-sm btn-danger">Keluar</button>
                          </form>
                        </td>

                        @empty
                        <div class="alert alert-danger">
                          Data kelas belum Tersedia.
                        </div>
                        @endforelse
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>

        <script>
          function format(d) {
            // `d` is the original data object for the 

            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
              '<tr>' +
              '<td>Info:</td>' +
              '<td> ' + d[5] + '</td>' +
              '</tr>' +

              '</table>';
          }
          $(document).ready(function() {
            var table =  $('#tableKelasMhsSaya').DataTable({
              "columnDefs": [{
                "targets": [5],
                "visible": false,
                "searchable": false
              }]
            });

            $('#tableKelasMhsSaya tbody').on('click', 'tr', function() {
              var tr = $(this).closest('tr');
              var row = table.row(tr);

              if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
              } else {
                // Open this row
                row.child(format(row.data())).show();
                tr.addClass('shown');
              }
            });
            $('#tableKelasMhs').DataTable();
          });
        </script>


        @endsection