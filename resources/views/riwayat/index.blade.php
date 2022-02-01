@extends('layouts.main')

@section ('container')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Riwayat Absensi Mahasiswa</h4>
            <p class="card-category"> Pendidikan Teknik Informatika dan Komputer</p>
          </div>
          <div class="card-body">
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-dark">
                  <th>Mata Kuliah</th>
                  <th>Dosen Pengajar</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Action</th>
                </thead>
                <tbody>
                  @forelse ($riwayats as $riwayat)
                  <tr>
                    <td>{{$riwayat->matkul}}</td> 
                    <td>{{$riwayat->name}}</td> 
                    <td>{{$riwayat->hari}}</td>
                    <td>{{$riwayat->jam}}</td>
                    <td><a href="{{ route('riwayat.edit', $riwayat->id_kelas) }}" class="btn btn-success active" >Lihat</a></td>
                    @empty
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

@endsection