<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User_has_kelas;
use App\Models\Mkuliah;
use App\Models\User;
use App\Models\Absensi;
use App\Models\AbsensiMhs;
use Illuminate\Support\Facades\Auth;

class RiwayatController extends Controller
{
    public function index()
    {

        $id_user = Auth::id();

        $riwayats = DB::select(DB::raw(
            // "select * from absensiMhs a 
            // join absensi b on b.id_absen = a.id_absen 
            // join kelas c on b.id_kelas = c.id_kelas 
            // join matakuliah d on c.id_mk = d.id_mk 
            // join users e on d.id_dosen = e.id 
            // where a.id_user = $id_user"
            "select * from kelas a
            join matakuliah b on a.id_mk = b.id_mk
            join users c on b.id_dosen = c.id
            where a.id_kelas  in (select DISTINCT(id_kelas) from user_has_kelas where id_user = $id_user)"

        ));

        return view('riwayat.index', compact('riwayats'), [
            "title" => "SMP PTIK | Riwayat Absensi",
            "judul" => "Riwayat Absensi"
        ]);
    }

    public function edit($id)
    {
        $id_user = Auth::id();
        $riwayats = DB::select(DB::raw(
        "select *,a.jam time from absensimhs a 
        join absensi b on a.id_absen = b.id_absen 
        join kelas c on b.id_kelas = c.id_kelas 
        join matakuliah d on c.id_mk = d.id_mk 
        join users e on a.id_user = e.id
        where a.id_user=$id_user and b.id_kelas=$id;"
        ));

        $matkuls = DB::select(DB::raw(
            "select * from kelas a
            join matakuliah b on a.id_mk = b.id_mk
            where a.id_kelas = $id"
        ));
        $matkul =$matkuls[0];
        return view('riwayat.show', compact('riwayats','matkul'), [
            "title" => "SMP PTIK | Riwayat Absensi",
            "judul" => "Riwayat Absensi"
        ]);
  
    
    }

    public function show($id)
    {
      //
    }
}
