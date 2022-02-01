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
            <h4 class="card-title ">{{$matkul->matkul}}</h4>
            <p class="card-category">Pendidikan Teknik Informatika dan Komputer</p>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">
              <table class="table table-hover" id="tableAbsensiDosen">
                <thead class="text-dark">
                  <th>Nama Mahasiswa</th>
                  <th>Tanggal</th>
                  <th>Jam</th>
                  <th>Keterangan</th>

                </thead>
                <tbody>
                  @forelse ($riwayats as $riwayat)
                  <tr>
                    <th>{{$riwayat->name}}</th>
                    <th>{{$riwayat->tanggal}}</th>
                    <th>{{$riwayat->time}}</th>
                    <th>{{$riwayat->kehadiran}}</th>

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
    </div>
  </div>
</div>
<script>
$(document).ready(function() {
    $('#tableAbsensiDosen').DataTable();

  });
</script>
@endsection