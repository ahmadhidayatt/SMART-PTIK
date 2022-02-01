<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use Maatwebsite\Excel\Excel;
use Illuminate\Http\Request;

class UsersExportController extends Controller
{
    private $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function export(Request $request)
    {
        $input =$request->all();
        return $this->excel->download(new UsersExport($input['id_kelas']), 'Rekap '.$input['matkul'].'.xlsx');
    }
}