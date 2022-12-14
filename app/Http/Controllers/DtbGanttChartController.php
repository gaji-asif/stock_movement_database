<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbProject;
use App\DtbIssue;
use App\DtbApps;
use App\DtbActivityLog;
use App\DtbIssueCategory;
use App\DtbIssueFeedback;
use App\DtbVersion;
use App\DtbIssueStatus;
use App\DtbIssuePriority;
use App\DtbGenIssueType;
use DB;
use Session;
use Carbon\Carbon;
use App\MtbFeedback;

class DtbGanttChartController extends Controller
{




    public function index(Request $request ,$id)
    {

            //redirect to login page with running visited page url; ### statt
            $visitedpage = $request->fullUrl();
            if (!Session()->has('user_id')) {
                return redirect('login')->with('url', $visitedpage);
            }
            //redirect to login page with running visited page url; ### end
            
            $common_array = array(
                'content_heading' => 'Gantt Chart'
            );

            $developer_id = Session::get('developer_id');


            $gntsrchhistory = \DB::table('dtb_projects')
            ->select('chart_start_date','show_chart_months')
            ->find($id);


            if (isset($gntsrchhistory)) {
            

                if ($gntsrchhistory->chart_start_date == null) {
                    $ganttyear = date("d/m/Y");
                }else{
                    $ganttyear =  $gntsrchhistory->chart_start_date;
                }
                    $monthlimit =  $gntsrchhistory->show_chart_months;
               

                $issuedata = DtbIssue::selectRaw('dtb_issues.*, dtb_issues.issue_title as text, dtb_issues.deadline as end_date, dtb_users.name as assignee, DATEDIFF(dtb_issues.deadline, dtb_issues.start_date) as duration,dtb_issues.progress as progress,dtb_gen_issue_types.issue_type as typeofissue,dtb_gen_issue_types.color as issuetypecolor,dtb_apps.app_name as appname,dtb_issue_statuses.status_name as statusname,dtb_issue_statuses.color as statuscolor,dtb_issue_priorities.priority_name as priorname,dtb_issue_priorities.color as priorcolor,dtb_issue_categories.category_name as categoryname,dtb_versions.version_name as versionname,dtb_versions.color as versioncolor,dtb_difficulties.name as difficname,nextissutbl.issue_title as nextissuetitle,nextstatstbl.status_name as nextissuestat,nextstatstbl.color as nextissuestatcolor,nextissueusertbl.name as nexissueassignee,dtb_issue_comments.issue_comment,dtb_issue_feedbacks.feedback_type,dtb_issues.start_date as datestart,dtb_issues.deadline as dateend')
                ->leftjoin('dtb_users', 'dtb_issues.user_id', '=', 'dtb_users.id')
                ->leftjoin('dtb_gen_issue_types', 'dtb_issues.issue_type', '=', 'dtb_gen_issue_types.id')
                ->leftjoin('dtb_apps', 'dtb_issues.app_id', '=', 'dtb_apps.id')
                ->leftjoin('dtb_issue_statuses', 'dtb_issues.status', '=', 'dtb_issue_statuses.id')
                ->leftjoin('dtb_issue_priorities', 'dtb_issues.issue_priority_id', '=', 'dtb_issue_priorities.id')
                ->leftjoin('dtb_issue_categories', 'dtb_issues.category_id', '=', 'dtb_issue_categories.id')
                ->leftjoin('dtb_versions', 'dtb_issues.version_id', '=', 'dtb_versions.id')
                ->leftjoin('dtb_difficulties', 'dtb_issues.difficulty', '=', 'dtb_difficulties.id')
                ->leftjoin('dtb_issues as nextissutbl', 'dtb_issues.next_issue_id', '=', 'nextissutbl.id')
                ->leftjoin('dtb_issue_statuses as nextstatstbl', 'dtb_issues.next_kick_status', '=', 'nextstatstbl.id')
                ->leftjoin('dtb_users as nextissueusertbl', 'dtb_issues.next_user_id', '=', 'nextissueusertbl.id')
                ->leftjoin('dtb_issue_comments', 'dtb_issues.id', '=', 'dtb_issue_comments.issue_id')
                ->leftjoin('dtb_issue_feedbacks', 'dtb_issues.id', '=', 'dtb_issue_feedbacks.issue_id')
                ->where('dtb_issues.project_id','=',$id)
                ->where('dtb_issues.is_closed','=',0)
                ->orderBy('dtb_issues.start_date')
                ->get();



                $issueTypes = DtbGenIssueType::getProjectIssueType($id);
                $apps = DtbApps::getProjectApps($id);
                $categories = DtbIssueCategory::where('project_id',$id)->get();
                $versions = DtbVersion::where('project_id',$id)->get();
                $statuses = DtbIssueStatus::where('project_id',$id)->where('is_true',1)->orderBy('ordering','ASC')->get();
                $users = \DB::table('dtb_users')
                ->join('dtb_users_projects','dtb_users.id','=','dtb_users_projects.user_id')
                ->where('dtb_users_projects.project_id', $id)
                //->where('dtb_users.is_archived', 0)
                ->get();
                $projects = DtbProject::where('developer_id',$developer_id)->get();
                $priorities = DtbIssuePriority::where('project_id',$id)->get();
                 $feedbacks = MtbFeedback::all();
                // $singleissue = DtbIssue::query()
                // ->from('dtb_issues as i')
                // ->leftjoin('dtb_issues as ii','i.next_issue_id', '=', 'ii.id')
                // ->leftjoin('dtb_users as u','i.next_user_id', '=', 'u.id')
                // ->leftjoin('dtb_issue_statuses as s','i.next_kick_status', '=', 's.id')
                // ->where('i.id', 5233)
                // ->get([ 'i.*','ii.issue_title as nextissue','u.name as nexuser','s.status_name as nxtstatus'])
                // ->first();

                return view('settings.generalSettings.ganttchart.index',compact('id','common_array','monthlimit','ganttyear','issuedata','gntsrchhistory','issueTypes','apps','categories','versions','statuses','users','projects','priorities','feedbacks'));

            }else{
                echo "something went wrong !";
            }




    }




