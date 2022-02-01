@extends('layouts.main')

@section('container')
<div class="card text-center">
  <div class="card-header" style="
    font-weight: bold;
    font-family: system-ui;
">
    INFORMASI ABSENSI PTIK UNJ
  </div>
  <div class="card-body">
    @forelse ($dashboard as $db)
    <p class="card-text">{{$db->info}}</p>
  </div>
  <div class="card-footer text-muted">
    {{$db->created_at}}
  </div>
  @empty
  <div class="alert alert-danger">
    Data user belum Tersedia.
  </div>
  @endforelse
</div>
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title">Mata kuliah pada hari ini</h4>
  </div>
  <div class="card-body">
    <div class="card-body table-responsive">
      <table class="table table-hover">
        <thead class="text-dark">
          
          <th>Kode Kelas </th>
          <th>Mata Kuliah</th>
          <th>Dosen</th>
          <th>Tanggal</th>
          <th>Jam Kuliah</th>
          <th>Keterangan</th>
          
        </thead>
        <tbody>
          @forelse ($kelass as $kelas)
          <tr>
          <td>{{$kelas->id_kelas}}</td>
            <td>{{$kelas->matkul}}</td>
            <td>{{$kelas->name}}</td>
            <td>{{$kelas->tanggal}}</td>
            <td>{{$kelas->jam}}</td>
            <td>{{$kelas->total}}/{{$kelas->slot}}</td>
            @empty
            <div class="alert alert-danger">
              Data Absen belum Tersedia.
            </div>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection