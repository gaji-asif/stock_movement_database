<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbApps;
use App\DtbVersion;
use App\DtbScreenGroup;
use App\DtbActivityLog;
use App\DtbTestSheet;
use App\DtbTestCase;
use Storage;
use DB;

class DtbTestSheetController extends Controller
{


  public function index($id,Request $request)
  {
        //redirect to login page with running visited page url; ### statt
   $visitedpage = $request->fullUrl();
   if (!Session()->has('user_id')) {
    return redirect('login')->with('url', $visitedpage);
  }
        //redirect to login page with running visited page url; ### end

  $common_array = array(
    'content_heading' => 'Test Sheets List'
  );

  $dtbTestSheets = DtbTestSheet::where('dtb_test_sheets.project_id',$id)
  ->leftJoin('dtb_apps', function($join) {
    $join->on('dtb_apps.id', '=', 'dtb_test_sheets.app_id');
  })
  ->leftJoin('dtb_versions', function($join) {
    $join->on('dtb_versions.id', '=', 'dtb_test_sheets.version_id');
  })
  ->orderBy('dtb_test_sheets.id','DESC')->get(['dtb_apps.app_name','dtb_versions.version_name','dtb_test_sheets.*']);
  return view('test_sheets.index_old',compact('dtbTestSheets','id','common_array'));
}






public function create($id)
{
  $common_array = array(
    'content_heading' => 'Add Test Sheet'
  );


  $loggedindeveloper = Session::get('developer_id');
  $apps = DtbApps::getProjectApps($id);
  $versions = DtbVersion::where('project_id',$id)->get();


  return view('test_sheets.create',compact('id','apps','versions', 'common_array'));
}

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request,$id)
    {

      $data = request()->validate([
       'project_id'=>'required',
       'app_id'=> '',
       'version_id'=> '',
       'name'=> 'required',
       'detail'=> '',
       'start_date' => 'nullable',
       'schedules_end_date' => 'nullable'
     ]);

      if ($data) {
        DtbTestSheet::create($data);
            //DtbActivityLog::updateActivityLogPro('added', 'app', $id);
        return redirect('project/'.$id.'/testSheets')->with('message', 'Test Sheet has been submitted!');
      }else{
        return redirect('project/'.$id.'/testSheets')->with('message', 'Something went wrong,try again please');
      }


    }



    public function show(Request $request, $id,$testSheetID)
    {


      $common_array = array(
        'content_heading' => 'All Test Cases'
      );

      $testCases = DtbTestCase::query()
      ->from('dtb_test_cases as tc')
      ->leftjoin('dtb_users as u','tc.tested_by', '=', 'u.id')

      ->where('tc.test_sheet_id', $testSheetID) ->orderBy('tc.ordering','ASC')
      ->get([ 'tc.*', 'u.name as user_tested', 'u.icon_image_path']);
      //$testSheetName = DtbTestSheet::where('id',$testSheetID)->first();

      $testSheetName = DtbTestSheet::query()
      ->from('dtb_test_sheets as t')
      ->leftjoin('dtb_apps as a','t.app_id', '=', 'a.id')
      ->leftjoin('dtb_versions as v','t.version_id', '=', 'v.id')
      ->where('t.id', $testSheetID)
      ->first([ 't.*', 'a.app_name', 'v.version_name']);

      $totalResults = DtbTestCase::query()
      ->from('dtb_test_cases as tc')
      ->where('tc.test_sheet_id', $testSheetID)
      ->get(['tc.tested_result']);

      $totalOkResults = DtbTestCase::query()
      ->from('dtb_test_cases as tc')
      ->where('tc.test_sheet_id', $testSheetID)
      ->where('tc.tested_result', 'OK')
      ->get(['tc.tested_result']);

      $totalNGResults = DtbTestCase::query()
      ->from('dtb_test_cases as tc')
      ->where('tc.test_sheet_id', $testSheetID)
      ->where('tc.tested_result', 'NG')
      ->get(['tc.tested_result']);

      $totalPendingResults = DtbTestCase::query()
      ->from('dtb_test_cases as tc')
      ->where('tc.test_sheet_id', $testSheetID)
      ->where('tc.tested_result', 'Pending')
      ->get(['tc.tested_result']);
          //$json_totalOkResults = json_encode(count($totalOkResults));

      return view('test_sheets.show',compact('testCases','id','testSheetID','common_array', 'testSheetName', 'totalResults', 'totalOkResults', 'totalNGResults', 'totalPendingResults'));
    }

    public function seacrhTestCases(Request $request){

      if ($request->isMethod('post')) {
        $common_array = array(
      'content_heading' => 'All Test Cases'
    );
     $search_results_type = $request->results;
     $testSheetID = $request->testSheetID;
     $id = $request->project_id;
     $testSheetName = DtbTestSheet::where('id',$testSheetID)->first();

     $query = '';
     $status_search_key="";


     if(!empty($request->results)){
       $all_results = "'" . implode ( "', '", $request->results ) . "'";
       $status_search_key .= " AND tc.tested_result IN (".$all_results.")";
     }

     $query .= $status_search_key;
     $testCases = DB::select(DB::raw("SELECT tc.*, u.name as user_tested FROM `dtb_test_cases` as tc
      LEFT JOIN dtb_users as u ON tc.tested_by = u.id
      WHERE tc.test_sheet_id=$testSheetID $query"));

     $totalResults = DtbTestCase::query()
     ->from('dtb_test_cases as tc')
     ->where('tc.test_sheet_id', $testSheetID)
     ->get(['tc.tested_result']);

     $totalOkResults = DtbTestCase::query()
     ->from('dtb_test_cases as tc')
     ->where('tc.test_sheet_id', $testSheetID)
     ->where('tc.tested_result', 'OK')
     ->get(['tc.tested_result']);

     $totalNGResults = DtbTestCase::query()
     ->from('dtb_test_cases as tc')
     ->where('tc.test_sheet_id', $testSheetID)
     ->where('tc.tested_result', 'NG')
     ->get(['tc.tested_result']);

     $totalPendingResults = DtbTestCase::query()
     ->from('dtb_test_cases as tc')
     ->where('tc.test_sheet_id', $testSheetID)
     ->where('tc.tested_result', 'Pending')
     ->get(['tc.tested_result']);
          //$json_totalOkResults = json_encode(count($totalOkResults));

     return view('test_sheets.show',compact('testCases','id','testSheetID','common_array', 'testSheetName', 'totalResults', 'totalOkResults', 'totalNGResults', 'totalPendingResults', 'search_results_type'));
      }
      else{
    return redirect('/home');
      }

   }


   public function edit($id,$testSheetID)
   {


    $loggedindeveloper = Session::get('developer_id');
    $editData = DtbTestSheet::where('id',$testSheetID)->first();
    $apps = DtbApps::getProjectApps($id);
    $versions = DtbVersion::where('project_id',$id)->get();

    $allTestCases = DtbTestCase::where('test_sheet_id',$testSheetID)->get();

    $common_array = array(
      'content_heading' => 'Edit Test Sheet'
    );

    return view('test_sheets.edit',compact('id','editData','apps','versions', 'common_array', 'allTestCases'));



  }



  public function update(Request $request, $id, $testSheetID)
  {
    $data = request()->validate([
     'project_id'=>'required',
     'app_id'=> '',
     'version_id'=> '',
     'name'=> 'required',
     'detail'=> '',
   ]);

    $testSheets = DtbTestSheet::where('id',$testSheetID)->first();


    $testSheets->project_id  = $request->get('project_id');
    $testSheets->app_id = $request->get('app_id');
    $testSheets->version_id = $request->get('version_id');
    $testSheets->name = $request->get('name');
    $testSheets->detail = $request->get('detail');
    $testSheets->start_date = date('y-m-d',strtotime($request->start_date));
    $testSheets->schedules_end_date = date('y-m-d',strtotime($request->schedules_end_date));
    $result = $testSheets->save();
          //DtbActivityLog::updateActivityLogPro('updated', 'app', $id);


    if ($result) {

           // DtbActivityLog::updateActivityLogPro('added', 'app', $id);
      return redirect('project/'.$id.'/testSheets')->with('message', 'Test Sheet has been updated!');
    }else{
      return redirect('project/'.$id.'/testSheets')->with('message', 'Something went wrong,try again please');
    }

  }


  //COPY TEST SHEET STARTS

//   public function sheetcopy($id,$testSheetID)
//   {

//    $loggedindeveloper = Session::get('developer_id');
//    $editData = DtbTestSheet::where('id',$testSheetID)->first();
//    $apps = DtbApps::getProjectApps($id);
//    $versions = DtbVersion::where('project_id',$id)->get();

//    $allTestCases = DtbTestCase::where('test_sheet_id',$testSheetID)->get();

//    $common_array = array(
//      'content_heading' => 'Copy Test Sheet'
//    );

//    return view('test_sheets.copy',compact('id','editData','apps','versions', 'common_array', 'allTestCases'));



//  }



 public function sheetcopystore(Request $request,$id,$testSheetID)
 {

    $allsheet = DtbTestSheet::where('id',$testSheetID)->first();

    if (!empty($allsheet)) {

        $sheet = new DtbTestSheet;
        $sheet->project_id  = $allsheet->project_id;
        $sheet->app_id = $allsheet->app_id;
        $sheet->version_id = $allsheet->version_id;
        $sheet->name = $allsheet->name . '_copy';
        $sheet->detail = $allsheet->detail;
        $sheet->start_date = date('y-m-d',strtotime($allsheet->start_date));
        $sheet->schedules_end_date = date('y-m-d',strtotime($allsheet->schedules_end_date));
        $done = $sheet->save();

        $justinsertedsheetid = $sheet->id;

        if ($done) {

        if (!empty($testSheetID)) {

            $testCases = DtbTestCase::query()
            ->from('dtb_test_cases as tc')
            ->leftjoin('dtb_users as u','tc.tested_by', '=', 'u.id')
            ->where('tc.test_sheet_id', $testSheetID) ->orderBy('tc.ordering','ASC')
            ->get([ 'tc.*', 'u.name as user_tested', 'u.icon_image_path']);

            foreach ($testCases as $key => $testCasesdata) {

                $testCases = new DtbTestCase;
                $testCases->functions_screen = $testCasesdata->functions_screen;
                $testCases->functions = $testCasesdata->functions;
                $testCases->test_sheet_id = $justinsertedsheetid;
                //$testCases->function_name = $testCasesdata->function_name;
                $testCases->tested_result = $testCasesdata->tested_result;
                $testCases->tested_by = $testCasesdata->tested_by;
                $testCases->summary = $testCasesdata->summary;
                $testCases->tested_date = date('y-m-d',strtotime($testCasesdata->tested_date));

                $result = $testCases->save();

            }

        }


        }

        return redirect('project/'.$id.'/testSheets')->with('message', 'Test Sheet has been copied!');

    }else {
        return redirect('project/'.$id.'/testSheets')->with('message', 'Something went wrong,try again please');
    }


}



  //COPY TEST SHEET ENDS




  public function updateMemo(Request $request, $appid)
  {

        //         $data = request()->validate([
        //             'project_id'=>'required',
        //             'app_name'=> 'required',
        //             'app_short_name'=> '',
        //             'target_sdk'=> '',
        //             'repo'=> '',
        //             'deployment_target'=> '',
        //             'deploy_url'=> '',
        //             'company_name'=> '',
        //             'ide_version'=> '',
        //             'memo'=> '',
        //         ]);
        //         return 'OK';
    $appdata = DtbApp::where('id',$appid)->first();
    $appdata->memo = $request->get('memo');
    $appdata->save();
        //DtbActivityLog::updateActivityLogPro('updated', 'app', $id);
    return "Successfully Updated";

  }

  public function destroy(Request $request,$id)
  {
    DtbApp::find($request->appid)->delete($request->appid);
    DtbActivityLog::updateActivityLogPro('deleted', 'app', $id);

    echo "Record has been deleted";
  }


   public function testSheetdelete(Request $request)
  {
    
    DB::delete('delete from dtb_test_sheets where id = ?',[$request->get('testSheetId')]);
    DB::delete('delete from dtb_test_cases where test_sheet_id = ?',[$request->get('testSheetId')]);
    
    //DtbActivityLog::updateActivityLogPro('deleted', 'app', $id);

    echo "Record has been deleted";
  }





  public function updateOrder(Request $request,$projectid,$testSheetID){

        $DtbTestCases = DtbTestCase::all()->where('test_sheet_id',$testSheetID);

       foreach ($DtbTestCases as $DtbTestCase) {

           $DtbTestCase->timestamps = false; // To disable update_at field updation
           $id = $DtbTestCase->id;

           foreach ($request->order as $order) {
               if ($order['id'] == $id) {
                   $DtbTestCase->update(['ordering' => $order['position']]);
               }
           }

       }

        return response('Update Successfully.', 200);

   }




    // tui editor content drag and drop or select file upload
        public function editorfiles(Request $request){

          $cloud_front_path = "";
          $userImageFile = "";

          $image = $request->file('file');

        //$imageName = time().$image->getClientOriginalName();
        //$upload_success = $image->move(public_path('uploads/appfiles'),$imageName);

          $cloud_front_path ='https://'.env('AWS_URL') . '/';
          $userImageFile = Storage::disk('s3')->put('appfiles', $request->file('file'));

          if ($userImageFile) {
            echo $cloud_front_path.$userImageFile;
           // echo $host = request()->getHost();
          }else{
            echo "File not uploaded,please try again";
          }

        }



      }
