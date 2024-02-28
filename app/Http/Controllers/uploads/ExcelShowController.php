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

}
