<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DashboardAdmin;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DashboardAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dashboard = DB::table('dashboards')->paginate(5);
       
        return view('dashboardAdmin.index', compact('dashboard'), [
            "title" => "SMP PTIK | Dashboard",
            "judul" => "Dashboard"
        ]);


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboardAdmin.create', [
            "title" => "SMP PTIK | Dashboard",
            "judul" => "Dashboard"
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
			'info' => 'required|string|min:5|max:255',

		];
		$validator = Validator::make($request->all(),$rules);
		if ($validator->fails()) {
			return redirect('dashboardAdmin/create')
			->withInput()
			->withErrors($validator);
		}
		else{
            $data = $request->input();
			try{
                
				$db = new DashboardAdmin;
                $db->info = $data['info'];

				$db->save();
				return redirect()->route('dashboardAdmin.index')->with('status',"Insert successfully");
			}
			catch(Exception $e){
				return redirect()->route('dashboardAdmin.index')->with('failed',"operation failed");
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
        return view('dashboardAdmin.edit', [
            "title" => "SMP PTIK | Edit Dashboard",
            "judul" => "Edit Dashboard"
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
        DashboardAdmin::find($id)->delete();
        return redirect()->route('dashboardAdmin.index')
            ->with('status', 'Informasi Berhasil Dihapus');
    }
}
