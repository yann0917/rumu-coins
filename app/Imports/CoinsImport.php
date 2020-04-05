<?php

namespace App\Imports;

use App\Models\GroupCoin;
use Maatwebsite\Excel\Concerns\ToArray;

class CoinsImport implements ToArray
{
    /**
     * @param array $rows
     */
    public function array(array $rows)
    {
        // unset($rows[0]);
        // foreach ($rows as $row) {
        //     GroupCoin::create([
        //         'sn' => $row[0],
        //         'category' => $row[1],
        //         'score' => $row[2],
        //         'sn_no' => $row[3],
        //         'low_price' => $row[4] * 100,
        //         'top_price' => $row[5] * 100,
        //         'group_id' => $row[6],
        //     ]);
        // }
    }
}
