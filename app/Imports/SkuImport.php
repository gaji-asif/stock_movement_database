<?php
namespace App\Imports;
use App\DtbSku;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class SkuImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo "<pre>";
        // print_r($row);
        // exit;
        // return new DtbSku([
        //     'sku_model_no'     => $row[60],
        //     'sku_title'    => $row[67]
        // ]);

        $skus = DtbSku::firstOrCreate(
            ['sku_model_no' => $row[60]],
            ['sku_title' => $row[67]]
        );
    }
}