<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\KelasAdmin;
use App\Models\Mkuliah;
use App\Models\User;
use App\Models\Absensi;
use Exception;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class kelasDosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::id();
        $kelass =  DB::select(DB::raw(
            "select * ,(select count(z.id_user) from user_has_kelas z where a.id_kelas=z.id_kelas ) as total from kelas a
        join matakuliah b on a.id_mk = b.id_mk
        where b.id_dosen = $id_user"
        ));


        return view('kelasDosen.index', compact('kelass'), [
            "title" => "SMP PTIK | Daftar Mata Kuliah",
            "judul" => "Daftar Kelas"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('kelasDosen.create', [
            "title" => "SMP PTIK | Tambah Mata Kuliah",
            "judul" => "Kelas Kuliah"
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $matkuls = DB::table('kelas')
            ->join('matakuliah', 'kelas.id_mk', '=', 'matakuliah.id_mk')
            ->where('kelas.id_kelas', $id)
            ->get();

        $matkul = $matkuls[0];
        $kelas = KelasAdmin::find($id);

        return view('kelasDosen.edit', compact('kelas', 'matkul'), [
            "title" => "Data Mata Kuliah",
            "judul" => "Tambah Mata Kuliah"
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $data = $request->input();

            DB::table('kelas')->where('id_kelas', $id)
                ->update([
                    'info'     => $data['info'],
                ]);

            return redirect()->route('kelasDosen.index')
                ->with('status', 'Kelas updated successfully.');
        } catch (Exception $e) {
            return redirect()->route('kelasDosen.index')
                ->with('failed', 'Kelas updated Failed.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tambahInfo(Request $request)
    {
        $data = $request->input();
        $openened = Absensi::find($data['id_kelas'])->where('tanggal', date("Y/m/d"))->exists();

        if ($openened) {
        } else {
            try {

                $Absensi = new Absensi;
                $Absensi->id_kelas = $data['id_kelas'];
                $Absensi->tanggal = date("Y/m/d");
                $Absensi->status = true;

                $Absensi->save();
                return redirect()->route('kelasDosen.index')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect()->route('kelasDosen.index')->with('failed', "operation failed");
            }
        }
    }
    public function bukaAbsensi(Request $request)
    {
        date_default_timezone_set("Asia/Jakarta");

        $data = $request->input();
        $openend = Absensi::where('id_kelas', $data['id_kelas'])->where('tanggal', date("Y/m/d"))->exists();
        if ($openend) {
            return redirect()->route('kelasDosen.index')->with('failed', "Kelas Sudah Dibuka Hari Ini");
        } else {

            try {

                $Absensi = new Absensi;
                $Absensi->id_kelas = $data['id_kelas'];
                $Absensi->tanggal = date("Y/m/d");
                $Absensi->status = true;

                $Absensi->save();
                return redirect()->route('kelasDosen.index')->with('status', "Insert successfully");
            } catch (Exception $e) {
                return redirect()->route('kelasDosen.index')->with('failed', "operation failed");
            }
        }
    }
}
