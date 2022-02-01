<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class DashboardController extends Controller
{
  
   public function __construct()
   {
     
       $this->middleware('auth');
   }

   public function index() {
      
      $dashboard = DB::table('dashboards')->get();
      $kelass =  DB::select(DB::raw(
         "select *,(select count(id_user) from absensiMhs a where a.id_absen = b.id_absen) as total from absensi b 
         join kelas c on b.id_kelas = c.id_kelas 
         join matakuliah d on c.id_mk = d.id_mk 
         join users e on d.id_dosen = e.id where b.tanggal = DATE_FORMAT(CURRENT_TIMESTAMP, '%Y/%m/%d')"
     ));
      return view('dashboard.index', compact('dashboard','kelass'), [
         "title" => "SMP PTIK | Dashboard",
         "judul" => "Dashboard"
     ]); 
   }  

   public function create()
   {
      return view('tambahdashboard',[
         "title" => "SMP PTIK | Form Dashboard",
         "judul" => "Dashboard"
      ]);
   }

   public function store(Request $request)
   {
 
     DB::table('users')->insert([
      'nama' => 'kayla@example.com',
      'nii' => 'kayla@example.com',
      'email' => 'kayla@example.com',
      'password' => 'kayla@example.com',
      'level' => 'kayla@example.com'
  ]);

   }
}
