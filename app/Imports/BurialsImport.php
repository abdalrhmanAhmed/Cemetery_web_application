<?php

namespace App\Imports;

use App\Models\BurialExcel;
use App\Models\Dead;
use App\Models\Guardian;
use App\Models\Information;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class BurialsImport implements ToCollection, WithHeadingRow
{
    use Importable;
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        Validator::make($rows->toArray(), [
            '*.FID' => 'required',
            '*.Cemetery_I' => 'required',
            '*.Grave_Sequ' => 'required',
            '*.Grave_Code' => 'required',
            '*.Grave_Co_1' => 'required',
            '*.Emirates_I' => 'required',
            '*.Name' => 'required',
            '*.Nationalit' => 'required',
            '*.Date_Of_De' => 'required',
            '*.Burial_Dat' => 'required',
            '*.Shahed_Num' => 'required',
            '*.Hospital' => 'required',
            '*.Cause_Of_D' => 'required',
            '*.Cemetery_N' => 'required',
            '*.Death_Repo' => 'required',
            '*.Death_Cert' => 'required',
            '*.Hospital_Rs' => 'required',
            '*.Police_Mes' => 'required',
            '*.Comments' => 'required',
            '*.Northing' => 'required',
            '*.Easting' => 'required',
            '*.Elevation' => 'required',
            '*.Embassy_Nos' => 'required',
            '*.Sex' => 'required',
            '*.Country' => 'required',
            '*.Emirates' => 'required',
            '*.NameAr' => 'required',
            '*.NameEn' => 'required',
            '*.Sectors_Ar' => 'required',
            '*.Sectors_En' => 'required',
            '*.X' => 'required',
            '*.Y' => 'required',
            '*.XY' => 'required',
        ])->validate();

        foreach ($rows as $row) {
            $burial = new BurialExcel();
            $burial->FID = $row['FID'];
            $burial->Cemetery_I = $row['Cemetery_I'];
            $burial->Grave_Sequ = $row['Grave_Sequ'];
            $burial->Grave_Code = $row['Grave_Code'];
            $burial->Grave_Co_1 = $row['Grave_Co_1'];
            $burial->Emirates_I = $row['Emirates_I'];
            $burial->Name = $row['Name'];
            $burial->Nationalit = $row['Nationalit'];
            $burial->Date_Of_De = $row['Date_Of_De'];
            $burial->Burial_Dat = $row['Burial_Dat'];
            $burial->Shahed_Num = $row['Shahed_Num'];
            $burial->Hospital = $row['Hospital'];
            $burial->Cause_Of_D = $row['Cause_Of_D'];
            $burial->Cemetery_N = $row['Cemetery_N'];
            $burial->Death_Repo = $row['Death_Repo'];
            $burial->Death_Cert = $row['Death_Cert'];
            $burial->Hospital_R = $row['Hospital_R'];
            $burial->Police_Mes = $row['Police_Mes'];
            $burial->Comments = $row['Comments'];
            $burial->Northing = $row['Northing'];
            $burial->Easting = $row['Easting'];
            $burial->Elevation = $row['Elevation'];
            $burial->Embassy_No = $row['Embassy_No'];
            $burial->Sex = $row['Sex'];
            $burial->Country = $row['Country'];
            $burial->Emirates = $row['Emirates'];
            $burial->NameAr = $row['NameAr'];
            $burial->NameEn = $row['NameEn'];
            $burial->Sectors_Ar = $row['Sectors_Ar'];
            $burial->Sectors_En = $row['Sectors_En'];
            $burial->X = $row['X'];
            $burial->Y = $row['Y'];
            $burial->XY = $row['XY'];
            $burial->save();
        }
    }
}
