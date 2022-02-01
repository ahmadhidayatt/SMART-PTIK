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
<a href="{{route('dashboardAdmin.create')}}" class="btn btn-primary active" role="button" aria-pressed="true">tambah</a>
<div class="card text-center">
  <div class="card-header" style="
    font-weight: bold;
    font-family: system-ui;
">
    INFORMASI ABSENSI PTIK UNJ
  </div>
  <div class="card-body">
    @forelse ($dashboard as $db)
    <p class="card-text">{{$db->info}}</p>
  </div>
  <div class="card-footer text-muted">
    {{$db->created_at}}
    <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('dashboardAdmin.destroy', $db->id_db) }}" method="POST">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
    </form>

  </div>

  @empty
  <div class="alert alert-danger">
    Informasi belum Tersedia.
  </div>
  @endforelse
</div>


@endsection