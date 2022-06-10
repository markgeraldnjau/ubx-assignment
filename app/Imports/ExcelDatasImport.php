<?php

namespace App\Imports;

use App\Models\ExcelData;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ExcelDatasImport implements ToModel, WithStartRow, WithCalculatedFormulas
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function startRow(): int
    {
        return 2;
    }
    
    public function model(array $row)
    {
        $data = [

            'cargo_no' => $row[0],
            'cargo_type' => $row[1],
            'cargo_size' => $row[2],
            'weight' => $row[3],
            'remarks' => $row[4],
            'wharfage' => $row[5],
            'penalty' => $row[6],
            'storage' => $row[7],
            'electricity' => $row[8],
            'destuffing' => $row[9],
            'lifting' => $row[10],

        ];

        ExcelData::create($data);
    }
}
