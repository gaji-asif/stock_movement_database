<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use DB ;

class IntStudentReportController extends Controller
{
    public function index()
    {
       
         if(Session::get('role') == '1') {
            $administrator_id = Session::get('user_id'); 
            $IntStudents = DB::select(DB::raw("SELECT * FROM int_students where active = '1' and administrator_id = $administrator_id"));
        }
        else if(Session::get('role') == '2') {
            $agent_id = Session::get('user_id'); 
            $IntStudents = DB::select(DB::raw("SELECT * FROM int_students where active = '1' and agent_id = $agent_id"));
        }
        else if(Session::get('role') == '3') {
            $user_id = Session::get('user_id'); 
            $IntStudents = DB::select(DB::raw("SELECT * FROM int_students where active = '1' and user_id = $user_id"));
        }
        else {
            $IntStudents = DB::select(DB::raw("SELECT * FROM int_students where active = '1'"));
        }
        $university_list = DB::select(DB::raw("SELECT DISTINCT university FROM int_students where active = '1' and university != ''"));
        return view('int_student.report.index', compact('IntStudents','university_list'));
    }

    public function searchStudents(Request $request){
       
        $query = '';
        $role = Session::get('role');
        $user_id = Session::get('user_id');
        if($role == 1){ //admission officer
            $query .= "AND administrator_id = '$user_id'";
        }else if ($role == 2){ //agent
            $query .= "AND agent_id = '$user_id'";
        }else if ($role == 3){ //agent
            $query .= "AND user_id = '$user_id'";
        }
        
        if(isset($request->status)){
           $query .= "AND status = '$request->status'";
        }
        if(isset($request->intake)){
           $query .= "AND month = '$request->intake'";
        }
        if(isset($request->university)){
            $query .= "AND university = '$request->university'";
         }

        $IntStudents = DB::select(DB::raw("SELECT * from int_students where active = 1 $query "));
        
        return view('int_student.allStudentsreport', compact('IntStudents'));
      
     }
}
