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
                <a href="{{route('kelasAdmin.create')}}" class="btn btn-primary active" role="button" aria-pressed="true">tambah</a>   
                <div class="card-body table-responsive">
                  <table class="table table-hover">
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
                         <td>{{$kelas->slot}}</td>

                    
                        <td class="text-center">
                                        <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('kelasAdmin.destroy', $kelas->id_kelas) }}" method="POST">
                                            <!-- <a href="{{ route('kelasAdmin.edit', $kelas->id_kelas) }}" class="btn btn-sm btn-primary">EDIT</a> -->
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
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
           
@endsection