@extends('layouts.main')

@section('container')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-8">
              <div class="card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title">Input Dashboard</h4>
                </div>
                <div class="card-body">
                  <form action="{{route('dashboard.index')}}" method="post">
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
                          <input type="text" class="form-control @error('matkul') is-invalid @enderror" name="matkul">
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
                  <a href="{{route('dashboard.index')}}" class="btn btn-danger pull-right">Kembali</a>
                </div>
              </div>
            </div>
        </div>        
      </div>
      </div>  
@endsection