<?php

namespace App\Imports;

use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class MultiSheetSpecificSelectorByName implements WithMultipleSheets
{
    public function sheets(): array
    {
        return [
            'sku_data_1' => new FirstSheetImporter,
            'item_data_2' => new SecondSheetImporter,
        ];
    }
}
