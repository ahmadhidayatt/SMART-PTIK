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

class KelasAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelass = DB::table('kelas')
            ->join('matakuliah', 'kelas.id_mk', '=', 'matakuliah.id_mk')
            ->join('users', 'matakuliah.id_dosen', '=', 'users.id')
            ->get();
        return view('kelasAdmin.index', compact('kelass'), [
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

        $select_mk = MKuliah::orderBy('matkul', 'ASC')->pluck('matkul', 'id_mk', 'id_dosen');
        return view('kelasAdmin.create', compact('select_mk'), [
            "title" => "SMP PTIK | Tambah Mata Kuliah",
            "judul" => "Mata Kuliah"
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
        $rules = [
            'id_mk' => 'required|string|max:255',
            'hari' => 'required|string|min:1|max:255',
            'jam' => 'required|string|min:1|max:255',
            'slot' => 'required|string|min:1|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('kelasAdmin/create')
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }





    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $select_mk = MKuliah::orderBy('matkul', 'ASC')->pluck('matkul', 'id_mk', 'id_dosen');
        $kelas = KelasAdmin::find($id);
        return view('kelasAdmin.edit', compact('select_mk', 'kelas'), [
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        KelasAdmin::find($id)->delete();
        return redirect()->route('kelasAdmin.index')
            ->with('status', 'Mata Kuliah Berhasil Dihapus');
    }
}
