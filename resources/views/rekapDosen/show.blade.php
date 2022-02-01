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
                    <a href="{{route('users.export',['id_kelas' => $id_kelas,'matkul'=>$matkul->matkul])}}" class="btn btn-success pull-right">Download Rekapitulasi</a>
                        <div class="card-body table-responsive">
                            <table class="table table-hover" id="tableRekapDosen">
                                <thead class="text-dark">
                                    <th>NIM</th>
                                    <th>Nama Mahasiswa</th>
                                    <th>tanggal</th>
                                    <th>jam</th>
                                    <th>keterangan</th>
                                    <th>file</th>
                                  
                                </thead>
                                <tbody>
                                    @forelse ($rekaps as $rekap)
                                    <tr>
                                        <td>{{$rekap->nii}}</td>
                                        <td>{{$rekap->name}}</td>
                                        <td>{{$rekap->tanggal}}</td>
                                        <td>{{$rekap->time}}</td>
                                        <td>{{$rekap->kehadiran}}</td>
                                        @if($rekap->kehadiran =='masuk')  
                                        <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($rekap->sign)) }}" height="100" width="150"></td>
                                        @else
                                        <td><img src="data:image/png;base64,{{ chunk_split(base64_encode($rekap->file)) }}" height="100" width="150"></td>
                                        @endif
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
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $('#tableRekapDosen').DataTable({
        });
       

    });

   
</script>
@endsection