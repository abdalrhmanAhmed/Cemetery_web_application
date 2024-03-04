<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Models\BurialExcel;
use Illuminate\Http\Request;

class ExcelShowController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $burials = BurialExcel::all();
        return view('ExcelUpload.excelShow', compact('burials'));
    }

    public function upload(Request $request)
    {
        if($request->has('csv'))
        {
            return array_map('str_getcsv',mb_convert_encoding(file($request->csv), 'UTF-8', 'UTF-8'));
            $csv = mb_convert_encoding($request->csv, 'UTF-8', 'UTF-8');
            return array_map('str_getcsv', file($request->csv));
        }
    }

}
