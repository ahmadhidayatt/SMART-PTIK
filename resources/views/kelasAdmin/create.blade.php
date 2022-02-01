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
                  <h4 class="card-title">Tambah Kelas</h4>
                </div>
                <div class="card-body">
                  <form action="{{route('kelasAdmin.store')}}" method="post">
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
                          {!! Form::select('id_mk', $select_mk, 1,['class' => 'form-control', 'id' => 'id_mk']) !!}
                          <!-- <input type="text" class="form-control @error('id_dosen') is-invalid @enderror" name="id_dosen"> -->
                                @error('id_mk')
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
                          <input type="text" class="form-control @error('dosen') is-invalid @enderror" id="dosen" name="dosen" value='nama dosen'  readonly>
                                @error('dosen')
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
                          <label class="bmd-label-floating">Hari</label>
                          <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror">
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                            </select>
                            @error('hari')
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
                          <label class="bmd-label-floating">Jam Kuliah</label>
                          <select id="jam" name="jam"  class="form-control @error('jam') is-invalid @enderror">
                                <option value="08.00-09.45">08.00 - 09.45</option>
                                <option value="10.00 - 11.45">10.00 - 11.45</option>
                                <option value="13.00 - 14.45">13.00 - 14.45</option>
                                <option value="15.00 - 16.45">15.00 - 16.45</option>
                            </select>
                            @error('jam')
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
                          <label class="bmd-label-floating">Slot</label>
                          <input type="text" class="form-control @error('slot') is-invalid @enderror" id="slot" name="slot" >
                                @error('slot')
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
