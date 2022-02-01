<?php

namespace App\Http\Controllers;

use App\Models\KelasAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\User_has_kelas;
use App\Models\Mkuliah;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class kelasMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::id();

        $kelass =  DB::select(
            DB::raw(
                "select *,(select count(id_user) from user_has_kelas c where c.id_kelas=a.id_kelas ) as total from kelas a
        join matakuliah b on a.id_mk = b.id_mk
        join users c on b.id_dosen = c.id
        where a.id_kelas not in (select DISTINCT(id_kelas) from user_has_kelas where id_user = $id_user)
        and b.matkul not in (select b.matkul from kelas a
        join matakuliah b on b.id_mk = a.id_mk
        where a.id_kelas in (select DISTINCT(id_kelas) from user_has_kelas where id_user = $id_user))"
            )
        );
        $kelassayas =  DB::select(DB::raw(
            "select *,(select count(id_user) from user_has_kelas c where c.id_kelas=a.id_kelas ) as total from kelas a
        join matakuliah b on a.id_mk = b.id_mk
        join users c on b.id_dosen = c.id
        where a.id_kelas  in (select DISTINCT(id_kelas) from user_has_kelas where id_user = $id_user)"
        ));

        return view('kelasMhs.index', compact('kelass', 'kelassayas'), [
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_user = Auth::id();

        $rules = [
            'id_kelas' => 'required|string|max:255'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->route('kelasMhs.index')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();

            try {
                $idKelas=$data['id_kelas'];
                
                $totalJoin = DB::table('user_has_kelas')->where('id_kelas', $idKelas)->count();
                $slot = KelasAdmin::where('id_kelas', $idKelas)->pluck('slot');
              
                if((int)$slot[0]>=$totalJoin){
                    $User_has_kelas = new User_has_kelas;
                    $User_has_kelas->id_user = $id_user;
                    $User_has_kelas->id_kelas = $data['id_kelas'];
    
    
                    $User_has_kelas->save();
                    return redirect()->route('kelasMhs.index')->with('status', "Berhasil masuk.");
                }else{
                    return redirect()->route('kelasMhs.index')->with('failed', "Gagal masuk.");
                }
                
            } catch (Exception $e) {
                return redirect()->route('kelasMhs.index')->with('failed', "Gagal masuk.");
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
        //
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
        dd($id);
    }

    public function destroyKelas(Request $request)
    {
        try {
            $data = $request->input();
            $id_user = Auth::id();

            $id_kelas = $data['id_kelas'];
            User_has_kelas::where('id_user', '=', $id_user)
                ->where('id_kelas', '=', $id_kelas)
                ->delete();

            return redirect()->route('kelasMhs.index')
                ->with('status', 'Berhasil keluar.');
        } catch (Exception $e) {
            return redirect()->route('kelasMhs.index')
                ->with('failed', 'Berhasil keluar.');
        }
    }
}
