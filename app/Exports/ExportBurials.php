<?php

namespace App\Exports;

use App\Models\BurialExcel;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportBurials implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return BurialExcel::all();
    }
}
