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
<div class="card">
  <div class="card-header card-header-primary">
    <h4 class="card-title">User Absensi</h4>
    <p class="card-category">Pendidikan Teknik Informatika dan Komputer</p>
  </div>
  <div class="card-body table-responsive">
  <a href="{{route('user.create')}}" class="btn btn-primary active" role="button" aria-pressed="true">Tambah User</a>
    <table class="table table-hover" id="tableUser">
      <thead class="text-dark">
        <th>Nama Lengkap</th>
        <th>NIM/NIP</th>
        <th>Email</th>
        <th>Level</th>
        <th>action</th>
      </thead>
      <tbody>
        @forelse ($users as $user)
        <tr>

          <td>{{ $user->name}}</td>
          <td>{{ $user->nii}}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->role}}</td>
          <td class="text-center">
            <form onsubmit="return confirm('Apakah Anda Yakin ?');" action="{{ route('user.destroy', $user->id) }}" method="post">
              <a href="{{ route('user.edit', $user->id) }}" class="btn btn-sm btn-primary">EDIT</a>
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-sm btn-danger">HAPUS</button>
            </form>
          </td>
        </tr>
        @empty
        <div class="alert alert-danger">
          Data user belum Tersedia.
        </div>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
<script>
  $(document).ready(function() {
    $('#tableUser').DataTable();

  });
</script>
@endsection