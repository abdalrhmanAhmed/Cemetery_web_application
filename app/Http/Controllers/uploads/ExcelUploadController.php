<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Imports\BurialsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExcelUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'file' =>'required|mimes:xls,xlsx'
        ]);
        $array = Excel::toArray(new BurialsImport, request()->file('file'));
        
    }
}
