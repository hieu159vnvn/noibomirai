<?php

namespace App\Exports;
use App\Models\HoSoHocVien;
use Maatwebsite\Excel\Concerns\FromCollection;

class HoSoHocViensExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return HoSoHocVien::all();
    }
}
