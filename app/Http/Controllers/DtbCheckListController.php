<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbChecklist;
use App\DtbActivityLog;
use App\DtbProject;
use DB;

class DtbCheckListController extends Controller
{
    
	



    public function index($id, Request $request)
    {

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end


        $DtbProject = DtbProject::find($id);
        if (empty($DtbProject)) {
           return redirect('projects');
        }

        $common_array = array(
            'content_heading' => 'Project Settings'
        );


        $loggedindeveloper = Session::get('developer_id');
        $DtbChecklist = DtbChecklist::where('project_id',$id)->orderBy('ordering','ASC')->get();
        // $DtbChecklist = DtbChecklist::where('project_id',$id)->where('is_complete',0)->orderBy('ordering','ASC')->get();
        return view('settings.generalSettings.projectchecklist.index',compact('DtbChecklist','id', 'common_array'));


    }

   


    public function updateOrder(Request $request){

     $checklists = DtbChecklist::all();

        foreach ($checklists as $checklist) {

            $checklist->timestamps = false; // To disable update_at field updation
            $id = $checklist->id;
            echo $id;
            foreach ($request->order as $order) {
                if ($order['id'] == $id) {
                    $checklist->update(['ordering' => $order['position']]);
                }
            }

        }

         return response('Update Successfully.', 200);

    }






    public function create()
    {
       
    }


    public function store(Request $request,$id)
    {

       $data = request()->validate([
            'title'=>'required',
            'project_id'=>'',
        ]);

        DtbChecklist::create($data);
        DtbActivityLog::updateActivityLogPro('added', 'checklist', $id);
        echo "data submitted";

    }



    public function show($id,$chcklistid,Request $request)
    {
        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end


        $DtbProject = DtbProject::find($id);
        if (empty($DtbProject)) {
           return redirect('projects');
        }

        $common_array = array(
            'content_heading' => 'Project Settings'
        );


        $loggedindeveloper = Session::get('developer_id');
        $DtbChecklistsingle = DtbChecklist::where('id',$chcklistid)->first();
        // $DtbChecklist = DtbChecklist::where('project_id',$id)->where('is_complete',0)->orderBy('ordering','ASC')->get();
        return view('settings.generalSettings.projectchecklist.show',compact('DtbChecklistsingle','id', 'chcklistid', 'common_array'));
    }





    public function listadd(Request $request,$id)
    {
        
       $data = request()->validate([
            'chcklistid'=>'required',
            'title'=>'required',
            'status'=>''
        ]);



       	DB::table('dtb_checklist_details')->insert([
		    [
		    	'checklist_id' => $request->chcklistid, 
		    	'details' => $request->title, 
		    	'status' => 0
			]
		]);


        DtbActivityLog::updateActivityLogPro('added', 'checklist', $id);
        echo "data submitted";

    }    




    public function getlistofdetail(Request $request,$id)
    {
        

        
       	$checklistdetails = DB::table('dtb_checklist_details')
       	->where('checklist_id',$request->listid)
       	->get();
       	$html = "";
       	foreach ($checklistdetails as $checklistdetail) {
       		$html .= '<li class="singlechcklist"><p class="dtailchckp_'.$checklistdetail->id.'" class="listli">'.$checklistdetail->details.'</p>
       		<input class="inlineinput_'.$checklistdetail->id.'" style="display:none" type="text" value="'.$checklistdetail->details.'">
       		<div class="iconholder">
       		<a href="#" class="editcheckdtail" data="'.$checklistdetail->id.'"><i class="fas fa-pencil-alt"></i></a>
       		<a href="#" class="editcheckdtaildone" id="editcheckdtaildone_'.$checklistdetail->id.'" style="display:none" data="'.$checklistdetail->id.'"><i class="far fa-save"></i></a>
       		<a href="#" class="editcancel" id="editcancel_'.$checklistdetail->id.'" style="display:none" data="'.$checklistdetail->id.'"><i class="fa fa-times" aria-hidden="true"></i></a>
       		<a href="#" class="delcheckdtail" data="'.$checklistdetail->id.'"><i class="far fa-trash-alt d-block"></i></a></div></li>';
       	}
       	return $html ;

    }





    public function edit($id)
    {
        //
    }



    public function editdtailchecklist(Request $request,$id)
    {

    	//echo $request->editedvalue;die();
        $data = request()->validate([
            'dtaillistid'=>'required',
            'editedvalue'=>'required',
        ]);

		$deldtailchecklist = DB::table('dtb_checklist_details')
		       	->where('id',$request->dtaillistid)
		       	->update(['details' => $request->editedvalue]);

        DtbActivityLog::updateActivityLogPro('updated', 'checklist', $id);
        echo "Successfully Updated";

    }




    public function update(Request $request, $id)
    {


        $data = request()->validate([
            'checklistid'=>'required',
            'projectid'=>'required',
            'check_title'=>'required',
        ]);

        //$DtbChecklist = DtbChecklist::find($request->statusid);
        $DtbChecklist = DtbChecklist::where('id',$request->checklistid)->first();
        $DtbChecklist->title  = $request->get('check_title');
        $DtbChecklist->project_id  = $request->get('projectid');
        $DtbChecklist->save();
        DtbActivityLog::updateActivityLogPro('updated', 'checklist', $id);
        echo "Successfully Updated";
    }




    public function destroy(Request $request,$id)
    {
        //DtbChecklist::find($request->id)->delete($request->id);
        DtbChecklist::where('id',$request->id)->delete();
        DtbActivityLog::updateActivityLogPro('deleted', 'checklist', $id);
        echo "Record has been deleted";
    }


    public function deldtailchecklist(Request $request,$id)
    {
    	
    	$deldtailchecklist = DB::table('dtb_checklist_details')
       	->where('id',$request->listid)
       	->delete();

        DtbActivityLog::updateActivityLogPro('deleted', 'checklist', $id);
        echo "Record has been deleted";

    }











}

