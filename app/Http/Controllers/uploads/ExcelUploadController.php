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
        if($request->has('file'))
        {
            // return $request;
            $excel = file($request->file);
            $chunks = array_chunk($excel, 1000);
            $header = [];
            $batch = Bus::batch([])->dispatch();

            foreach($chunks as $key => $chunk)
            {
                dd($chunk);
                $data = array_map('str_getcsv', $chunk);
                if($key == 0)
                {
                    $header = $data[0];
                    unset($data[0]);
                }
                $batch->add(new uploadExcelToTempTable($data, $header));
            }
            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        }else{
            return redirect()->back()->with(['error' => __('Please Upload An Excel File !!')]);
        }


        // try
        // {
        //     $this->validate($request, [
        //         'file' =>'required'
        //     ]);
        //     foreach ($request->file as $key => $file)
        //     {
        //         $array = Excel::toArray(new BurialsImport, $file);
        //         // return $array;
        //         uploadExcelToTempTable::dispatch($array[0]);

        //     }
        //     return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        // }
        // catch (\Exception $e)
        // {
        //     return $e;
        // }
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
            // return $temp;
            foreach($temp as $data)
            {
                $burials = new BurialExcel();
                $burials->FID = $data['FID'];
                $burials->Cemetery_I = $data['Cemetery_I'] ;
                $burials->Grave_Sequ = $data['Grave_Sequ'] ?? 0;
                $burials->Grave_Code = $data['Grave_Code'] ?? 0;
                $burials->Grave_Co_1 = $data['Grave_Co_1'] ?? 0;
                $burials->Emirates_I = $data['Emirates_I'] ?? 0;
                $burials->Name = $data['Name'] ?? 0;
                $burials->Nationalit = $data['Nationalit'] ?? 0;
                $burials->Date_Of_De = $data['Date_Of_De'] ?? 0;
                $burials->Burial_Dat = $data['Burial_Dat'] ?? 0;
                $burials->Shahed_Num = $data['Shahed_Num'] ?? 0;
                $burials->Hospital = $data['Hospital'] ?? 0;
                $burials->Cause_Of_D = $data['Cause_Of_D'] ?? 0;
                $burials->Cemetery_N = $data['Cemetery_N'] ?? 0;
                $burials->Death_Repo = $data['Death_Repo'] ?? 0;
                $burials->Death_Cert = $data['Death_Cert'] ?? 0;
                $burials->Hospital_R = $data['Hospital_R'] ?? 0;
                $burials->Police_Mes = $data['Police_Mes'] ?? 0;
                $burials->Comments = $data['Comments'] ?? 0;
                $burials->Northing = $data['Northing'] ?? 0;
                $burials->Easting = $data['Easting'] ?? 0;
                $burials->Elevation = $data['Elevation'] ?? 0;
                $burials->Embassy_No = $data['Embassy_No'] ?? 0;
                $burials->Sex = $data['Sex'] ?? 0;
                $burials->Country = $data['Country'] ?? 0;
                $burials->Emirates = $data['Emirates'] ?? 0;
                $burials->NameAr = $data['NameAr'] ?? 0;
                $burials->NameEn = $data['NameEn'] ?? 0;
                $burials->Sectors_Ar = $data['Sectors_Ar'] ?? 0;
                $burials->Sectors_En = $data['Sectors_En'] ?? 0;
                $burials->X = $data['X'] ?? 0;
                $burials->Y = $data['Y'] ?? 0;
                $burials->XY = $data['XY'] ?? 0;
                $burials->save();
            }

            ExcelTemperary::truncate();
            return redirect()->route('uploadExcel.index')->with(['success' => __('Data has been saved successfully!')]);
        }
        catch(\Exception $e)
        {
            return redirect()->back()->with(['error' => __('There Is A Problem With The Server')]);
        }

        //old code
        // try
        // {
        //     $temp = ExcelTemperary::all();
        //     foreach ($temp as $key => $value)
        //     {

        //         $cemetry = Cemetery::where('name->ar', 'LIKE' , "%{$value['cemetry']}%")->first();
        //         // dd($value['cemetry']);
        //         $block = Block::where('name->ar', 'LIKE' , "%{$value['block']}%")->where('cemetery_id', $cemetry->id)->first();
        //         $oldGrave = Grave::where('name', 'LIKE' , "%{$value['grave']}%")->first();
        //         $religion = Religion::where('name->ar', 'LIKE' , "%{$value['religion']}%")->first();
        //         $nationality = Nationality::where('name->ar', 'LIKE' , "%{$value['nationality']}%")->first();
        //         $gender = Gander::where('name->ar', 'LIKE' , "%{$value['gender']}%")->first();
        //         $hospital = Hospital::where('name->ar', 'LIKE' , "%{$value['hopital']}%")->first();

        //         DB::beginTransaction();
        //         if($oldGrave)
        //         {
        //             $grave = Grave::where('name', 'LIKE' , "%{$value['grave']}%")->first();
        //             if($grave->status == 1)
        //             {
        //                 DB::rollBack();
        //                 return redirect()->back()->with(['error' => __('Grave Already Taken')]);
        //             }
        //             $grave->status = 1;
        //             $grave->latitude = $value['latitude'];
        //             $grave->longitude = $value['longitude'];
        //             $grave->save();
        //         }else{
        //             $grave = new Grave();
        //             $grave->name = $value['grave'];
        //             $grave->block_id = $block->id;
        //             $grave->status = 1;
        //             $grave->latitude = $value['latitude'];
        //             $grave->longitude = $value['longitude'];
        //             $grave->save();
        //         }


        //         $deceased = new Dead();
        //         $deceased->name = ['ar' => $value['first_name_ar'], 'en' => $value['first_name_en']];
        //         $deceased->father = ['ar' => $value['second_name_ar'], 'en' => $value['second_name_en']];
        //         $deceased->grand_father = ['ar' => $value['third_name_ar'], 'en' => $value['third_name_en']];
        //         $deceased->great_grand_father = ['ar' => $value['fourth_name_ar'], 'en' => $value['fourth_name_en']];
        //         $deceased->identity = $value['national_number'];
        //         $deceased->age = $value['age'];
        //         // $deceased->genealogy_id = $value['genealogy_id'];
        //         $deceased->relagen_id = $religion->id;
        //         $deceased->national_id = $nationality->id;
        //         $deceased->gander_id = $gender->id;
        //         $deceased->save();

        //         $guardian = new Guardian();
        //         $guardian->name = $value['burial_name_quadruple'];
        //         $guardian->phone_number = $value['phone_number'];
        //         $guardian->email = $value['email'];
        //         $guardian->address = $value['address'];
        //         $guardian->save();

        //         $information = new Information();
        //         $information->deceased_id = $deceased->id;
        //         $information->guardian_id = $guardian->id;
        //         $information->date_of_death = $value['dead_date'];
        //         $information->burial_date = $value['burial_date'];
        //         $information->hospital_id = $hospital->id;
        //         $information->medical_diagnosis = $value['reason_of_death'];
        //         $information->grave_id = $grave->id;
        //         $information->save();
        //         DB::commit();
        //     }
        //     ExcelTemperary::truncate();
        //     return redirect()->route('uploadExcel.index')->with(['success' => __('Data has been saved successfully!')]);;
        // }
        // catch(\Exception $e)
        // {
        //     DB::rollBack();
        //     return $e;
        //     return redirect()->back()->with(['error' => __('There Is A Problem With The Server')]);
        // }

    }

    public function cancel()
    {
        ExcelTemperary::truncate();
        return redirect()->route('uploadExcel.index');
    }
}
