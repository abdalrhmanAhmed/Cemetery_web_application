<?php

namespace App\Http\Controllers\new;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// modles
use App\Models\BurialExcel;

class ReportController extends Controller
{
        public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $year = date_format(now(),'Y');
        $year2 = date_format(now(),'Y');
        return view('new.reports.index', compact('year','year2'));
    }
    public function filtter(Request $request)
    {
        $year = $request->year ?? date_format(now(),'Y');
        $year2 = $request->year2 ?? date_format(now(),'Y');
        return view('new.reports.index', compact('year','year2'));
    }
}
