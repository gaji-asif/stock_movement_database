<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbInvoice;
use App\DtbProject;
use App\DtbApps;
use DB;
use Session;

class DtbInvoiceController extends Controller
{

    public function index(Request $request)
    {

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        $common_array = array(
            'content_heading' => 'Invoice Manage'
        );


        $developer_id = Session::get('developer_id');
        $invoices = DtbInvoice::where('developer_id',$developer_id)->orderBy('id', 'desc')->get();

        //$invoices = DtbInvoice::all();
        return view('invoicemanage.index', compact('invoices', 'common_array'));


    }



    public function create()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
    public function edit($id)
    {
    }
    public function update(Request $request, $id)
    {
    }
    public function destroy($id)
    {
    }


    public function invoiceimport(Request $request)
    {

            $developer_id = Session::get('developer_id');

            if ($request->input('submit') != null ){

              $file = $request->file('importcsv');

              // File Details
              $filename = $file->getClientOriginalName();
              $extension = $file->getClientOriginalExtension();
              $tempPath = $file->getRealPath();
              $fileSize = $file->getSize();
              $mimeType = $file->getMimeType();

              // Valid File Extensions
              $valid_extension = array("csv");
              // 2MB in Bytes
              $maxFileSize = 2097152;
              // Check file extension
              if(in_array(strtolower($extension),$valid_extension)){
                // Check file size
                //if($fileSize <= $maxFileSize){
                  // File upload location
                  $location = 'uploads';
                  // Upload file
                  $file->move($location,$filename);
                  // Import CSV to Database
                  $filepath = public_path($location."/".$filename);
                  // Reading file
                  $file = fopen($filepath,"r");
                  $importData_arr = array();
                  $i = 0;
                  while (($filedata = fgetcsv($file, 1000, ",")) !== FALSE) {
                     $num = count($filedata );

                     // Skip first row (Remove below comment if you want to skip the first row)
                     if($i == 0){
                        $i++;
                        continue;
                     }

                     for ($c=0; $c < $num; $c++) {
                        $importData_arr[$i][] = $filedata [$c];
                     }
                     $i++;
                  }
                  fclose($file);

                   //dd($importData_arr );

                   $converted = mb_convert_encoding($importData_arr, 'UTF-8');
                   //$converted = mb_convert_encoding($importData_arr, "UTF-8","Shift-JIS, EUC-JP, JIS");
                   //if (mb_check_encoding($importData[1], "Shift_JIS")) { echo "Shift_JIS"; die(); }



                  foreach($converted as $importData){

                    if ( ! isset($importData[0])) { $importData[21] = null; }
                    if ( ! isset($importData[1])) { $importData[1] = null; }
                    if ( ! isset($importData[2])) { $importData[2] = null; }
                    if ( ! isset($importData[3])) { $importData[3] = null; }
                    if ( ! isset($importData[4])) { $importData[4] = null; }
                    if ( ! isset($importData[5])) { $importData[5] = null; }
                    if ( ! isset($importData[6])) { $importData[6] = null; }
                    if ( ! isset($importData[7])) { $importData[7] = null; }
                    if ( ! isset($importData[8])) { $importData[8] = null; }
                    if ( ! isset($importData[9])) { $importData[9] = null; }
                    if ( ! isset($importData[10])) { $importData[10] = null; }
                    if ( ! isset($importData[11])) { $importData[11] = null; }
                    if ( ! isset($importData[12])) { $importData[12] = null; }
                    if ( ! isset($importData[13])) { $importData[13] = null; }
                    if ( ! isset($importData[14])) { $importData[14] = null; }
                    if ( ! isset($importData[15])) { $importData[15] = null; }
                    if ( ! isset($importData[16])) { $importData[16] = null; }
                    if ( ! isset($importData[17])) { $importData[17] = null; }
                    if ( ! isset($importData[18])) { $importData[18] = null; }
                    if ( ! isset($importData[19])) { $importData[19] = null; }
                    if ( ! isset($importData[20])) { $importData[20] = null; }
                    if ( ! isset($importData[21])) { $importData[21] = null; }
                    if ( ! isset($importData[22])) { $importData[22] = null; }
                    if ( ! isset($importData[23])) { $importData[23] = null; }
                    if ( ! isset($importData[24])) { $importData[24] = null; }
                    if ( ! isset($importData[25])) { $importData[25] = null; }
                    if ( ! isset($importData[28])) { $importData[28] = null; }
                    if ( ! isset($importData[29])) { $importData[29] = null; }
                     //echo $importData[2];die();

                    $insertData = array(

                        "developer_id"=>             $developer_id,
                        "order_id"=>                 $importData[0],
                        //"order_name"=>               utf8_encode($importData[1]),
                        "order_name"=>               $importData[1],
                        "customer_name"=>            $importData[2],
                        "customer_branch"=>          $importData[3],
                        "customer_charge_last_name"=>$importData[4],
                        "customer_charge_first_name"=>$importData[5],
                        "invoice_date"=>             $importData[6],
                        "order_status_name"=>        $importData[7],
                        "progress_status_name"=>     $importData[8],
                        "kbn1"=>                     $importData[9],
                        "kbn2"=>                     $importData[10],
                        "kbn3"=>                     $importData[11],
                        "groups"=>                   $importData[12],
                        "last_name"=>                $importData[13],
                        "first_name"=>               $importData[14],
                        "manage_no"=>                $importData[15],
                        "customer_no"=>              $importData[16],
                        "subtotal"=>                 $importData[17],
                        "tax"=>                      $importData[18],
                        "withholding_tax"=>          $importData[19],
                        "total"=>                    $importData[20],
                        "memo"=>                     $importData[21],
                        "quantity"=>                 $importData[22],
                        "unit"=>                     $importData[23],
                        "unit_price"=>               $importData[24],
                        "tax_rate"=>                 $importData[25],
                        "amount"=>                   $importData[28],
                        "reduced_tax_rate"=>         $importData[29]

                    );


                    //IF ORDER ID ALREADY EXISTS IN DB DATA WILL NOT BE INSERTED AND OTHER ORDER ID WILL BE INSERTED
                    if (!empty($importData[0])) {
                        if(DtbInvoice::where('order_id', $importData[0])->exists()) {
                            //$dtbinvoices = DtbInvoice::where('order_id', $importData[0])
                            //->update($insertData);
                        }else{
                            DtbInvoice::create($insertData);
                        }
                    }else{
                        Session::flash('message','Order ID missing');
                        return redirect()->back();
                    }




                  }

                  Session::flash('message','Import Successful.');
                // }else{
                //   Session::flash('message','File too large. File must be less than 2MB.');
                // }

              }else{
                 Session::flash('message','Invalid File Extension.');
              }

            }

            // Redirect to index
            return redirect()->back();


    }



