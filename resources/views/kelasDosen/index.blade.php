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
            <p class="card-category">{{ Auth::user()->name }}</p>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tableKelasDosen">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Slot</th>
                  <th>Action</th>
                  <th>Info</th>
                </thead>
                <tbody>
                  @forelse ($kelass as $kelas)
                  <tr>
                    <td>{{$kelas->matkul}}</td>
                    <td>{{$kelas->hari}}</td>
                    <td>{{$kelas->jam}}</td>
                    <td>{{$kelas->total}}/{{$kelas->slot}}</td>
                    <td>{{$kelas->info}}</td>

                    <td class="text-center">

                      <form onsubmit="return confirm('Apakah Anda ingin Membuka Absen ?');" action="{{ route('kelasDosen.bukaAbsen')}}" method="post">
                        <a href="{{ route('kelasDosen.edit', $kelas->id_kelas) }}" class="btn btn-sm btn-info">Tambah Info</a>
                        @csrf
                        <input type="text" class="form-control" id="id_kelas" name="id_kelas" value="{{$kelas->id_kelas}}" style="display:none">
                        <button type="submit" class="btn btn-sm btn-success">Buka Absen</button>
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
  </div>
</div>
<script>
  $(document).ready(function() {
    function format(d) {
      // `d` is the original data object for the 

      return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">' +
        '<tr>' +
        '<td>Info:</td>' +
        '<td> '+d[4]+'</td>' +
        '</tr>' +

        '</table>';
    }
    var table = $('#tableKelasDosen').DataTable({
      "columnDefs": [{
          "targets": [4],
          "visible": false,
          "searchable": false
        }
      ]
    });
    $('#tableKelasDosen tbody').on('click', 'tr', function() {
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