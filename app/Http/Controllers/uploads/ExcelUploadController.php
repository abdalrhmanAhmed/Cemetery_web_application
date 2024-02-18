<?php

namespace App\Http\Controllers\uploads;

use App\Http\Controllers\Controller;
use App\Imports\BurialsImport;
use App\Models\Block;
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

class ExcelUploadController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('ExcelUpload.index');
    }

    public function upload(Request $request)
    {
        try
        {
            // $this->validate($request, [
            //     'file' =>'required|mimes:xls,xlsx'
            // ]);
            foreach ($request->file as $key => $value) 
            {
                $array = Excel::toArray(new BurialsImport, $value);

                foreach ($array[0] as $key => $value) 
                {
                    ExcelTemperary::updateOrCreate([
                        "first_name_ar" => $value['first_name_ar'],
                        "second_name_ar" => $value['second_name_ar'],
                        "third_name_ar" => $value['third_name_ar'],
                        "fourth_name_ar" => $value['fourth_name_ar'],
                        "first_name_en" => $value['first_name_en'],
                        "second_name_en" => $value['second_name_en'],
                        "third_name_en" => $value['third_name_en'],
                        "fourth_name_en" => $value['fourth_name_en'],
                        "national_number" => $value['national_number'],
                        "age" => $value['age'],
                        "gender" => $value['gender'],
                        "religion" => $value['religion'],
                        "nationality" => $value['nationality'],
                        "burial_name_quadruple" => $value['burial_name_quadruple'],
                        "phone_number" => $value['phone_number'],
                        "address" => $value['address'],
                        "email" => $value['email'],
                        "dead_date" => Date::excelToDateTimeObject($value['dead_date']),
                        "burial_date" => Date::excelToDateTimeObject($value['burial_date']),
                        "hopital" => $value['hopital'],
                        "reason_of_death" => $value['reason_of_death'],
                        "cemetry" => $value['cemetry'],
                        "block" => $value['block'],
                        "grave" => $value['grave'],
                        "latitude" => $value['latitude'],
                        "longitude" => $value['longitude'],
                    ]);
                }
            }
            return redirect()->back()->with(['success' => __('Data has been saved successfully!')]);
        }
        catch (\Exception $e)
        {
            return $e;
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
            DB::beginTransaction();
            $temp = ExcelTemperary::all();
            foreach ($temp as $key => $value)
            {

                $cemetry = Cemetery::where('name->ar', 'LIKE' , "%{$value['cemetry']}%")->first();
                // dd($value['cemetry']);
                $block = Block::where('name->ar', 'LIKE' , "%{$value['block']}%")->where('cemetery_id', $cemetry->id)->first();
                $oldGrave = Grave::where('name', 'LIKE' , "%{$value['grave']}%")->first();
                $religion = Religion::where('name->ar', 'LIKE' , "%{$value['religion']}%")->first();
                $nationality = Nationality::where('name->ar', 'LIKE' , "%{$value['nationality']}%")->first();
                $gender = Gander::where('name->ar', 'LIKE' , "%{$value['gender']}%")->first();
                $hospital = Hospital::where('name->ar', 'LIKE' , "%{$value['hopital']}%")->first();
            
                if($oldGrave)
                {
                    $grave = Grave::where('name', 'LIKE' , "%{$value['grave']}%")->first();
                    if($grave->status == 1)
                    {
                        DB::rollBack();
                        return redirect()->back()->with(['error' => __('Grave Already Taken')]);
                    }
                    $grave->status = 1;
                    $grave->latitude = $value['latitude'];
                    $grave->longitude = $value['longitude'];
                    $grave->save();
                }else{
                    $grave = new Grave();
                    $grave->name = $value['grave'];
                    $grave->block_id = $block->id;
                    $grave->status = 1;
                    $grave->latitude = $value['latitude'];
                    $grave->longitude = $value['longitude'];
                    $grave->save();
                }
        

                $deceased = new Dead();
                $deceased->name = ['ar' => $value['first_name_ar'], 'en' => $value['first_name_en']];
                $deceased->father = ['ar' => $value['second_name_ar'], 'en' => $value['second_name_en']];
                $deceased->grand_father = ['ar' => $value['third_name_ar'], 'en' => $value['third_name_en']];
                $deceased->great_grand_father = ['ar' => $value['fourth_name_ar'], 'en' => $value['fourth_name_en']];
                $deceased->identity = $value['national_number'];
                $deceased->age = $value['age'];
                // $deceased->genealogy_id = $value['genealogy_id'];
                $deceased->relagen_id = $religion->id;
                $deceased->national_id = $nationality->id;
                $deceased->gander_id = $gender->id;
                $deceased->save();
    
                $guardian = new Guardian();
                $guardian->name = $value['burial_name_quadruple'];
                $guardian->phone_number = $value['phone_number'];
                $guardian->email = $value['email'];
                $guardian->address = $value['address'];
                $guardian->save();
    
                $information = new Information();
                $information->deceased_id = $deceased->id;
                $information->guardian_id = $guardian->id;
                $information->date_of_death = $value['dead_date'];
                $information->burial_date = $value['burial_date'];
                $information->hospital_id = $hospital->id;
                $information->medical_diagnosis = $value['reason_of_death'];
                $information->grave_id = $grave->id;
                $information->save();
    
                ExcelTemperary::truncate();
                DB::commit();
                return redirect()->route('uploadExcel.index')->with(['success' => __('Data has been saved successfully!')]);;
            }
        }
        catch(\Exception $e)
        {
            DB::rollBack();
            return $e;
            return redirect()->back()->with(['error' => __('There Is A Problem With The Server')]);
        }
        
    }

    public function cancel()
    {
        ExcelTemperary::truncate();
        return redirect()->route('uploadExcel.index');
    }
}