    public function invoiceimportedit($id,Request $request)
    {

        $common_array = array(
            'content_heading' => 'Invoice Edit'
        );

        $developer_id = Session::get('developer_id');
        $singleinvoice = DtbInvoice::find($id);
        $projects = DtbProject::where('developer_id',$developer_id)->get();


        $apps = DB::table('dtb_apps')
          ->select('dtb_apps.*')
          ->whereIn('project_id',function($query) use ($developer_id){
                    $query->select('id')->from('dtb_projects')
                    ->where('developer_id',$developer_id);
                  })->get();


        //$apps = DtbApps::getProjectApps(12);
        return view('invoicemanage.edit', compact('singleinvoice','projects','apps','common_array'));


    }



    public function invoicedataupdate($id,Request $request)
    {

        if (isset($id)) {

            $dtbinvoices = DtbInvoice::find($id);
            if (!empty($dtbinvoices)) {

                $dtbinvoices->order_id = $request->order_id;
                $dtbinvoices->order_name = $request->order_name;
                $dtbinvoices->customer_name = $request->customer_name;
                $dtbinvoices->customer_branch = $request->customer_branch;
                $dtbinvoices->customer_charge_last_name = $request->customer_charge_last_name;
                $dtbinvoices->customer_charge_first_name = $request->customer_charge_first_name;
                $dtbinvoices->invoice_date = $request->invoice_date;
                $dtbinvoices->order_status_name = $request->order_status_name;
                $dtbinvoices->progress_status_name = $request->progress_status_name;
                $dtbinvoices->kbn1 = $request->kbn1;
                $dtbinvoices->kbn2 = $request->kbn2;
                $dtbinvoices->kbn3 = $request->kbn3;
                $dtbinvoices->groups = $request->groups;
                $dtbinvoices->last_name = $request->last_name;
                $dtbinvoices->first_name = $request->first_name;
                $dtbinvoices->manage_no = $request->manage_no;
                $dtbinvoices->customer_no = $request->customer_no;
                $dtbinvoices->subtotal = $request->subtotal;
                $dtbinvoices->tax = $request->tax;
                $dtbinvoices->withholding_tax = $request->withholding_tax;
                $dtbinvoices->total = $request->total;
                $dtbinvoices->memo = $request->memo;
                $dtbinvoices->quantity = $request->quantity;
                $dtbinvoices->unit = $request->unit;
                $dtbinvoices->unit_price =$request->unit_price;
                $dtbinvoices->tax_rate = $request->tax_rate;
                $dtbinvoices->amount = $request->amount;
                $dtbinvoices->reduced_tax_rate = $request->reduced_tax_rate;

                $result = $dtbinvoices->update();

                return redirect()->route('manageinvoices')->with('success','Invoice data updated successfully !');
                //return redirect()->back()->with('message','Invoice updated successfully !');


            }

        }




    }



