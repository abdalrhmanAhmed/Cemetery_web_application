<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Models\BurialExcel;
use App\Models\Cemetery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;

class ExcelShowController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        $burials = BurialExcel::all();
        $cemetries = Cemetery::all();
        return view('ExcelUpload.excelShow', compact('burials', 'cemetries'));
    }

    public function filtter(Request $request)
    {
        if($request->cemetery_id)
        {
            $cemetry = Cemetery::where('id', $request->cemetery_id)->first();
            $burials = BurialExcel::where('Cemetery_N', 'like', '%'.$cemetry->name.'%')->get();
        }else{
            $burials = BurialExcel::all();
        }
        $header = Schema::getColumnListing('burial_excels');
        $data = [];
        $data[] = $header;
        foreach($burials as $burial)
        {
            $data[] = $burial;
        }
        
        // Excel::download($data);
        $cemetries = Cemetery::all();
        return view('ExcelUpload.excelShow', compact('burials', 'cemetries'));

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

    public function bulck_delete(Request $request)
    {
        // return $request;
        if(empty($request->burial_id))
        {
            return redirect()->route('ExcelShow.index')->with(['error' => __('Please Select at least one record!')]);
        }
        foreach($request->burial_id as $id)
        {
            $burial = BurialExcel::where('id', $id)->first();
            $burial->delete();
        }
        return redirect()->route('ExcelShow.index')->with(['warning' => __('Data has been Deleted successfully!')]);
    }

    public function delete(Request $request)
    {
        $burial = BurialExcel::where('id', $request->id)->first();
        $burial->delete();
        return redirect()->route('ExcelShow.index')->with(['warning' => __('Data has been Deleted successfully!')]);
    }

}
