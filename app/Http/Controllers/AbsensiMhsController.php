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
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
use Image;

class absensiMhsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_user = Auth::id();

        $absensis =  DB::select(DB::raw(
            "select * from absensi d
            join kelas a on a.id_kelas = d.id_kelas
            join matakuliah b on a.id_mk = b.id_mk
            join users c on b.id_dosen = c.id
            where a.id_kelas  in (select DISTINCT(id_kelas) from user_has_kelas where id_user = $id_user) and d.status = true"
        ));
        return view('absensiMhs.index', compact('absensis'), [
            "title" => "SMP PTIK | Absensi Mahasiswa",
            "judul" => "Absensi Mahasiswa"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
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
        $rules = [
            //

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('absensiMhs.create')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();

            try {
                $absensimhs = new AbsensiMhs;
                if($request->hasFile('file')) {

                    
                    $image_file = $request->file('file');
                    $contents = $image_file->openFile()->fread($image_file->getSize());

                    $absensimhs->file = $contents;
                   
                }else{
                    
                    $folderPath = public_path('upload/'); 
                    $image_parts = explode(";base64,", $request->sign);                                                
                    $image_type_aux = explode("image/", $image_parts[0]); 
                    $image_type = $image_type_aux[1]; 
                    $image_base64 = base64_decode($image_parts[1]); 
            
                    $file = $folderPath . uniqid() . '.'.$image_type; 
                    $absensimhs->sign = $image_base64;
                }
               
                $absensimhs->kehadiran = $data['kehadiran'];
                $absensimhs->id_absen = $data['id_absen'];
                $absensimhs->id_user =  Auth::id();
                $absensimhs->jam = $data['jam'];


                $absensimhs->save();
                return redirect()->route('absensiMhs.index')->with('status', "Absensi Diterima");
            } catch (Exception $e) {
                return redirect()->route('absensiMhs.index')->with('failed', "Absensi DItolak");
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
        $id_user = Auth::id();

        if (Absensi::find($id)->where('status', false)->where('id_absen', $id)->exists() | AbsensiMhs::where('id_absen', $id)->where('id_user', $id_user)->exists()) {
            return redirect()->route('absensiMhs.index')->with('failed', "Anda Sudah Absen atau Absen Ditutup");
        } else {

            $absensi =  DB::select(DB::raw(
                "select * from absensi d
                join kelas a on a.id_kelas = d.id_kelas
                join matakuliah b on a.id_mk = b.id_mk
                join users c on b.id_dosen = c.id
                where d.id_absen = $id"
            ));
            $absensis = $absensi[0];

            return view('absensiMhs.create', compact('absensis'), [
                "title" => "Isi Absensi",
                "judul" => "Tambah Mata Kuliah"
            ]);
        }
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
        $this->validate($request, [
            'nama' => 'required',
            'nii' => 'required|email|',
            'id_kelas' => 'required'
        ]);

        $input = $request->all();
        $absensi = Absensi::find($id);
        $absensi->update($input);
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
}
