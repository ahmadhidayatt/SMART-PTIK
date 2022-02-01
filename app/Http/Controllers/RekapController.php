<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RekapController extends Controller
{
    public function index()
    {

        $id_user = Auth::id();

        $kelass =  DB::select(DB::raw(
            "select * from kelas a
        join matakuliah b on a.id_mk = b.id_mk
        where b.id_dosen = $id_user"
        ));
        return view('rekapDosen.index', compact('kelass'), [
            "title" => "SMP PTIK | Rekapitulasi Absensi",
            "judul" => "Rekapitulasi Absensi"
        ]);
    }

    public function edit($id)
    {
        $id_user = Auth::id();
        $rekaps = DB::select(DB::raw(
        "select *,a.jam as time from absensimhs a 
        join absensi b on a.id_absen = b.id_absen 
        join kelas c on b.id_kelas = c.id_kelas 
        join matakuliah e on c.id_mk = e.id_mk
        join users d on a.id_user = d.id
        where c.id_kelas = $id;"
        ));

        $matkuls = DB::select(DB::raw(
            "select * from kelas a
            join matakuliah b on a.id_mk = b.id_mk
            where a.id_kelas = $id"
        ));
        $id_kelas= $id;
        $matkul =$matkuls[0];
        return view('rekapDosen.show', compact('rekaps', 'matkul','id_kelas'), [
            "title" => "SMP PTIK | Riwayat Absensi",
            "judul" => "Riwayat Absensi"
        ]);
  
    
    }

    public function create()
    {
        $select_mk = MKuliah::orderBy('matkul', 'ASC')->pluck('matkul', 'id_mk', 'id_dosen');
        return view('kelasDosen.index', compact('select_mk'), [
            "title" => "SMP PTIK | Upload Rekapitulasi Absensi",
            "judul" => "Rekapitulasi Absensi"
        ]);
    }

    public function store(Request $request)
    {
        $rules = [
            'id_dosen' => 'required|string|min:1|max:255',
            'id_mk' => 'required|string|min:1|max:255',
            'tanggal' => 'required|string|min:1|max:255',
            'slot' => 'required|string|min:1|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('kelasDosen/rekap')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            try {

                $KelasAdmin = new KelasAdmin;
                $KelasAdmin->id_mk = $data['id_mk'];
                $KelasAdmin->hari = $data['hari'];
                $KelasAdmin->jam = $data['jam'];
                $KelasAdmin->slot = $data['slot'];

                $KelasAdmin->save();
                return redirect()->route('kelasAdmin.index')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect()->route('kelasAdmin.index')->with('failed', "operation failed");
            }
        }
    }
}