    public function ganttdatasend(Request $request ,$id){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end



        $common_array = array(
            'content_heading' => 'Gantt Chart'
        );


        if (!empty($request->get('yearofgantt'))) {

            $projectdata = DtbProject::find($id);
            $projectdata->chart_start_date = $request->get('yearofgantt');
            $projectdata->show_chart_months = $request->get('scale');
            $projectdata = $projectdata->update();

            // $gntsrchhistory = \DB::table('dtb_projects')
            // ->select('chart_start_date','show_chart_months')
            // ->find($id);

            // if (isset($gntsrchhistory)) {

            //     $monthlimit =  $gntsrchhistory->show_chart_months;
            //     $ganttyear =  $gntsrchhistory->chart_start_date;


            // $issuedata = DtbIssue::selectRaw('dtb_issues.*, dtb_issues.issue_title as text, dtb_issues.deadline as end_date, dtb_users.name as assignee, DATEDIFF(dtb_issues.deadline, dtb_issues.start_date) as duration,dtb_issues.progress as progress')
            // ->leftjoin('dtb_users', 'dtb_issues.user_id', '=', 'dtb_users.id')
            // ->where('dtb_issues.project_id','=',$id)
            // ->where('dtb_issues.is_closed','=',0)
            // ->orderBy('dtb_issues.start_date')
            // ->get();
            //return view('settings.generalSettings.ganttchart.index',compact('id','common_array','monthlimit','ganttyear','issuedata','gntsrchhistory'));
            return redirect()->route('ganttchart', [$id]);


            // }else{
            //     echo "something went wrong !";
            // }


        }


    }





    // this function will send comments data
    public function getganttdata(Request $request ,$id){
        
        $issueid = $request->get('taskid');
        $allcommentsofissue = \DB::table('dtb_issue_comments')
        ->leftjoin('dtb_users', 'dtb_issue_comments.user_id', '=', 'dtb_users.id')
        ->where('issue_id', $issueid)
        ->get();

            $html='';
            foreach($allcommentsofissue as $allcommentsofissues){

                 $parser = new \cebe\markdown\GithubMarkdown();
                 $parser->html5 = true;
                 $parser->enableNewlines = true;
                 $parser->keepListStartNumber = true;  
                 echo "<div class='commenter'><span>" . $allcommentsofissues->name ."</span></div>";
                 echo "<div class='commentssingle'>" . $parser->parse($allcommentsofissues->issue_comment) ."</div>";
                  //return $testdata;
                // $html.='<span class="text-muted">'.$allcommentsofissues->issue_comment .'</span>';

            }


       
    }



 

