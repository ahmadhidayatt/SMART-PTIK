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
            <h4 class="card-title ">Absensi Mahasiswa</h4>
            <p class="card-category">{{ Auth::user()->name }}</p>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tableAbsensiDosen">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>tanggal</th>
                  <th>jam</th>

                </thead>
                <tbody>
                  @forelse ($kelass as $kelas)
                  <tr>
                    <td>{{$kelas->matkul}}</td>
                    <td>{{$kelas->tanggal}}</td>
                    <td>{{$kelas->jam}}</td>
                    <!-- <td class="text-center">
                      <form onsubmit="return confirm('Apakah Anda Membuka Absen ?');" action="{{ route('kelasDosen.bukaAbsen')}}" method="post">
                        @csrf


                        <input type="text" class="form-control" id="id_kelas" name="id_kelas" value="{{$kelas->id_kelas}}" style="display:none">

                        <button type="submit" class="btn btn-sm btn-success">Buka Absen</button>
                      </form>
                    </td> -->
                    @empty
                    <div class="alert alert-danger">
                      Data Absen belum Tersedia.
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
          function format(d) {
            // `d` is the original data object for the row
            return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
              '<tr>' +
              '<td>Full name:</td>' +
              '<td> ' + d[0] + ' </td>' +
              '</tr>' +

              '</table>';
          }
          var table = $('#tableAbsensiDosen').DataTable();
          $('#tableAbsensiDosen tbody').on('click', 'tr', function() {
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

        });
      </script>
      @endsection