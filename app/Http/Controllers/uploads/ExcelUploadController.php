<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Imports\BurialsImport;
use App\Models\BurialExcel;
use App\Models\ExcelTemperary;
use App\Models\CemeterySites;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class ExcelUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($id)
    {
        return view('ExcelUpload.index', compact('id'));
    }

    public function upload(Request $request, $id)
    {
        try {
            $this->validate($request, [
                'file' => 'required|file'
            ]);

            $file = $request->file('file');
            $file_name = $file->getClientOriginalName();

            // Check if the file already exists in the database
            if (ExcelTemperary::where('file_name', $file_name)->exists()) {
                return redirect()->back()->with(['error' => __('File already exists')]);
            }

            // Store the file in the public/assets/uploads/excel/ directory
            $path = public_path('assets/uploads/excel/');
            if (!File::isDirectory($path)) {
                File::makeDirectory($path, 0777, true, true);
            }
            $file->move($path, $file_name);

            // Verify the file path
            $filePath = $path . $file_name;
            if (!File::exists($filePath)) {
                return redirect()->back()->with(['error' => __('File upload failed')]);
            }

            $array = Excel::toArray(new BurialsImport, $filePath);
            foreach ($array[0] as $value) {
            // Parse date fields if they exist
            $date_of_death = isset($value['date_of_death']) ? $this->transformDate($value['date_of_death']) : null;
            $burial_date = isset($value['burial_date']) ? $this->transformDate($value['burial_date']) : null;
                ExcelTemperary::updateOrCreate([
                    "cemetery_id"                   => $value['cemetery_id'] ?? 0,
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
                    "date_of_death"                 => $date_of_death  ?? '',
                    "burial_date"                   => $burial_date ?? '',
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
                    "file_name"                     => $file_name,
                    "cemetery_app_id"               => $id ?? 0,
                ]);
            }

            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        } catch (\Exception $e) {
            return $e;//redirect()->back()->with(['error' => __('Something went wrong with the data')]);
        }
    }

    public function review()
    {
        $data = ExcelTemperary::all();
        return view('ExcelUpload.review', compact('data'));
    }

    public function confirm()
    {
        try {
            $temp = ExcelTemperary::all();
            foreach ($temp as $value) {
                $burials = new BurialExcel();
                $burials->cemetery_id = $value['cemetery_id'] ?? 0;
                $burials->grave_sequence = $value['grave_sequence'] ?? '';
                $burials->grave_code = $value['grave_code'] ?? '';
                $burials->grave_code2 = $value['grave_code2'] ?? '';
                $burials->emirates_id = $value['emirates_id'] ?? '';
                $burials->hospital_certificate_number = $value['hospital_certificate_number'] ?? '';
                $burials->legacy_coding = $value['legacy_coding'] ?? '';
                $burials->name = $value['name'] ?? '';
                $burials->cause_of_death = $value['cause_of_death'] ?? '';
                $burials->kinship = $value['kinship'] ?? '';
                $burials->case_number = $value['case_number'] ?? '';
                $burials->case_type = $value['case_type'] ?? '';
                $burials->nationality = $value['nationality'] ?? '';
                $burials->date_of_death = $value['date_of_death'] ?? '';
                $burials->burial_date = $value['burial_date'] ?? '';
                $burials->shahed_number = $value['shahed_number'] ?? '';
                $burials->hospital = $value['hospital'] ?? '';
                $burials->cemetery_name = $value['cemetery_name'] ?? '';
                $burials->death_report = $value['death_report'] ?? '';
                $burials->death_certificate = $value['death_certificate'] ?? '';
                $burials->hospital_report = $value['hospital_report'] ?? '';
                $burials->police_message = $value['police_message'] ?? '';
                $burials->comments = $value['comments'] ?? '';
                $burials->northing = $value['northing'] ?? '';
                $burials->easting = $value['easting'] ?? '';
                $burials->elevation = $value['elevation'] ?? '';
                $burials->embassy_notes = $value['embassy_notes'] ?? '';
                $burials->gender = $value['gender'] ?? '';
                $burials->country = $value['country'] ?? '';
                $burials->emirates = $value['emirates'] ?? '';
                $burials->namear = $value['namear'] ?? '';
                $burials->nameen = $value['nameen'] ?? '';
                $burials->sectors_ar = $value['sectors_ar'] ?? '';
                $burials->sectors_en = $value['sectors_en'] ?? '';
                $burials->x = $value['x'] ?? '';
                $burials->y = $value['y'] ?? '';
                $burials->xy = $value['xy'] ?? '';
                $burials->file_name = $value['file_name'];
                $burials->cemetery_app_id = $value['cemetery_app_id'] ?? 0;

                $burials->save();
                $site = CemeterySites::where('id', $value['cemetery_app_id'])->first();
                $site->update(['dead_total' => $site['dead_total'] + 1]);
            }

            ExcelTemperary::truncate();
            return redirect()->route('cemetery-site.index')->with(['success' => __('Data has been saved successfully!')]);
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => __('There is a problem with the server')]);
        }
    }
    public function cancel()
    {
        $temp = ExcelTemperary::all();
        foreach ($temp as $value)
        {
            $path = public_path('assets/uploads/excel/' . $value['file_name']);
            if (!empty($value['file_name']) && File::exists($path))
            {
                File::delete($path);
            }
        }
        ExcelTemperary::truncate();
        return redirect()->route('cemetery-site.index');
    }


    public function downloadFile($file_name)
        {
            // Ensure the file exists
            $path = public_path('assets/uploads/excel/' . $file_name);
            if (!File::exists($path)) {
                abort(404);
            }

            // Download the file
            return response()->download($path);
        }
    private function transformDate($value)
    {
        // Check if value is numeric (Excel date serial number)
        if (is_numeric($value)) {
            // Convert Excel date serial number to a Carbon date
            return Carbon::instance(Date::excelToDateTimeObject($value));
        }

        // Attempt to parse as a regular date string
        try {
            return Carbon::parse($value);
        } catch (\Exception $e) {
            return null;
        }
    }
}
