<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class PoolsImport implements WithMultipleSheets
{

    /**
     * @return array
     */
    public function sheets(): array
    {
        return [
            0 => new GeneralTrainmanImport(),   //普速列车员
            1 => new GeneralCaptainImport(),    //普速列车长
            2 => new HighTrainmanImport(),      //高铁列车员
            3 => new HighCaptainImport(),       //高铁列车长
        ];
    }

}
