<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Mkuliah;
use App\Models\User;

class MkuliahController extends Controller
{
    public function index(){
		
		$matkuls = DB::table('matakuliah')
            ->join('users', 'id_dosen', '=', 'users.id')
            ->get();
        return view('mkuliah', compact('matkuls'), [
            "title" => "SMP PTIK | Daftar Mata Kuliah",
            "judul" => "Daftar Mata Kuliah"
        ]);
    }

    public function create()
    {	
		
		$select_dosen = User::where('role','dosen')
        ->orderBy('name', 'ASC')
        ->pluck('name','id');
        return view('tambahmk', compact('select_dosen'),[
            "title" => "SMP PTIK | Tambah Mata Kuliah",
            "judul" => "Mata Kuliah"
         ]);
    }

    public function store(Request $request)
    {
        $rules = [
			'matkul' => 'required|string|min:3|max:255',
			'id_dosen' => 'required|string|min:1|max:255',

		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('mkuliah/create')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
                
				$matkul = new Mkuliah;
                $matkul->matkul = $data['matkul'];
                $matkul->id_dosen = $data['id_dosen'];

				$matkul->save();
				return redirect()->route('mkuliah.index')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->route('mkuliah.index')->with('failed',"operation failed");
			}
		}
    }

	public function edit($id_mk)
    {
        $select_dosen = User::where('role','dosen')
        ->orderBy('name', 'ASC')->pluck('name','id');
		$matkul = Mkuliah::find($id_mk);
        return view('editmk', compact('matkul','id_mk','select_dosen'),[
            "title" => "Data Mata Kuliah",
            "judul" => "Tambah Mata Kuliah"
        ]);
  
    
    }

    public function update(Request $request, $id)
    {
        $rules = [
			'matkul' => 'required|string|min:3|max:255',
			'id_dosen' => 'required|string|min:1|max:255',

		];
		$validator = Validator::make($request->all(),$rules);
            $data = $request->input();
			try{
                
				$matkul = new Mkuliah;
                
                $matkul ->where('id_mk', $id)
                ->update([
                    'matkul'     => $data['matkul'],
                    'id_dosen'   =>$data['id_dosen'],
                ]);
                
				return redirect()->route('mkuliah.index')->with('status',"Mata Kuliah Berhasil Diupdate");
			}
			catch(Exception $e){
				return redirect()->route('mkuliah.index')->with('failed',"Mata Kuliah Gagal Diupdate");
			}

    }

	public function destroy($id)
    {
		Mkuliah::find($id)->delete();
        return redirect()->route('mkuliah.index')
            ->with('status', 'Mata Kuliah Berhasil Dihapus');
    }
    public function show($id)
    {
        $userData =Mkuliah::find($id)->pluck('id_dosen');
        dd($userData);
        $user = User::find($id);

        return view('user', compact('user'));
    }
    public function getDosenByIdmk($id = 0){
    
        $id_dosen =Mkuliah::where('id_mk',$id)->pluck('id_dosen');
        $namaDosen =User::where('id',$id_dosen)->pluck('name');
        return $namaDosen;
    }
}
