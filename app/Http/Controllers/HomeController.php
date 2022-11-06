<?php

namespace App\Http\Controllers;

use DB;
use Session;
use App\DtbHome;
use App\DtbUser;
use App\DtbIssue;
use App\DtbProject;
use App\IntStudent;
use App\DtbActivityLog;
use App\DtbDevelopGroup;
use App\DtbUsersProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\DTbSku;
use App\DtbItem;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['CheckAuthenticateUserMiddleware'])->except('basicSett');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end


        $user_id = Session::get('user_id');
        $developer_id = Session::get('developer_id');
        $usersData = DtbUser::find($user_id);
        Session::put('users_name', $usersData->name);
        Session::put('users_image', $usersData->icon_image_path);

        //         if(Session::has('role')){
        //             if(Session::get('role') == '0'){
        //                 $projects = DtbProject::query()
        //                 ->where('dtb_projects.developer_id', $developer_id)
        //                 ->take(4)
        //                 ->get([ 'dtb_projects.*' ]);
        //                 $issues = DtbIssue::allIssues();

        //             }
        //             else{
        //                 $projects = DtbUsersProject::query()
        //                 ->from('dtb_users_projects as up')
        //                 ->leftjoin('dtb_projects as p','up.project_id', '=', 'p.id')
        //                 ->where('up.user_id', $user_id)
        //                 ->take(4)
        //                 ->get([ 'p.*' ]);
        //                 $issues = DtbIssue::allIssues();
        //             }
        //         }


        $projects = DtbProject::getProjects();
        $issues = DtbIssue::allIssues();
        $latest_applications = "";
        if (Session::get('role') == '1') {
            $id = Session::get('user_id');
            $IntStudent = IntStudent::all()->where('active', 1)->where('administrator_id', $id)->count();
        } else if (Session::get('role') == '2') {
            $id = Session::get('user_id');
            $IntStudent = IntStudent::all()->where('active', 1)->where('agent_id', $id)->count();
        } else {
            $IntStudent = IntStudent::all()->where('active', 1)->count();
            $latest_applications = IntStudent::all()->where('active', 1)->sortBy('created_at')
            ->take(5);
        }


        $activity_logs_dates = DtbActivityLog::select(DB::raw('DATE(created_at) as date'))
            ->where('developer_id', $developer_id)
            ->orderBy('created_at', 'desc')
            ->groupBy('date')
            ->take(3)
            ->get();



        // $dtbdevelopgroup = DtbDevelopGroup::where('id',$developer_id)->firstOrFail();
        //  return view('dashboard_main', compact('projects', 'issues','dtbdevelopgroup', 'activity_logs_dates' , 'IntStudent' , 'users' , 'latest_applications'));

        $unseenActivity = DtbActivityLog::where('seen',1)->get();

        $userId = Session::get('user_id');
        $role = Session::get('role');
    
  
        if($role == 0){
            
            $unseenActivity = DtbActivityLog::latest('id')->where('view_by_admin', 1)->get();
        }

        if($role == 1){
           $admissionStudents  = IntStudent::where('administrator_id',$userId)->pluck('user_id')->toArray();
   
           $unseenActivity1 = DtbActivityLog::whereIn('user_id',$admissionStudents)->where('view_by_admission', 1)->latest('id')->get();             
           $unseenActivity2 = DtbActivityLog::where('user_id',$userId)->where('view_by_admission', 1)->latest('id')->get();             
           $unseenActivity = $unseenActivity1->merge($unseenActivity2);
        }
        if($role == 2){
           
        //    $agentStudents  = IntStudent::where('agent_id',$userId)->pluck('id')->toArray();
        //    $unseenActivity1 = DtbActivityLog::whereIn('user_id',$agentStudents)->latest('id')->where('view_by_agent', 1)->get();             
          
           $unseenActivity = DtbActivityLog::where('user_id',$userId)->latest('id')->where('view_by_agent', 1)->get();             

        //    $unseenActivity = $unseenActivity1->merge($unseenActivity2);
         
        }
        if($role == 3){
           $unseenActivity = DtbActivityLog::where('user_id',$userId)->latest('id')->where('view_by_student', 1)->get();             
          
        }

        $all_skus = DtbSku::where('id','>',0)->get();
        $items = DtbItem::where('id','>',0)->get();


        $dtbdevelopgroup = DtbDevelopGroup::where('id',$developer_id)->firstOrFail();
         return view('dashboard_main', compact('projects', 'issues','dtbdevelopgroup', 'activity_logs_dates' , 'IntStudent','unseenActivity'  , 'latest_applications', 'all_skus', 'items'));




        // $dtbdevelopgroup = DtbDevelopGroup::where('id', $developer_id)->firstOrFail();
        // return view('dashboard_main', compact('projects', 'issues', 'dtbdevelopgroup', 'activity_logs_dates', 'IntStudent', 'unseenActivity',  'latest_applications'));
    }

    // home of project settings
    public function home()
    {
        //return view('dashboard');
    }

    public function settings(Request $request)
    {
        return view('dashboard');
    }

    public function test()
    {
        echo "hello world";
    }

    public function forms()
    {
        return view('admin.forms');
    }

    public function basicSett()
    {
        return view('settings.basicSett');
    }

    public function notification()
    {

        
        // $notifications = DtbActivityLog::where('seen', 1)->get();
        // DtbActivityLog::where('seen', 1)->update(['seen' => 0]);
        // return view('notifications', compact('notifications'));

      
        $userId = Session::get('user_id');
        $role = Session::get('role');
        

        if($role == 0){
            $notifications = DtbActivityLog::latest('id')->where('view_by_admin',1)->get();
            // DtbActivityLog::where('view_by_admin', 1)->update(['view_by_admin' => 0]);
            return view('notifications',compact('notifications'));
        }

        if($role == 1){
           
           $admissionStudents  = IntStudent::where('administrator_id',$userId)->pluck('user_id')->toArray();
           
           $notifications1 = DtbActivityLog::whereIn('user_id',$admissionStudents)->where('view_by_admission',1)->latest('id')->get();             
           $notifications2 = DtbActivityLog::where('user_id',$userId)->where('view_by_admission',1)->latest('id')->get();             
           $notifications = $notifications1->merge($notifications2); 

           return view('notifications',compact('notifications'));
        }
        if($role == 2){
          
        //    $agentStudents  = IntStudent::where('agent_id',$userId)->pluck('user_id')->toArray();
        //    $notifications1 = DtbActivityLog::whereIn('user_id',$agentStudents)->where('view_by_agent',1)->latest('id')->get();             
           $notifications = DtbActivityLog::where('user_id',$userId)->where('view_by_agent',1)->latest('id')->get();             
        //    $notifications = $notifications1->merge($notifications2);             
          
        //    $update = array("0");
        //    $update = json_encode($update);
        //    DtbActivityLog::whereJsonContains('view_by', ['2'])->update(['view_by' => $update]);

           return view('notifications',compact('notifications'));
        }
        if($role == 3){

           $notifications = DtbActivityLog::where('user_id',$userId)->where('view_by_student',1)->latest('id')->get();             
          
        //    $update = array("0","1","2");
        //    $update = json_encode($update);
        //    DtbActivityLog::whereJsonContains('view_by', ['3'])->update(['view_by' => $update]);

           return view('notifications',compact('notifications'));
        }


    }
}
