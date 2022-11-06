<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Session;
use App\DtbCost;
use App\DtbProject;
use App\DtbActivityLog;

class DtbCostController extends Controller
{



    public function costimport(Request $request)
    {

            $developer_id = Session::get('developer_id');

            if ($request->input('submit') != null ){

              $file = $request->file('importcsv');
              // File Details
              $filename = $file->getClientOriginalName();
              $filename_without_ext = pathinfo($filename, PATHINFO_FILENAME);
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

                //check if data exist or not in db
                if (DtbCost::where('filename', $filename_without_ext)->exists()) {

                    Session::flash('msg','This file already imported.');

                }else{
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

                            if ( ! isset($importData[0])) { $importData[0] = null; }
                            if ( ! isset($importData[1])) { $importData[1] = null; }
                            if ( ! isset($importData[2])) { $importData[2] = null; }
                            if ( ! isset($importData[3])) { $importData[3] = null; }
                            if ( ! isset($importData[4])) { $importData[4] = null; }
                            if ( ! isset($importData[5])) { $importData[5] = null; }
                            if ( ! isset($importData[6])) { $importData[6] = null; }


                            $insertData = array(
                                "developer_id"=>         $developer_id,
                                "project_id"=>           $importData[0],
                                "app_id"=>               $importData[1],
                                "user_id"=>              $importData[2],
                                "work_time"=>            $importData[3],
                                "billing_date"=>         $importData[4],
                                "sub_total"=>            $importData[5],
                                "tax"=>                  $importData[6],
                                "filename"=>             $filename_without_ext
                            );

                            DtbCost::create($insertData);


                        }

                        Session::flash('msg','Import Successful.');


                }

                // }else{
                //   Session::flash('message','File too large. File must be less than 2MB.');
                // }

              }else{
                 Session::flash('msg','Invalid File Extension.');
              }

            }

            // Redirect to index
            return redirect()->back();


    }


    public function index()
    {


    }



    public function create()
    {


        $common_array = array(
            'content_heading' => 'Cost Add'
        );

        $developer_id = Session::get('developer_id');
        $projects = DtbProject::where('developer_id',$developer_id)->get();


        $apps = DB::table('dtb_apps')
          ->select('dtb_apps.*')
          ->whereIn('project_id',function($query) use ($developer_id){
                    $query->select('id')->from('dtb_projects')
                    ->where('developer_id',$developer_id);
                  })->get();



        $users = DB::table('dtb_users')
        ->select('dtb_users.*')
        ->where('developer_id',$developer_id)->get();


        //$apps = DtbApps::getProjectApps(12);
        return view('costmanage.create', compact('projects','apps','users','common_array'));


    }



    public function store(Request $request)
    {

        $data = request()->validate([
            'project_id'=>'required',
            'app_id'=>'',
            'user_id'=>'',
            'work_time'=>'',
            'sub_total'=>'',
            'tax'=>'',
            'billing_date'=>'',
            'developer_id'=>'',
        ]);
        DtbCost::create($data);
        DtbActivityLog::updateActivityLog('added', 'cost');
        return redirect()->route('manageinvoices')->with('scss','Cost added successfully !');

    }



    public function show($id)
    {


    }




    public function edit($id,Request $request)
    {
        $common_array = array(
            'content_heading' => 'Cost Edit'
        );


        $singlecost = DtbCost::find($id);

        $developer_id = Session::get('developer_id');
        $projects = DtbProject::where('developer_id',$developer_id)->get();


        $apps = DB::table('dtb_apps')
          ->select('dtb_apps.*')
          ->whereIn('project_id',function($query) use ($developer_id){
                    $query->select('id')->from('dtb_projects')
                    ->where('developer_id',$developer_id);
                  })->get();

        $users = DB::table('dtb_users')
        ->select('dtb_users.*')
        ->where('developer_id',$developer_id)->get();


        //$apps = DtbApps::getProjectApps(12);
        return view('costmanage.edit', compact('projects','apps','users','common_array','singlecost'));

    }




    public function update(Request $request, $id)
    {

        $data = request()->validate([
            'project_id'=>'required',
            'app_id'=>'',
            'user_id'=>'',
            'work_time'=>'',
            'sub_total'=>'',
            'tax'=>'',
            'billing_date'=>'',
            'developer_id'=>'',
        ]);

        $dtbcost = DtbCost::find($id);
        $dtbcost->project_id = $request->project_id;
        $dtbcost->app_id = $request->app_id;
        $dtbcost->user_id = $request->user_id;
        $dtbcost->work_time =$request->work_time ;
        $dtbcost->sub_total =$request->sub_total;
        $dtbcost->tax = $request->tax;
        $dtbcost->billing_date = $request->billing_date ;
        $dtbcost->save();

        DtbActivityLog::updateActivityLog('update', 'cost');
        return redirect()->route('manageinvoices')->with('scss','Cost updated successfully !');


    }




    public function deletecost(Request $request)
    {

        $costid = $request->costid;
        $costdel = DtbCost::find($costid);
        $costdel->delete();
        DtbActivityLog::updateActivityLog('deeted', 'cost');
        // return redirect()->route('manageinvoices')->with('scss','Cost deleted successfully !');
    }




    public function generateprojectapp(Request $request)
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



    public function generateprojectappedit(Request $request)
    {


        if (isset($request->projectid)) {


            // $costapp = DB::table('dtb_costs')
            // ->where('id',$request->costid)
            // ->select('app_id')
            // ->first();
            // $costapp->app_id;

            if ($request->projectid == '0' ) {
                $html = "";
                $html .= '
                    <option value="">Select App</option>';
                return $html;
            }else{

                // $apps = DB::table('dtb_apps')
                // ->where('project_id',$request->projectid)
                // ->get();

                $apps = DB::table('dtb_apps')
                ->leftjoin('dtb_costs','dtb_apps.id', '=', 'dtb_costs.app_id')
                ->where('dtb_apps.project_id',$request->projectid)
                ->select(['dtb_apps.app_name','dtb_apps.id as appid','dtb_costs.app_id as costapp'])
                ->get();


                $html = "";
                foreach ($apps as $projectapp) {
                    $html .= '
                    <option  value="'.$projectapp->appid.'">'.$projectapp->app_name.'</option>';
                }
                return $html ;

            }

        }else{
            return $html = "";
        }

    }


}
