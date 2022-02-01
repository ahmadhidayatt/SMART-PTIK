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
                  <h4 class="card-title">Tambah Info</h4>
                </div>
                <div class="card-body">
                  <form action="{{route('kelasDosen.store')}}" method="post">
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
                          <label class="bmd-label-floating">Slot</label>
                          <input type="text" class="form-control @error('info') is-invalid @enderror" id="info" name="info" >
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
