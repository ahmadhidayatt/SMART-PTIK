@extends('layouts.main') 
    
@section('container')
<div class="content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-8">
              @if(session('status'))
              <h4 class="alert alert-warning mb-2">{{session('status')}}</h4>
              @endif
              <div class="card card-profile">
                <div class="card-avatar">
                    <img class="img" src="../assets/img/faces/profile.png" />
                  </a>
                </div>
                <div class="card-body">
                  <h6 class="card-category">{{ Auth::user()->role }}</h6>
                  <h4 class="card-title">{{ Auth::user()->name }}</h4>
                  <p class="card-description">
                  {{ Auth::user()->email }}
                  </p>
                  <a href="{{route('pass.edit', Auth::user()->id)}}" class="btn btn-sm btn-primary float-end"> Ubah Password </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>  
@endsection