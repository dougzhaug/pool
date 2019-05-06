<?php
/**
 * Created by PhpStorm.
 * User: coolong
 * Date: 2019/5/6
 * Time: 18:52
 */

namespace App\Imports;

use App\Models\Pool;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Row;

class GeneralCaptainImport implements OnEachRow
{

    /**
     * 普速列车长
     *
     * @param Row $row
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        if($rowIndex > 2){
            $first = Pool::where(['subject_id'=>2,'sn'=>$row[0]])->first();
            if(!$first){
                Pool::create([
                    'subject_id' => 2,
                    'sn' => $row[0]??0,
                    'question'=>$row[1]??'',
                    'answers' => $row[2]??'',
                    'status' => 1,
                    'score' => $row[3]??0,
                    'answer_time' => $row[4]??0,
                ]);
            }

        }

    }
}