    public function invoiceitemsave($id,Request $request)
    {

        $request->item_name;
        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $developer_id = Session::get('developer_id');
        // $data = request()->validate([
        //     'item_name'=>'required'
        // ]);


        DB::table('dtb_invoice_items')->insert(
        ['invoice_id' => $request->get('invoice_id'), 'item_name' => $request->get('item_name'), 'project_id' => $request->get('project_id'), 'app_id' => $request->get('app_id'), 'amount' => $request->get('amount'), 'total' => $request->get('total'), 'tax' => $request->get('tax'), 'created_at' => now(), 'updated_at' => now()]);

        echo "success";





    }




    public function invoiceitemlist($id,Request $request)
    {

        $invoiceitemlists = DB::table('dtb_invoice_items')
        ->leftjoin('dtb_apps','dtb_invoice_items.app_id', '=', 'dtb_apps.id')
        ->leftjoin('dtb_projects','dtb_invoice_items.project_id', '=', 'dtb_projects.id')
        ->where('dtb_invoice_items.invoice_id',$request->invoiceid)
        ->select('dtb_invoice_items.*','dtb_apps.app_name as apptitle','dtb_projects.project_name')
        ->get();

        $totalamount = DB::table('dtb_invoice_items')
        ->where('invoice_id',$request->invoiceid)
        ->sum('total');

           $html = "";
           $html .= '<input type="hidden" class="itemtotal" value="'.$totalamount.'">';
       	foreach ($invoiceitemlists as $invoiceitem) {
               $html .= '<tr data-toggle="modal" data-target="#editinvItemmodal" class="editinvitem" data="'.$invoiceitem->id.'" class="itemid_'.$invoiceitem->id.'"  data-name="'.$invoiceitem->item_name.'"  data-project="'.$invoiceitem->project_id.'"  data-app="'.$invoiceitem->app_id.'" data-amount="'.$invoiceitem->amount.'"  data-total="'.$invoiceitem->total.'"  data-tax="'.$invoiceitem->tax.'" >
               <td>'.$invoiceitem->item_name.'</td>
               <td>'.$invoiceitem->project_name.'</td>
               <td>'.$invoiceitem->apptitle.'</td>
               <td>'.$invoiceitem->amount.'</td>
               <td>'.$invoiceitem->tax.'</td>
               <td>'.$invoiceitem->total.'</td>

       		</tr>';
       	}
       	return $html ;

    }





    public function invoiceitemupdate($id,Request $request)
    {

        //echo $request->invoiceitem_id;die();
        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end




        DB::table('dtb_invoice_items')
        ->where('id',$request->get('invoiceitem_id'))
        ->update(
        ['invoice_id' => $id, 'item_name' => $request->get('item_name_edit'), 'project_id' => $request->get('project_id_edit'), 'app_id' => $request->get('app_id_edit'), 'amount' => $request->get('amount_edit'), 'total' => $request->get('total_edit'), 'tax' => $request->get('tax_edit'), 'created_at' => now(), 'updated_at' => now()]);


    }



    public function invoiceitemdelete($id,Request $request)
    {

        //echo $request->itemid;die();
        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end


        DB::table('dtb_invoice_items')
        ->where('id',$request->get('itemid'))
        ->delete();


    }



    public function getprojectapp(Request $request)
    {


        if (isset($request->projectid)) {

            if ($request->projectid == '0' ) {
                $html = "";
                $html .= '
                    <option value="">Select App</option>';
                return $html;
            }else{

                $apps = DB::table('dtb_apps')
                ->where('project_id',$request->projectid)
                ->get();

                $html = "";
                foreach ($apps as $projectapp) {
                    $html .= '
                    <option value="'.$projectapp->id.'">'.$projectapp->app_name.'</option>';
                }
                return $html ;

            }

        }else{
            return $html = "";
        }

    }



}


