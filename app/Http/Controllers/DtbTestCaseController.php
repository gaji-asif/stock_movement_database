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
use App\DtbUser;


class DtbTestCaseController extends Controller
{


    public function index($id,Request $request)
    {
       //
    }






   public function create($id, $testSheetID)
    {

       $common_array = array(
            'content_heading' => 'Add Test Case'
        );


       $loggedindeveloper = Session::get('developer_id');
       $apps = DtbApps::getProjectApps($id);
       $versions = DtbVersion::where('project_id',$id)->get();
       $all_users = DtbUser::where('developer_id',$loggedindeveloper)->OrderBy('id','DESC')->get();

       return view('test_case.create',compact('id','apps','versions', 'common_array', 'testSheetID', 'all_users'));
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
        'functions_screen'=>'required',
        'tested_by'=>'required',
        // 'status'=> 'required',
        // 'importance'=> 'required',
        // 'priority'=> '',
        // 'summary'=> '',
        // 'precondition'=> '',
        // 'step'=> '',
        // 'expected'=> '',
        // 'result'=> 'required',
        // 'test_type'=> 'required',
        // 'behavior'=> 'required',
        // 'automation_status'=> 'required',

        ]);

     // if(empty($request->tested_date)){
     //    $date = NULL;
     // }
     // else{
     //    $date = date('y-m-d',strtotime($request->tested_date));
     // }

        if ($data) {

          $testCases = new DtbTestCase;
            $testCases->functions_screen = $request->functions_screen;
            $testCases->functions = $request->functions;
            $testCases->test_sheet_id = $request->testSheetID;
            //$testCases->function_name = $request->function_name;
            $testCases->tested_result = $request->tested_result;
            $testCases->tested_by = $request->tested_by;
            $testCases->summary = $request->summary;
            $testCases->tested_date = date('y-m-d',strtotime($request->tested_date));

            $result = $testCases->save();
            $LastInsertId = $testCases->id;

            //DtbActivityLog::updateActivityLogPro('added', 'app', $id);
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Test Sheet has been submitted!');
             return redirect('project/'.$id.'/testSheets/'.$request->testSheetID)->with('message', 'Test Case has been added!');
        }else{
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Something went wrong,try again please');
           return redirect('project/'.$id.'/testSheets/'.$request->testSheetID)->with('message', 'Test Case has been added!');
        }



    }



    public function show(Request $request, $id,$appid)
    {


      }




    public function edit($id,$testCaseID)
    {

        $loggedindeveloper = Session::get('developer_id');
        $editData = DtbTestCase::where('id',$testCaseID)->first();
        $all_users = DtbUser::where('developer_id',$loggedindeveloper)->get();

        $common_array = array(
            'content_heading' => 'Edit Test Case'
        );

        return view('test_case.edit',compact('id','editData', 'common_array', 'all_users'));
    }



    public function update(Request $request, $id, $testCaseID)
    {


       $data = request()->validate([
        'functions_screen'=>'required',
        'tested_by'=>'required'
        ]);

     //    if(empty($request->tested_date)){
     //    $date = NULL;
     // }
     // else{
     //    $date = date('y-m-d',strtotime($request->tested_date));
     // }

        if ($data) {

          //$testCases = new DtbTestCase;
            // $testCases = DtbTestCase::where('id',$testCaseID)->first();
            $testCases = DtbTestCase::find($testCaseID);
            $testCases->functions_screen = $request->functions_screen;
            $testCases->functions = $request->functions;
            //$testCases->function_name = $request->function_name;
            $testCases->tested_result = $request->tested_result;
            $testCases->tested_by = $request->tested_by;
            $testCases->summary = $request->summary;
            $testCases->tested_date = date('y-m-d',strtotime($request->tested_date));
            $result = $testCases->save();
          return redirect('project/'.$id.'/testSheets/'.$request->test_sheet_id)->with('message', 'Test Case has been Updated!');

        }else{
            return redirect('project/'.$id.'/testSheets/'.$request->test_sheet_id)->with('message', 'Test Case has been Updated!');
        }

    }


  public function destroy(Request $request,$id)
    {
        DtbApp::find($request->appid)->delete($request->appid);
        DtbActivityLog::updateActivityLogPro('deleted', 'app', $id);

       echo "Record has been deleted";
    }




    public function testcasecopy($id,$testCaseID)
    {

        $loggedindeveloper = Session::get('developer_id');
        $editData = DtbTestCase::where('id',$testCaseID)->first();
        $all_users = DtbUser::where('developer_id',$loggedindeveloper)->get();

         if ($editData) {

          $testCases = new DtbTestCase;
            $testCases->functions_screen = $editData->functions_screen;
            $testCases->functions = $editData->functions;
            $testCases->test_sheet_id = $editData->test_sheet_id;
            //$testCases->function_name = $request->function_name;
            $testCases->tested_result = $editData->tested_result;
            $testCases->tested_by = $editData->tested_by;
            $testCases->summary = $editData->summary;
            $testCases->tested_date = date('y-m-d',strtotime($editData->tested_date));

            $result = $testCases->save();
            $LastInsertId = $testCases->id;

            //DtbActivityLog::updateActivityLogPro('added', 'app', $id);
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Test Sheet has been submitted!');
             return redirect('project/'.$id.'/testSheets/'.$editData->test_sheet_id)->with('message', 'Test Case has been Copied!');
        }else{
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Something went wrong,try again please');
           return redirect('project/'.$id.'/testSheets/'.$editData->test_sheet_id)->with('message', 'Test Case has been Copied!');
        }


        //return view('test_case.copy',compact('id','editData', 'common_array', 'all_users'));
    }


    public function testcasecopystore(Request $request,$id)
    {


     $data = request()->validate([
        'functions_screen'=>'required',
        'tested_by'=>'required',
        ]);



        if ($data) {

          $testCases = new DtbTestCase;
            $testCases->functions_screen = $request->functions_screen;
            $testCases->functions = $request->functions;
            $testCases->test_sheet_id = $request->test_sheet_id;
            //$testCases->function_name = $request->function_name;
            $testCases->tested_result = $request->tested_result;
            $testCases->tested_by = $request->tested_by;
            $testCases->summary = $request->summary;
            $testCases->tested_date = date('y-m-d',strtotime($request->tested_date));

            $result = $testCases->save();
            $LastInsertId = $testCases->id;

            //DtbActivityLog::updateActivityLogPro('added', 'app', $id);
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Test Sheet has been submitted!');
             return redirect('project/'.$id.'/testSheets/'.$request->test_sheet_id)->with('message', 'Test Case has been Copied!');
        }else{
            // return redirect('project/'.$id.'/testSheets/'.$request->testSheetID.'/edit')->with('message', 'Something went wrong,try again please');
           return redirect('project/'.$id.'/testSheets/'.$request->test_sheet_id)->with('message', 'Test Case has been Copied!');
        }



    }


public function deleteTEstCase(Request $request){
        $testCaseID = $_POST['testCaseID'];
        $test_sheet_id = $_POST['test_sheet_id'];
        $project_id = $_POST['project_id'];

        DtbTestCase::find($testCaseID)->delete($testCaseID);
        DtbActivityLog::updateActivityLogPro('deleted', 'testCase', $testCaseID);
        //return redirect('project/'.$project_id.'/testSheets/'.$test_sheet_id)->with('message', 'Test Case has been deleted!');
}








}
