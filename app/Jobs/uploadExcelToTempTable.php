<?php

namespace App\Jobs;

use App\Models\ExcelTemperary;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Illuminate\Bus\Batchable;

class uploadExcelToTempTable implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $header;
    public $data;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data, $header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->data as $value)
        {
            $temp = array_combine($this->header, $value);
            ExcelTemperary::create($temp);
            // dd($value);
            // ExcelTemperary::updateOrCreate([
            //     "FID" => $value['fid'],
            //     "Cemetery_I" => $value['cemetery_i'] ,
            //     "Grave_Sequ" => $value['grave_sequ'] ?? 0,
            //     "Grave_Code" => $value['grave_code'] ?? 0,
            //     "Grave_Co_1" => $value['grave_co_1'] ?? 0,
            //     "Emirates_I" => $value['emirates_i'] ?? 0,
            //     "Name" => $value['name'] ?? 0,
            //     "Nationalit" => $value['nationalit'] ?? 0,
            //     "Date_Of_De" => Date::excelToDateTimeObject($value['date_of_de']) ?? 0,
            //     "Burial_Dat" => Date::excelToDateTimeObject($value['burial_dat']) ?? 0,
            //     "Shahed_Num" => $value['shahed_num'] ?? 0,
            //     "Hospital" => $value['hospital'] ?? 0,
            //     "Cause_Of_D" => $value['cause_of_d'] ?? 0,
            //     "Cemetery_N" => $value['cemetery_n'] ?? 0,
            //     "Death_Repo" => $value['death_repo'] ?? 0,
            //     "Death_Cert" => $value['death_cert'] ?? 0,
            //     "Hospital_R" => $value['hospital_r'] ?? 0,
            //     "Police_Mes" => $value['police_mes'] ?? 0,
            //     "Comments" => $value['comments'] ?? 0,
            //     "Northing" => $value['northing'] ?? 0,
            //     "Easting" => $value['easting'] ?? 0,
            //     "Elevation" => $value['elevation'] ?? 0,
            //     "Embassy_No" => $value['embassy_no'] ?? 0,
            //     "Sex" => $value['sex'] ?? 0,
            //     "Country" => $value['country'] ?? 0,
            //     "Emirates" => $value['emirates'] ?? 0,
            //     "NameAr" => $value['namear'] ?? 0,
            //     "NameEn" => $value['nameen'] ?? 0,
            //     "Sectors_Ar" => $value['sectors_ar'] ?? 0,
            //     "Sectors_En" => $value['Sectors_En'] ?? 0,
            //     "X" => $value['x'] ?? 0,
            //     "Y" => $value['y'] ?? 0,
            //     "XY" => $value['xy'] ?? 0,
            // ]);
        }
    }
}