    public function store(Request $request,$id)
    {

        $developer_id = Session::get('developer_id');
        DtbIssue::create(['developer_id' => $developer_id,'start_date' => $request->get('start_date'),'issue_title' => $request->get('issue_title'),'estimate_hour1' => $request->get('duration'),'deadline' => $request->get('end_date'),'project_id' => $id]);
        echo "";

    }



    public function show($id,$taskid)
    {
        //
    }



    public function edit($id,$taskid)
    {
        //
    }



    public function update(Request $request, $id,$taskid)
    {
        //echo $request->get('feedback_type_val');die();
       
        $dtbissue = DtbIssue::find($request->get('taskid'));
        $dtbissue->user_id =            $request->get('user_id');
        $dtbissue->issue_title =        $request->get('issue_title');
        $dtbissue->start_date =         $request->get('start_date');
        $dtbissue->deadline =           $request->get('deadline');
        //$dtbissue->estimate_hour1 =   $request->get('duration');
        $dtbissue->complete_date =      $request->get('complete_date');
        $dtbissue->progress =           $request->get('progress');
        $dtbissue->updated_at =         $request->get('updated_at');
        $dtbissue->issue_type =         $request->get('issue_type_val');
        $dtbissue->app_id =             $request->get('app_id_val');
        // $dtbissue->status =             $request->get('status_val');
        // $dtbissue->next_issue_id =      $request->get('next_issue_id_val');
        // $dtbissue->next_user_id =       $request->get('next_user_id_val');
        // $dtbissue->next_kick_status =   $request->get('next_kick_status_val');

        $dtbissue->issue_priority_id =  $request->get('issue_priority_id_val');
        $dtbissue->category_id =        $request->get('category_id_val');
        $dtbissue->version_id =         $request->get('version_id_val');
        $dtbissue->progress =           $request->get('progress_val');
        $dtbissue->estimate_hour1 =     $request->get('estimate_hour1_val');
        $dtbissue->estimate_hour2 =     $request->get('estimate_hour2_val');
        $dtbissue->difficulty =         $request->get('difficulty_val');
        // $dtbissue->project_id =         $request->get('project_val');
        $dtbissue->issue_text =         $request->get('issue_text_val');
        //$dtbissue->feedback_count =   $request->get('feedback_type_val');
        //$dtbissue->updated_at =       $request->get('issue_comment_val');


//if next kick status and staus value are same then assignee will change by nextuserid
if ($request->get('next_kick_status_val') !== null ) {
if ($request->get('status_val') === $request->get('next_kick_status_val') ){
$dtbissue->status = $request->get('status_val');
$dtbissue->next_kick_status = $request->get('status_val');
$autoassignedissue = DtbIssue::find($request->get('next_issue_id_val'));
$autoassignedissue->user_id = $request->get('next_user_id_val');
$autoassignedissue->update();

if ($request->get('next_user_id_val') !== null ) {
    $dtbissue->user_id = $request->get('next_user_id_val');
}

}else{
$dtbissue->status = $request->get('status_val');
}
}else{
$dtbissue->status = $request->get('status_val');

}


$statuses = DtbIssueStatus::find($request->get('status_val'));
if (empty($statuses) || $statuses->is_complete ==1){
$dtbissue->is_closed = 1;
$complete_date = $dtbissue->complete_date;
if(empty($complete_date)){
$dtbissue->complete_date =now();
}
else{
$dtbissue->complete_date = $complete_date;
}

}else{
$dtbissue->is_closed = 0;
$dtbissue->complete_date =null;

}

$feedback_type= $request->get('feedback_type_val');
if (empty($statuses) || $statuses->is_feedback !=1){
$feedback_type = null;
}

if (!empty($feedback_type)){
$dtbissue->feedback_count = $dtbissue->feedback_count +1 ;
}


$updatesuccess = $dtbissue->update();
//echo "Auto Asssign success !";
//DtbActivityLog::updateActivityLog('updated', 'issue');

if($updatesuccess){

    if (!empty($feedback_type)){
        $dtbIssueFeedback = DtbIssueFeedback::getExistsFeedBack($request,$request->get('taskid'));
        DtbIssueFeedback::addFeedBack($request,$request->get('user_id'));
    }

}




}


 




    public function destroy(Request $request,$id,$taskid)
    {
        $dtbissue = DtbIssue::find($request->get('taskid'));
        $dtbissue = $dtbissue->delete();
        echo "Issue has been deleted!";
    }



    public function ganttissueget(Request $request,$id)
    {
     echo "helllo from contr";
    }


}
