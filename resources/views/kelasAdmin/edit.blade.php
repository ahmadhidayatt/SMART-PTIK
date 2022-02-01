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
                  <h4 class="card-title">edit User</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('kelasAdmin.update',$kelas->id_kelas) }}" method="post">
                  <div class="row">
                      <div class="col-md-12">
                        <div class="form-group">
                        {{ csrf_field() }}
                        @method('PUT')
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
                          {!! Form::select('id_dosen', $select_mk, 1,['class' => 'form-control'])  !!}
                          <!-- <input type="text" class="form-control @error('dosen') is-invalid @enderror" id="dosen" name="dosen" value='nama dosen'  readonly> -->
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
                          <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror" value="{{ old('hari', $kelas->hari) }}">
                                <option value="senin">senin</option>
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
                          <select id="jam" name="jam"  class="form-control @error('jam') is-invalid @enderror"  value="{{ old('jam', $kelas->jam) }}"> 
                                <option value="08.00-09.45">08.00 - 09.45</option>
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
                          <input type="text" class="form-control @error('slot') is-invalid @enderror" id="slot" name="slot"   value="{{ old('slot', $kelas->slot) }}">
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