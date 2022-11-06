<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssuePriority;
use App\DtbActivityLog;
use App\DtbProject;
use DB;

class DtbDeveloperPriorityController extends Controller
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
            'content_heading' => 'All Priorities'
        );

        
        $loggedindeveloper = Session::get('developer_id');
        $dtbpriorities = DtbIssuePriority::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();
       // echo "asdas"; exit;
        return view('settings.developerSettings.prioritySettings.index',compact('dtbpriorities', 'common_array'));
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
            'content_heading' => 'Create Priority'
        );
        $loggedindeveloper = Session::get('developer_id');

        $dtbpriorities = DtbIssuePriority::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();


        return view('settings.developerSettings.prioritySettings.create',compact('common_array', 'dtbpriorities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
    {



        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'priority_name'=>'required'
           
        ]);

         if(empty($request->get('color'))){
            $color = NULL;
            return redirect('/priority/create')->with('message-color', "You must select a color.");
        }
        else{
            $color = $request->get('color');
        }

        DB::table('dtb_issue_priorities')->insert(
        [
        
        'developer_id' => $developer_id, 
        'project_id' => 0,
        'priority_name' => $request->get('priority_name'), 
        'color' => $color
       
       ]);
        //DtbActivityLog::updateActivityLogPro('added', 'priority', 1);

        

         return redirect('priority')->with('message', "Priority has been added.");

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
    public function edit($priorityid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Edit Priority'
        );

        $priorityDetails = DtbIssuePriority::where('id',$priorityid)->first();

        $loggedindeveloper = Session::get('developer_id');

        $dtbpriorities = DtbIssuePriority::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

        return view('settings.developerSettings.prioritySettings.edit',compact('common_array','priorityid','Catdetails', 'dtbpriorities', 'priorityDetails'));
    } 


     public function priorityorder(Request $request){

        //echo "ok";
        //exit;

        $loggedindeveloper = Session::get('developer_id');
        $priorityLists = DtbIssuePriority::where('developer_id',$loggedindeveloper)->get();

            foreach ($priorityLists as $newsitem) {

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
    public function update($priorityid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }

        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'priority_name'=>'required'
           
        ]);

        $priorityDetails = DtbIssuePriority::where('id',$priorityid)->first();

        if(empty($request->get('color'))){
            $color = $priorityDetails->color;
            //return redirect('priority')->with('message-color', "You must select a color.");
        }
        else{
            $color = $request->get('color');
        }

        DB::table('dtb_issue_priorities')->where('id',$priorityid)->update(
        [

        'developer_id' => $developer_id, 
        'project_id' => 0,
        'priority_name' => $request->get('priority_name'), 
        'color' => $color

        ]);
        //DtbActivityLog::updateActivityLogPro('added', 'priority', 1);
         return redirect('priority')->with('message', "Priority has been updated.");

     }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
