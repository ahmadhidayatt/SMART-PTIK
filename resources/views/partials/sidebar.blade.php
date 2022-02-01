<div class="sidebar-wrapper">
  <ul class="nav">
    @if ( auth()->user()->role == 'admin')
    <li class="nav-item {{request()->is('dashboardAdmin') ? 'active' : ''}} ">
      <a class="nav-link " href="{{route('dashboardAdmin.index')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('user') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('user.index')}}">
        <i class="material-icons">person</i>
        <p>user</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('mkuliah') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('mkuliah.index')}}">
        <i class="material-icons">content_paste</i>
        <p>Daftar Mata Kuliah</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('kelasAdmin') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('kelasAdmin.index')}}">
        <i class="material-icons">featured_play_list</i>
        <p>kelas</p>
      </a>
    </li>
    </li>
    <li class="nav-item {{request()->is('rekap') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('rekap.index')}}">
        <i class="material-icons">archive</i>
        <p>Rekapitulasi Absensi</p>
      </a>
    </li>

    @elseif ( auth()->user()->role == 'dosen')
    <li class="nav-item {{request()->is('dashboard') ? 'active' : ''}} ">
      <a class="nav-link " href="{{route('dashboard.index')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('kelasDosen') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('kelasDosen.index')}}">
        <i class="material-icons">featured_play_list</i>
        <p>Kelas Saya</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('absensiDosen') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('absensiDosen.index')}}">
        <i class="material-icons">content_paste</i>
        <p>Absensi Kuliah</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('rekap') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('rekap.index')}}">
        <i class="material-icons">archive</i>
        <p>Rekapitulasi Absensi</p>
      </a>
    </li>

    @elseif ( auth()->user()->role == 'mahasiswa')
    <li class="nav-item {{request()->is('dashboard') ? 'active' : ''}} ">
      <a class="nav-link " href="{{route('dashboard.index')}}">
        <i class="material-icons">dashboard</i>
        <p>Dashboard</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('kelasMhs') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('kelasMhs.index')}}">
        <i class="material-icons">featured_play_list</i>
        <p>kelas</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('absensiMhs') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('absensiMhs.index')}}">
        <i class="material-icons">content_paste</i>
        <p>Absensi Kuliah</p>
      </a>
    </li>
    <li class="nav-item {{request()->is('riwayat') ? 'active' : ''}}">
      <a class="nav-link" href="{{route('riwayat.index')}}">
        <i class="material-icons">history</i>
        <p>Riwayat Absensi</p>
      </a>
    </li>

    @endif
   
  </ul>
</div>