<?php
namespace App\Imports;
use App\DtbItem;
use App\DtbSku;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ItemImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // echo "<pre>";
        // echo $row[34]; exit;
        // print_r($row);
        // exit;


        return new DtbItem([
            'unit_id'     => $row[1],
            'lot_id'    => $row[2],
            'asset_tag'    => $row[2],
            'product_type'     => $row[4],
            'manufacturer'    => $row[5],
            'model'     => $row[6],
            'part_number'    => $row[7],
            'sl_number'     => $row[8],
            'display_size'    => $row[9],
            'resulation'     => $row[10],
            'processor'    => $row[11],
            'storage_1_size'     => $row[14],
            'storage_1_type'    => $row[15],
            'optical'    => $row[16],
            'keyb'     => $row[17],
            'webcam'    => $row[18],
            'video_card'    => $row[19],
            'ram_1_type'     => $row[20],
            'ram_1_size'    => $row[21],
            'ram_2_size'    => $row[22],
            'ram_3_size'    => $row[23],
            'ram_4_size'    => $row[24],
            'hw_id'    => $row[25],
            'grade'    => $row[26],
            'comments'    => $row[27],
            'observations'    => $row[28],
            'expanded_codes'    => $row[29],
            'key_test_result'    => $row[30],
            'user'    => $row[31],
            'audited'    => $row[32],
            'color'    => $row[33],
            'model_no'    => $row[34],
            'year'    => $row[35],
            'processor_code'    => $row[36],
            'processor_speed'    => $row[37],
            'ram'    => $row[38],
            'disk'    => $row[39],
            'serie'    => $row[40],
            'screen'    => $row[41],
            'aiken_sku_wo_color_model_no'    => $row[42],
            'sku_model_wo_color'    => $row[43],
            'sku_model_no'    => $row[44],
            'sku_order_no_wo_color'    => $row[45],
            'occurrences'    => $row[46],
            'sku_order_no'    => $row[47],
            'title'    => $row[48],
            'sku_model_w_o_localization'    => $row[51]
        ]);

        exit;







        // $items = DtbItem::firstOrCreate(
        //     ['unit_id'     => $row[1]],
        //     ['lot_id'    => $row[2]],
        //     ['asset_tag'    => $row[2]],
        //     ['product_type'     => $row[4]],
        //     ['manufacturer'    => $row[5]]
                        // ['model'     => $row[6]],
                        // ['part_number'    => $row[7]],
                        // ['sl_number'     => $row[8]],
                        // ['display_size'    => $row[9]],
                        // ['resulation'     => $row[10]],
                        // ['processor'    => $row[11]],
                        // ['processor_speed'     => $row[12]],
                        // ['ram'    => $row[13]],
                        // ['storage_1_size'     => $row[14]],
                        // ['storage_1_type'    => $row[15]],
                        // ['keyb'     => $row[16]],
                        // ['webcam'    => $row[17]],
                        // ['ram_1_type'     => $row[18]],
                        // ['ram_1_size'    => $row[19]]
                        //['sku_model_w_o_localization'    => $row[51]]

       // );


        // $sku_data = DtbSku::all();

        // //$sku_model_w_o_localization = '..';

        // if(isset($sku_data)){

        //     foreach($sku_data as $value){

        //         //echo $value->sku_model_no; echo "<br>";echo $row[51]; exit;



        //         // if($value->sku_model_no == $row[51]){
        //         //     $sku_id = $value->id;

        //         // }

        //         // else{
        //         //     $sku_id = 0;
        //         // }




        //     }

        // }

        

    }
}