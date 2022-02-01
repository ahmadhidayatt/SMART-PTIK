@extends('layouts.main')

@section('container')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Ubah Password</h4>
            <p class="card-category">{{ Auth::user()->name }}</p>
          </div>
          <div class="card-body">
            <form action="{{route('pass.update', Auth::user()->id)}}" method="post">
              @csrf
              @method('PUT')
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Email address</label>
                    <input type="text" name="email" class="form-control" value="{{ old('email', auth()->user()->email) }} " readonly>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label class="bmd-label-floating">Re-Password</label>
                    <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
                    @error('password_confirmation')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-success pull-left">Save</button>
            </form>
            <a href="{{route('pass.index')}}" class="btn btn-danger pull-right">Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection