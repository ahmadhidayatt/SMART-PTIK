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
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Tambah Mata kuliah</h4>
                </div>
                <div class="card-body">
                  <form action="{{route('mkuliah.store')}}" method="post">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                        {{ csrf_field() }}
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Mata Kuliah</label>
                          <select id="matkul" name="matkul" class="form-control @error('matkul') is-invalid @enderror">
                                <option value="Algoritma dan Pemrograman">Algoritma dan Pemrograman</option>
                                <option value="Aljabar Linier">Aljabar Linier</option>
                                <option value="Analisis dan Perancangan Algoritma">Analisis dan Perancangan Algoritma</option>
                                <option value="Analisis dan Perancangan Sistem">Analisis dan Perancangan Sistem</option>
                                <option value="Analisis dan Perancangan Sistem Berorientasi Objek">Analisis dan Perancangan Sistem Berorientasi Objek</option>
                                <option value="Basis Data">Basis Data</option>
                                <option value="Basis Data Lanjutan">Basis Data Lanjutan</option>
                                <option value="Data Mining">Data Mining</option>
                                <option value="Data Warehouse">Data Warehouse</option>
                                <option value="Desain Web">Desain Web</option>
                                <option value="Desain Web Lanjut">Desain Web Lanjut</option>
                                <option value="E-Commerce">E-Commerce</option>
                                <option value="Filsafat Ilmu">Filsafat Ilmu</option>
                                <option value="Interaksi Manusia dan Komputer">Interaksi Manusia dan Komputer</option>
                                <option value="Jaringan Komputer">Jaringan Komputer</option>
                                <option value="Kalkulus">Kalkulus</option>
                                <option value="Kecerdasan Buatan">Kecerdasan Buatan</option>
                                <option value="Komunikasi Data">Komunikasi Data</option>
                                <option value="Konsep Pemrograman">Konsep Pemrograman</option>
                                <option value="Manajemen Proyek Perangkat Lunak">Manajemen Proyek Perangkat Lunak</option>
                                <option value="Matematika Diskrit">Matematika Diskrit</option>
                                <option value="Metode Numerik">Metode Numerik</option>
                                <option value="Metodologi Pengembangan Perangkat Lunak">Metodologi Pengembangan Perangkat Lunak</option>
                                <option value="Organisasi dan Arsitektur Komputer">Organisasi dan Arsitektur Komputer</option>
                                <option value="Pemrograman Berorientasi Objek">Pemrograman Berorientasi Objek</option>
                                <option value="Pemrograman Berorientasi Objek Lanjutan">Pemrograman Berorientasi Objek Lanjutan</option>
                                <option value="Pengantar Sistem dan Teknologi Informasi">Pengantar Sistem dan Teknologi Informasi</option>
                                <option value="Perencanaan Strategis Sistem Informasi">Perencanaan Strategis Sistem Informasi</option>
                                <option value="Praktikum Teknik Komputer">Praktikum Teknik Komputer</option>
                                <option value="Rancang Bangun Perangkat Lunak">Rancang Bangun Perangkat Lunak</option>
                                <option value="Rekayasa Perangkat Lunak">Rekayasa Perangkat Lunak</option>
                                <option value="Sistem Multimedia">Sistem Multimedia</option>
                                <option value="Sistem Operasi">Sistem Operasi</option>
                                <option value="Struktur Data">Struktur Data</option>
                            </select>
                                @error('matkul')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="bmd-label-floating">Dosen Pengajar</label>
                          {!! Form::select('id_dosen', $select_dosen, 1,['class' => 'form-control']) !!}
                          <!-- <input type="text" class="form-control @error('id_dosen') is-invalid @enderror" name="id_dosen"> -->
                                @error('id_dosen')
                                    <div class="alert alert-danger mt-2">
                                        {{ $message }}
                                    </div>
                                @enderror
                        </div>
                      </div>
                    </div>
                    
                    <button type="submit" class="btn btn-success pull-left">Save</button>
                  </form>
                  <a href="{{route('mkuliah.index')}}" class="btn btn-danger pull-right">Kembali</a>
                </div>
              </div>
            </div>
        </div>        
      </div>
      </div>  
@endsection