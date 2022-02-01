@extends('layouts.main')

@section('container')
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
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title">Absensi Mahasiswa</h4>
  </div>
  <div class="container-fluid">
    <div class="card-body">
   
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Absensi Kehadiran</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{route('absensiMhs.store')}}" method="post">
                <div class="form-group">
                  {{ csrf_field() }}
                  <label for="recipient-name" class="col-form-label">Nama Lengkap:</label>
                  <input type="text" class="form-control" id="">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">NIM:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Mata Kuliah:</label>
                  <input type="text" class="form-control" id="recipient-name">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Jam Masuk:</label>
                  <input type="text" class="form-control" id="jam">
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Kehadiran:</label>
                  <select id="kehadiran" name="kehadiran" class="form-control @error('kehadiran') is-invalid @enderror">
                    <option value="hadir">Hadir</option>
                    <option value="izin">Izin</option>
                  </select>
                  @error('kehadiran')
                  <div class="alert alert-danger mt-2">
                    {{ $message }}
                  </div>
                  @enderror
                </div>
                <!-- <div class="row">
                <div class="col-md-12">
                  <input type="file" id="myFile" name="filename">
                </div>
              </div> -->

                <button type="submit" class="btn btn-primary">Kirim</button>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body table-responsive">
        <table class="table table-hover">
          <thead class="text-dark">
            <th>Mata Kuliah</th>
            <th>Dosen</th>
            <th>tanggal</th>
            <th>jam</th>
            <th>action</th>
          </thead>
          <tbody>
            @forelse ($absensis as $absensi)
            <tr>
              <td>{{$absensi->matkul}}</td>
              <td>{{$absensi->name}}</td>
              <td>{{$absensi->tanggal}}</td>
              <td>{{$absensi->jam}}</td>
              <td>  
                <a href="{{ route('absensiMhs.edit', $absensi->id_absen) }}" class="btn btn-success active" >Absen</a> 
              </td>
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
@endsection