<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Imports\BurialsImport;
use App\Jobs\uploadExcelToTempTable;
use App\Models\Block;
use App\Models\BurialExcel;
use App\Models\Cemetery;
use App\Models\Dead;
use App\Models\ExcelTemperary;
use App\Models\Gander;
use App\Models\Grave;
use App\Models\Guardian;
use App\Models\Hospital;
use App\Models\Information;
use App\Models\Nationality;
use App\Models\Religion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class ExcelUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() : View
    {
        return view('ExcelUpload.index');
    }

    public function upload(Request $request)
    {
        try
        {
            $this->validate($request, [
                'file' =>'required'
            ]);
            $array = Excel::toArray(new BurialsImport, $request->file);
            foreach ($array[0] as $key => $value)
            {
                ExcelTemperary::updateOrCreate([
                    "cemetery_id"                   => $value['cemetery_id'] ?? '',
                    "grave_sequence"                => $value['grave_sequence'] ?? '',
                    "grave_code"                    => $value['grave_code']  ?? '',
                    "grave_code2"                   => $value['grave_code2']  ?? '',
                    "emirates_id"                   => $value['emirates_id']  ?? '',
                    "hospital_certificate_number"   => $value['hospital_certificate_number']  ?? '',
                    "legacy_coding"                 => $value['legacy_coding']  ?? '',
                    "name"                          => $value['name']  ?? '',
                    "cause_of_death"                => $value['cause_of_death'] ?? '',
                    "kinship"                       => $value['kinship'] ?? '',
                    "case_number"                   => $value['case_number']  ?? '',
                    "case_type"                     => $value['case_type']  ?? '',
                    "nationality"                   => $value['nationality']  ?? '',
                    "date_of_death"                 => $value['date_of_death']  ?? '',
                    "burial_date"                   => $value['burial_date']  ?? '',
                    "shahed_number"                 => $value['shahed_number']  ?? '',
                    "hospital"                      => $value['hospital']  ?? '',
                    "cemetery_name"                 => $value['cemetery_name']  ?? '',
                    "death_report"                  => $value['death_report']  ?? '',
                    "death_certificate"             => $value['death_certificate']  ?? '',
                    "hospital_report"               => $value['hospital_report']  ?? '',
                    "police_message"                => $value['police_message']  ?? '',
                    "comments"                      => $value['comments']  ?? '',
                    "northing"                      => $value['northing']  ?? '',
                    "easting"                       => $value['easting']  ?? '',
                    "elevation"                     => $value['elevation']  ?? '',
                    "embassy_notes"                 => $value['embassy_notes']  ?? '',
                    "gender"                        => $value['gender']  ?? '',
                    "country"                       => $value['country']  ?? '',
                    "emirates"                      => $value['emirates']  ?? '',
                    "namear"                        => $value['namear']  ?? '',
                    "nameen"                        => $value['nameen']  ?? '',
                    "sectors_ar"                    => $value['sectors_ar']  ?? '',
                    "sectors_en"                    => $value['sectors_en']  ?? '',
                    "x"                             => $value['x']  ?? '',
                    "y"                             => $value['y']  ?? '',
                    "xy"                            => $value['xy']  ?? '',
                ]);
            }
            $file_name =  $request->file('file')->getClientOriginalName();
            $path = public_path('assets/uploads/excel/');
            file_put_contents($path. $file_name, file_get_contents($request->file('file')));

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        }
        catch (\Exception $e)
        {
            return redirect()->back()->with(['error' => __('Some thing bad in data')]);        
        }
    }

    public function review()
    {
        $data = ExcelTemperary::all();
        return view('ExcelUpload.review', compact('data'));
    }

    public function confirm()
    {
        try
        {
            $temp = ExcelTemperary::all();
            foreach($temp as $value)
            {
                $burials = new BurialExcel();
                $burials->cemetery_id                 = $value['cemetery_id'] ?? '';
                $burials->grave_sequence              = $value['grave_sequence'] ?? '';
                $burials->grave_code                  = $value['grave_code']  ?? '';
                $burials->grave_code2                 = $value['grave_code2']  ?? '';
                $burials->emirates_id                 = $value['emirates_id']  ?? '';
                $burials->hospital_certificate_number = $value['hospital_certificate_number']  ?? '';
                $burials->legacy_coding               = $value['legacy_coding']  ?? '';
                $burials->name                        = $value['name']  ?? '';
                $burials->cause_of_death              = $value['cause_of_death'] ?? '';
                $burials->kinship                     = $value['kinship'] ?? '';
                $burials->case_number                 = $value['case_number']  ?? '';
                $burials->case_type                   = $value['case_type']  ?? '';
                $burials->nationality                 = $value['nationality']  ?? '';
                $burials->date_of_death               = $value['date_of_death']  ?? '';
                $burials->burial_date                 = $value['burial_date']  ?? '';
                $burials->shahed_number               = $value['shahed_number']  ?? '';
                $burials->hospital                    = $value['hospital']  ?? '';
                $burials->cemetery_name               = $value['cemetery_name']  ?? '';
                $burials->death_report                = $value['death_report']  ?? '';
                $burials->death_certificate           = $value['death_certificate']  ?? '';
                $burials->hospital_report             = $value['hospital_report']  ?? '';
                $burials->police_message              = $value['police_message']  ?? '';
                $burials->comments                    = $value['comments']  ?? '';
                $burials->northing                    = $value['northing']  ?? '';
                $burials->easting                     = $value['easting']  ?? '';
                $burials->elevation                   = $value['elevation']  ?? '';
                $burials->embassy_notes               = $value['embassy_notes']  ?? '';
                $burials->gender                      = $value['gender']  ?? '';
                $burials->country                     = $value['country']  ?? '';
                $burials->emirates                    = $value['emirates']  ?? '';
                $burials->namear                      = $value['namear']  ?? '';
                $burials->nameen                      = $value['nameen']  ?? '';
                $burials->sectors_ar                  = $value['sectors_ar']  ?? '';
                $burials->sectors_en                  = $value['sectors_en']  ?? '';
                $burials->x                           = $value['x']  ?? '';
                $burials->y                           = $value['y']  ?? '';
                $burials->xy                          = $value['xy']  ?? '';
                $burials->save();
            }

            ExcelTemperary::truncate();
            return redirect()->route('cemetery-site.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => __('There Is A Problem With The Server')]);
        }
    }

    public function cancel()
    {
        ExcelTemperary::truncate();
        return redirect()->route('cemetery-site.index');
    }
}
