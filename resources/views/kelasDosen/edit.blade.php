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
                  <h4 class="card-title">edit Kelas</h4>
                </div>
                <div class="card-body">
                  <form action="{{ route('kelasDosen.update',$kelas->id_kelas) }}" method="post">
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
                          <label class="bmd-label-floating">Dosen Pengajar</label>
                          <input type="text" class="form-control @error('dosen') is-invalid @enderror" id="dosen" name="dosen" value="{{ auth()->user()->name}}"  readonly>
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
                          <label class="bmd-label-floating">Mata Kuliah</label>
                          <input type="text" class="form-control @error('matkul') is-invalid @enderror" name="matkul" value="{{ old('matkul', $matkul-> matkul) }}" readonly> 
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
                          <label class="bmd-label-floating">Hari</label>
                          <select id="hari" name="hari" class="form-control @error('hari') is-invalid @enderror" value="{{ old('hari', $kelas->hari) }}" readonly>
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
                          <select id="jam" name="jam"  class="form-control @error('jam') is-invalid @enderror"  value="{{ old('jam', $kelas->jam) }}" readonly>  
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
                          <input type="text" class="form-control @error('slot') is-invalid @enderror" id="slot" name="slot"   value="{{ old('slot', $kelas->slot) }}" readonly>
                                @error('slot')
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
                          <label class="bmd-label-floating">info</label>
                          <textarea name="info" class="form-control @error('info') is-invalid @enderror" rows="5"    value="{{ old('info', $kelas->info) }}"></textarea>
                        
                                @error('info')
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