<?php

namespace App\Imports;

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
            '*.first_name_ar' => 'required',
            '*.second_name_ar' => 'required',
            '*.third_name_ar' => 'required',
            '*.fourth_name_ar' => 'required',
            '*.first_name_en' => 'required',
            '*.second_name_en' => 'required',
            '*.third_name_en' => 'required',
            '*.fourth_name_en' => 'required',
            '*.national_number' => 'required',
            '*.age' => 'required',
            '*.gender' => 'required',
            '*.religion' => 'required',
            '*.nationality' => 'required',
            '*.burial_name_quadruple' => 'required',
            '*.phone_number' => 'required',
            // '*.address' => 'required',
            // '*.email' => 'required',
            '*.dead_date' => 'required',
            '*.burial_date' => 'required',
            '*.hopital' => 'required',
            '*.reason_of_death' => 'required',
            '*.cemetry' => 'required',
            '*.block' => 'required',
            '*.grave' => 'required',
            '*.latitude' => 'required',
            '*.longitude' => 'required',
        ])->validate();

        foreach ($rows as $row) {
            $deceased = new Dead();
            $deceased->name = ['ar' => $row['first_name_ar'], 'en' => $row['first_name_en']];
            $deceased->father = ['ar' => $row['second_name_ar'], 'en' => $row['second_name_en']];
            $deceased->grand_father = ['ar' => $row['third_name_ar'], 'en' => $row['third_name_en']];
            $deceased->great_grand_father = ['ar' => $row['fourth_name_ar'], 'en' => $row['fourth_name_en']];
            $deceased->identity = $row['national_number'];
            $deceased->age = $row['age'];
            // $deceased->genealogy_id = $row['genealogy_id'];
            $deceased->relagen_id = $row['religion'];
            $deceased->national_id = $row['nationality'];
            $deceased->gander_id = $row['gender'];
            $deceased->save();

            $guardian = new Guardian();
            $guardian->name = $row['burial_name_quadruple'];
            $guardian->phone_number = $row['phone_number'];
            $guardian->email = $row['email'];
            $guardian->address = $row['address'];
            $guardian->save();

            $information = new Information();
            $information->deceased_id = $deceased->id;
            $information->guardian_id = $guardian->id;
            $information->hospital_id = $row['hopital'];
            $information->grave_id = $row['grave_id'];
            $information->medical_diagnosis = $row['reason_of_death'];
            $information->date_of_death = Date::excelToDateTimeObject($row['dead_date'])->format('y-m-d');
            $information->burial_date = Date::excelToDateTimeObject($row['burial_date'])->format('y-m-d');
            $information->save();
        }
    }
}
