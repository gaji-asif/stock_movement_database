<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssueCategory;
use App\DtbActivityLog;
use App\DtbProject;
use DB;
use App\DtbIssueStatus;
use App\DtbIssuePriority;

class DtbDeveloperStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
          //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        
        //$DtbProject = DtbProject::find($id);
        // if (empty($DtbProject)) {
        //    return redirect('projects');
        // }

        $common_array = array(
            'content_heading' => 'All Categories'
        );

        
        $loggedindeveloper = Session::get('developer_id');
        $statusss = DtbIssueStatus::where('developer_id',$loggedindeveloper)->where('is_true',1)->orderBy('ordering','ASC')->get();
        return view('settings.developerSettings.statusSettings.index',compact('statusss', 'common_array'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Create Status'
        );

        $loggedindeveloper = Session::get('developer_id');
        $DtbIssueStatus = DtbIssueStatus::where('developer_id',$loggedindeveloper)->where('is_true',1)->orderBy('ordering','ASC')->get();
        return view('settings.developerSettings.statusSettings.create',compact('common_array', 'DtbIssueStatus'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {

       //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        
        $developer_id = Session::get('developer_id');
        $data = request()->validate([
            'status_name'=>'required',
            'color'=> '',
            'is_complete'=> '',
            'project_id'=>'',
        ]);

        if(empty($request->get('color'))){
            $color = NULL;
            return redirect('/status/create')->with('message-color', "You must select a color.")->withErrors($data)->withInput();
        }
        else{
            $color = $request->get('color');
        }


        $lastInsertID = DtbIssueStatus::create($data)->id;


        if($lastInsertID){
            $status_issue = DtbIssueStatus::find($lastInsertID);
            $status_issue->condition_id = $lastInsertID;
            $result = $status_issue->update();
        }

        $another_issue = new DtbIssueStatus;
        $another_issue->project_id = 0;
        
        $another_issue->developer_id = $developer_id;
        $another_issue->status_name = "not:".$request->status_name;
        $another_issue->is_complete = 0;
        $another_issue->color = $color;
        $another_issue->condition_id = $lastInsertID;
        $another_issue->is_true = 0;
        $another_issue->save();

        

         return redirect('status')->with('message', "Status has been added.");

        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($statusid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Edit Status'
        );

        $statusdetails = DtbIssueStatus::where('id',$statusid)->first();
        $loggedindeveloper = Session::get('developer_id');
        $DtbIssueStatus = DtbIssueStatus::where('developer_id',$loggedindeveloper)->where('is_true',1)->orderBy('ordering','ASC')->get();

        return view('settings.developerSettings.statusSettings.edit',compact('common_array','statusid','statusdetails', 'DtbIssueStatus'));
    } 


     public function statusorder(Request $request){

        //echo "ok";
        //exit;

        $loggedindeveloper = Session::get('developer_id');
        $newslist = DtbIssueStatus::where('developer_id',$loggedindeveloper)->get();

            foreach ($newslist as $newsitem) {

                $newsitem->timestamps = false; // To disable update_at field updation
                $id = $newsitem->id;

               // print_r($request->order);
               // exit;

                foreach ($request->order as $order) {
                    if ($order['id'] == $id) {
                        $newsitem->update(['ordering' => $order['position']]);
                    }
                }

            }

        return response('Update Successfully.', 200);

     }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($statusid,Request $request){


        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        
        $developer_id = Session::get('developer_id');

         $data = request()->validate([
            'status_name'=>'required',
            'color'=>'',
            'project_id'=>'',
            'oldcolor'=>'',
            'iscompletes'=>'',
        ]);

        $DtbIssueStatus = DtbIssueStatus::where('id',$statusid)->first();

        $DtbIssueStatus->status_name  = $request->get('status_name');
        $DtbIssueStatus->is_complete  = $request->get('is_complete');
        $DtbIssueStatus->is_feedback  = $request->get('is_feedback');
        if ($request->get('color')=="") {
            // $DtbIssueStatus->color  = $request->get('oldcolor');
            $DtbIssueStatus->color  = $DtbIssueStatus->color;
        }else{
            $DtbIssueStatus->color  = $request->get('color');
        }
        
        //$DtbIssueStatus->project_id  = $request->get('projectid');

        $DtbIssueStatus->save();

        return redirect('status')->with('message', "Status has been updated.");

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
   
        
        DtbIssueStatus::where('condition_id',$request->condition_id)->delete();
        // return response()->json([
        //     'success' => 'Record deleted successfully!'
        // ]);
        //DtbActivityLog::updateActivityLog('deleted', 'status');
       // DtbActivityLog::updateActivityLogPro('deleted', 'status', $id);
        return redirect('status')->with('message', "Status has been deleted.");

    }
}
