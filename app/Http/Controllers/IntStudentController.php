<?php

namespace App\Http\Controllers;

use Session;
use App\country;
use App\DtbUser;
use App\IntStudent;
use App\University;
use App\StudentNote;
use App\FacilityType;
use App\DtbActivityLog;
use App\StudentDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\SettingTemplate;
use App\StudentCustomeNote;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\VarDumper\Cloner\Data;
use PHPUnit\Framework\MockObject\Builder\Stub;

// use Validator, Redirect, Response;

class IntStudentController extends Controller
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
        return view('int_student.index', compact('IntStudents','university_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = country::all();
        return view('int_student.create', compact('countries'));
    }

    
    public function store(Request $request)
    {
        
        $request->validate(
            [
                'field_1' => 'required',
                'field_2' => 'required',
                'field_3' => 'required',
                'field_4' => 'required',
                'field_5' => 'required',
                'field_6' => 'required',
                'address' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'required|email',
                'gender' => 'required',
                'first_lang' => 'required',
                'country' => 'required',
                'passport_num' => 'required',
                'year' => 'required',
                'month' => 'required',
                'lang' => 'required',
                'term_agree' => 'required',
                'note' => 'nullable',
                "edu_institution.*"  => "required",
                "edu_address.*"  => "required",
                "edu_start_date.*"  => "required",
                "edu_end_date.*"  => "required",
                "edu_result.*"  => "required"
            ],
            [
                'term_agree.required' => 'Check this box to proceed',
            ]
        );

        
			// $user = new DtbUser();
	        // $user->name = $request->field_5;
			// $user->email = $request->email;
			// $user->password = 'e10adc3949ba59abbe56e057f20f883e';
			// $user->role = 3;   
			// $user->developer_id = 0;   
			// $user->verified = 1;   
			// $user->save();
			// $user_id = $user->id;

        if(Session::get('role') == '2') {
            $agent_id = Session::get('user_id'); 
            $user_id = '';
        }
        else if(Session::get('role') == '3') {
            $agent_id = ""; 
            $user_id = Session::get('user_id');
        }else {
            $agent_id = ""; 
            $user_id = '';
        }

        
        $Int_student = IntStudent::create([
            'field_1' => $request->field_1,
            'field_2' => $request->field_2,
            'field_3' => $request->field_3,
            'field_4' => $request->field_4,
            'field_5' => $request->field_5,
            'field_6' => $request->field_6,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'first_lang' => $request->first_lang,
            'country' => $request->country,
            'passport_num' => $request->passport_num,
            'year' => $request->year,
            'month' => $request->month,
            'lang' => $request->lang,
            'note' => $request->note,
            'active' => '1',
            'status' => '1',
            'agent_id'=> $agent_id,
            'user_id' => $user_id
        ]);

        if ($request->cv) {
            $cv = 'uploads/'.time() . '-' . $request->cv->getClientOriginalName();
            $Int_student->cv = $cv;
            $request->cv->move(public_path('uploads'), $cv);
        }
        if ($request->cp_passport) {
            $cp_passport = 'uploads/'.time() . '.' . $request->cp_passport->getClientOriginalName();
            $Int_student->cp_passport = $cp_passport;
            $request->cp_passport->move(public_path('uploads'), $cp_passport);
        }
        if ($request->cer_1) {
            $cer_1 = 'uploads/'.time() . '-' . $request->cer_1->getClientOriginalName();
            $Int_student->cer_1 = $cer_1;
            $request->cer_1->move(public_path('uploads'), $cer_1);
        }
        if ($request->cer_2) {
            $cer_2 = 'uploads/'.time() . '-' . $request->cer_2->getClientOriginalName();
            $Int_student->cer_2 = $cer_2;
            $request->cer_2->move(public_path('uploads'), $cer_2);
        }
        if ($request->cer_3) {
            $cer_3 = 'uploads/'.time() . '-' . $request->cer_3->getClientOriginalName();
            $Int_student->cer_3 = $cer_3;
            $request->cer_3->move(public_path('uploads'), $cer_3);
        }
        if ($request->cer_4) {
            $cer_4 = 'uploads/'.time() . '-' . $request->cer_4->getClientOriginalName();
            $Int_student->cer_4 =  $cer_4;
            $request->cer_4->move(public_path('uploads'), $cer_4);
        }
        if ($request->cer_5) {
            $cer_5 = 'uploads/'.time() . '-' . $request->cer_5->getClientOriginalName();
            $Int_student->cer_5 = $cer_5 ;
            $request->cer_5->move(public_path('uploads'), $cer_5);
        }
        if ($request->cer_6) {
            $cer_6 = 'uploads/'.time() . '-' . $request->cer_6->getClientOriginalName();
            $Int_student->cer_6 = $cer_6;
            $request->cer_6->move(public_path('uploads'), $cer_6);
        }
        if ($request->cer_7) {
            $cer_7 = 'uploads/'.time() . '-' . $request->cer_7->getClientOriginalName();
            $Int_student->cer_7 = $cer_7 ;
            $request->cer_7->move(public_path('uploads'), $cer_7);
        }

        $finalArray = array();
        for ($i = 0; $i < count(collect($request->edu_institution)); $i++) {
            array_push(
                $finalArray,
                array(
                    'edu_institution' => $request->edu_institution[$i],
                    'edu_address' => $request->edu_address[$i],
                    'edu_start_date' => $request->edu_start_date[$i],
                    'edu_end_date' => $request->edu_end_date[$i],
                    'edu_result' => $request->edu_result[$i],
                )
            );
            $test = json_encode($finalArray);
        }

        $Int_student->edu_summary = $test;
        $Int_student->save();

        return redirect('/int_student')->with('success', 'Your form has been submitted.');
    }


    public function show($id)
    {
       
        $editData = IntStudent::find($id);

        $iraqStudent = IntStudent::where('id',$id)->where('agent_id',1000)->first(); 
        $isIraqStudent = isset($iraqStudent) ? 1 :0; 
        // this student is under an agent moin
        $hasAgent = is_null($editData->agent_id) ? 1 : 0;
        // $hasAgent = true && session::get('role') != '3' ? 0 : 1;
        
        $countries = country::all();
        $studentDocuments = StudentDocument::where('student_id', $id)->get();
        
        $studentNotes = StudentNote::where('student_id', $id)->latest()->get();
        $facilityType = FacilityType::all();
        $studentCustomeNotes = StudentCustomeNote::where('student_id',$id)->with('facilityType')->get();
        $templates = SettingTemplate::all();
        return view('int_student.view', compact('templates','hasAgent','isIraqStudent','facilityType','editData', 'countries','studentDocuments','studentNotes','studentCustomeNotes'));
    }

    public function edit($id)
    {

        $editData = IntStudent::find($id);
        $countries = country::all();
        return view('int_student.edit', compact('editData', 'countries'));
    }


    public function update(Request $request, $id)
    {
        // dd("hi");
        $request->validate(
            [
                'field_1' => 'required',
                'field_2' => 'required',
                'field_3' => 'required',
                'field_4' => 'required',
                'field_5' => 'required',
                'field_6' => 'required',
                'address' => 'required',
                'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
                'email' => 'required|email',
                'gender' => 'required',
                'first_lang' => 'required',
                'country' => 'required',
                'passport_num' => 'required',
                'lang' => 'required',
                'year' => 'required',
                'month' => 'required',
                'note' => 'nullable',
                "edu_institution.*"  => "required",
                "edu_address.*"  => "required",
                "edu_start_date.*"  => "required",
                "edu_end_date.*"  => "required",
                "edu_result.*"  => "required",
                // 'cv' => 'required|max:2048',
                // 'cp_passport' => 'required|max:2048',
                // 'cer_1' => 'required|max:2048',
                // 'cer_2' => 'required|max:2048',
                // 'cer_3' => 'required|max:2048',
                // 'cer_4' => 'required|max:2048',
                // 'cer_5' => 'required|max:2048',
                // 'cer_6' => 'required|max:2048',
                // 'cer_7' => 'required|max:2048',

            ],
            [
                'term_agree.required' => 'Check this box to proceed',
            ]
        );

         // $data = IntStudent::find($id);
        $data =  IntStudent::select('cv','cp_passport','cer_1','cer_2','cer_3','cer_4','cer_5','cer_6','cer_7','agent_id','user_id','status' , 'administrator_id')->where('id', $id)->first();

         $old_cv = $data->cv;
         $old_cp_passport = $data->cp_passport;
         $old_cer_1 = $data->cer_1;
         $old_cer_2 = $data->cer_2;
         $old_cer_3 = $data->cer_3;
         $old_cer_4 = $data->cer_4;
         $old_cer_5 = $data->cer_5;
         $old_cer_6 = $data->cer_6;
         $old_cer_7 = $data->cer_7;
         $agent_id = $data->agent_id;
         $user_id = $data->user_id;
         $status = $data->status;
         $administrator_id = $data->administrator_id;

        IntStudent::destroy($id);

        $Int_student = IntStudent::create([
            'field_1' => $request->field_1,
            'field_2' => $request->field_2,
            'field_3' => $request->field_3,
            'field_4' => $request->field_4,
            'field_5' => $request->field_5,
            'field_6' => $request->field_6,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'gender' => $request->gender,
            'first_lang' => $request->first_lang,
            'country' => $request->country,
            'passport_num' => $request->passport_num,
            'year' => $request->year,
            'month' => $request->month,
            'lang' => $request->lang,
            'note' => $request->note,
            'active' => '1',
            'status' => $status,
            'agent_id'=> $agent_id,
            'user_id' => $user_id,
            'administrator_id' => $administrator_id,
        ]);

       

        if ($request->cv) {
            $cv = time() . '-' . $request->cv->getClientOriginalName();
            $Int_student->cv = $cv;
            $request->cv->move(public_path('uploads'), $cv);
        }else {
            $Int_student->cv = $old_cv ;
        }

        if ($request->cp_passport) {
            $cp_passport = time() . '-' . $request->cp_passport->getClientOriginalName();
            $Int_student->cp_passport = $cp_passport;
            $request->cp_passport->move(public_path('uploads'), $cp_passport);
        }else {
            $Int_student->cp_passport = $old_cp_passport ;
        }
        if ($request->cer_1) {
            $cer_1 = time() . '-' . $request->cer_1->getClientOriginalName();
            $Int_student->cer_1 = $cer_1;
            $request->cer_1->move(public_path('uploads'), $cer_1);
        }else {
            $Int_student->cer_1 = $old_cer_1 ; 
        }
        if ($request->cer_2) {
            $cer_2 = time() . '-' . $request->cer_2->getClientOriginalName();
            $Int_student->cer_2 = $cer_2;
            $request->cer_2->move(public_path('uploads'), $cer_2);
        }else {
            $Int_student->cer_2 = $old_cer_2 ; 
        }
        if ($request->cer_3) {
            $cer_3 = time() . '-' . $request->cer_3->getClientOriginalName();
            $Int_student->cer_3 = $cer_3;
            $request->cer_3->move(public_path('uploads'), $cer_3);
        }else {
            $Int_student->cer_3 = $old_cer_3 ; 
        }
        if ($request->cer_4) {
            $cer_4 = time() . '-' . $request->cer_4->getClientOriginalName();
            $Int_student->cer_4 = $cer_4;
            $request->cer_4->move(public_path('uploads'), $cer_4);
        }else {
            $Int_student->cer_4 = $old_cer_4 ; 
        }
        if ($request->cer_5) {
            $cer_5 = time() . '-' . $request->cer_5->getClientOriginalName();
            $Int_student->cer_5 =  $cer_5;
            $request->cer_5->move(public_path('uploads'), $cer_5);
        }else {
            $Int_student->cer_5 = $old_cer_5 ; 
        }
        if ($request->cer_6) {
            $cer_6 = time() . '-' . $request->cer_6->getClientOriginalName();
            $Int_student->cer_6 = $cer_6;
            $request->cer_6->move(public_path('uploads'), $cer_6);
        }else {
            $Int_student->cer_6 = $old_cer_6 ; 
        }
        if ($request->cer_7) {
            $cer_7 = time() . '-' . $request->cer_7->getClientOriginalName();
            $Int_student->cer_7 = $cer_7 ;
            $request->cer_7->move(public_path('uploads'), $cer_7);
            
        }else {
            $Int_student->cer_7 = $old_cer_7 ; 
        }

        $finalArray = array();
        for ($i = 0; $i < count(collect($request->edu_institution)); $i++) {

            array_push(
                $finalArray,
                array(
                    'edu_institution' => $request->edu_institution[$i],
                    'edu_address' => $request->edu_address[$i],
                    'edu_start_date' => $request->edu_start_date[$i],
                    'edu_end_date' => $request->edu_end_date[$i],
                    'edu_result' => $request->edu_result[$i],
                )
            );
            $test = json_encode($finalArray);
        }

        $Int_student->edu_summary = $test;
        $Int_student->save();
   
        // return back()->with('success', 'Your form has been updated.');
        return redirect('/int_student')->with('success', 'Your form has been updated.');

     
    }

    public function destroy($id)
    {
        $user = IntStudent::find($id);
        $user->active = 0;
        $result = $user->update();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');
        if ($result) {
            return back()->with('success', 'Student has been deleted successfully');
        } else {
            return back()->with('error', 'Student has not been deleted ! Try later ');
        }
    }

    public function deleteUserView($user_id)
    {
        return view('int_student/deleteUser', compact('user_id'));
    }

    public function assign(){
        // $Admission_officers = DB::select(DB::raw("SELECT * FROM dtb_users where role = '2'"));
        $Admission_officers = DB::select(DB::raw("SELECT u.*, r.role_name 
            FROM dtb_users u 
            LEFT JOIN mtb_roles r ON u.role = r.id
            WHERE u.role = 1"));
        
        return view('int_student.assign', compact('Admission_officers'));
    }

    public function assignStudent($id){
        $Admission_officer = DB::table('dtb_users')->where('id', $id)->first();
        $IntStudents = IntStudent::all()->where('administrator_id','=','');
        return view('int_student.assignStudent',compact('IntStudents','Admission_officer'));
    }

    public function assignCreate(Request $request){

        $administrator_id = $request->administrator_id;
        $students = $request->students;
        foreach($students as $student){
            $data = IntStudent::find($student);
        //   $comics = new Comic();
          $data->administrator_id = $administrator_id ;
          $data->save();
       }

       return redirect('/assign')->with('success', 'Students Assigned Successfully !');

    }

    public function assignView($id){
        $Admission_officer_id = DB::table('dtb_users')->where('id', $id)->value('id');
        $IntStudents = IntStudent::all()->where('administrator_id','=',$Admission_officer_id)->where('active',1);
        $Admission_officer_name = DtbUser::select('name')->where('id',$Admission_officer_id)->pluck('name')->first();
        
        return view('int_student.assignView',compact('IntStudents','Admission_officer_name'));
    }

    public function statusChange(Request $request){
                
        $request->validate(
            [
                'new_status' => 'required',
                'admission_date' => 'required',
                'course_title' => 'required',
                'uni_name' => 'required'
                
            ]  
        );
            $student_id = $request->student_id ; 

            $editData = IntStudent::find($student_id);
            $id = $editData->id ;
            $editData->status = $request->new_status ;
            $editData->admission_date = $request->admission_date ;
            $editData->course_title = $request->course_title ;
            $editData->university =$request->uni_name ;
            $editData->save();

           
            return redirect()->route('int_student.edit', [$id])->with('success', 'Students Status Changed Successfully !');
            
    }

    public function deleteAssign($user_id)
    {
        return view('int_student/deleteAssign', compact('user_id'));
    }
   
    public function destroyAssign($id)
    {
        $user = IntStudent::find($id);
        $user->administrator_id = 0;
        $result = $user->update();
        // DtbActivityLog::updateActivityLog('deleted', 'a user');
        if ($result) {
            return back()->with('success', 'Student Assigned updated Succesfully');
        } else {
            return back()->with('error', 'Student Assigned not updated ! Try later ');
        }
    }

    public function autocompleteSearch(Request $request)
    {
            if($request->get('query'))
            {
             $query = $request->get('query');
             $data = DB::table('universities')
               ->where('name', 'LIKE', "%{$query}%")
               ->get();
               $count = $data->count();
               if($count > 0 ){
                $output = '<ul class="dropdown-menu" style="display:block; position:relative">';
                foreach($data as $row)
                {
                 $output .= '
                 <li><a href="#">'.$row->name.'</a></li>
                 ';
                }
                $output .= '</ul>';
                echo $output;
               }else {
                $output = '<a class="btn btn-primary btn-sm mt-2 mb-2" id="add_uni" >Add University</a>';
                echo $output;
               }
             
            }
           
    } 

    public function saveUniversity(Request $request)
    {
        
        \DB::table('universities')->insert([
            'name' => $request->name, 
        ]);

        return response()->json(
            [
                'success' => true,
                'message' => 'University Added Sucessfully'
            ]
        );

    }



    public function studentUpload(Request $request)
    {
        $studentDocument = new StudentDocument();
        $studentDocument->student_id = $request->student_id;
        $studentDocument->doc_name = $request->doc_name;
        if($request->file('doc_file')){
            $image = $request->file('doc_file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads'), $imageName);
            $studentDocument->doc_path = $imageName;
            $studentDocument->type = $image->getClientOriginalExtension();
        }
        
        $result = $studentDocument->save();
        if($result){

            DtbActivityLog::updateActivityLog('Upload', 'Student Document');
            
            $this->sendEmailAfterUpload($request->student_id,'document');
        }

        $editData = IntStudent::find($request->student_id);

        $studentDocuments = StudentDocument::where('student_id', $request->student_id)->get();
 
        return view('int_student.documents.inner_div_data', compact('editData','studentDocuments'));

    }


    public function sendEmailAfterNoteAndCustomNote($id,$noteId,$type)
    {
        $student = IntStudent::where('id',$id)->with('agent','administrator','studentNote','studentCustomNote')->first();
        $superAdmin = DtbUser::where('id',0)->first();
       
        $emails = array();
        if(isset($student->agent))$emails[] = $student->agent->email;
        if(isset($student->administrator))$emails[] = $student->administrator->email;
        // if student is not assigned to any agent.
        if(isset($student) && is_null($student->agent_id))$emails[] = $student->email;
        if(isset($superAdmin))$emails[] = $superAdmin->email;
        
        $data["email"] = $emails ;
        $data["form"] = "support@globaladmission.uk.com";
        $data["title"] = "A new $type uploaded";

        switch($type){
            case 'note':
                $studentNote = StudentNote::where('id',$noteId)->first();  
                $data["body"] =  !is_null($studentNote) ? $studentNote->notes : '';
                break;
            case 'custom note':
                $studentCustomNote = StudentCustomeNote::where('id',$noteId)->first();  
                $data["body"] =  !is_null($studentCustomNote) ? $studentCustomNote->notes : '';
                break;
        }
       

    
        Mail::send('emails.noteAndCustomNoteUpload', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
            
        });
    }

    public function sendEmailAfterUpload($id,$type)
    {
        $student = IntStudent::where('id',$id)->with('agent','administrator')->first();
        $superAdmin = DtbUser::where('id',0)->first();

        $emails = array();
        if(isset($student->agent))$emails[] = $student->agent->email;
        if(isset($student->administrator))$emails[] = $student->administrator->email;
        // if student is not assigned to any agent.
        if(isset($student) && is_null($student->agent_id))$emails[] = $student->email;
        if(isset($superAdmin))$emails[] = $superAdmin->email;

        $data["email"] = $emails ;
        $data["form"] = "support@globaladmission.uk.com";
        $data["title"] = "A new $type uploaded";
        $data["body"] = "A new $type uploaded for '".$student->field_5."' and Student Id is ".$student->id." . Please check the $type";

    
        Mail::send('emails.docUpload', $data, function($message)use($data) {
            $message->to($data["email"], $data["email"])
                    ->subject($data["title"]);
            
        });
    }


    public function studentNotes(Request $request)
    {
        $studentNotes = new StudentNote();
        $studentNotes->student_id = $request->student_id;
        $studentNotes->notes = $request->notes;
        if($request->file('doc_file')){
            $image = $request->file('doc_file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads'), $imageName);
            $studentNotes->doc_path = $imageName;
        }
        $studentNotes->added_by = Session::get('user_id');
        $result = $studentNotes->save();
        if($result){
            DtbActivityLog::updateActivityLog('Upload', 'Student Document');
            $this->sendEmailAfterNoteAndCustomNote($request->student_id,$studentNotes->id,'note');
   
        }
        if($result)
        {
            $studentNotes = StudentNote::where('student_id', $request->student_id)->latest()->get();
            return view('int_student.notes.inner_div_data', compact('studentNotes'));
        }
     
    }

    public function studentCustomeNotes(Request $request)
    {
      
        $studentDocument = new StudentCustomeNote();
        $studentDocument->student_id = $request->student_id;
        $studentDocument->facility_type = $request->facility_type;
        $studentDocument->notes = $request->notes;
        $studentDocument->date = $request->date;
        if($request->file('doc_file')){
            $image = $request->file('doc_file');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('/uploads'), $imageName);
            $studentDocument->doc_path = $imageName;
            $studentDocument->type = $image->getClientOriginalExtension();
        }
        
        $result = $studentDocument->save();
        if($result){
            DtbActivityLog::updateActivityLog('Upload', 'Student custom note');
            
            $this->sendEmailAfterNoteAndCustomNote($request->student_id,$studentDocument->id,'custom note');

        }
        if($result)
        {
            $studentCustomeNotes = StudentCustomeNote::where('student_id',$request->student_id)->with('facilityType')->get();
            return view('int_student.custome_note.inner_div_data', compact('studentCustomeNotes'));
        }
        // if($result)
        // {
        //     $studentDocuments = StudentCustomeNote::with('facilityType')->where('id',$studentDocument->id)->first();
        //     return response()->json(['status' => 'suceess','message'=>'Student Note Uploaded Successfully','data'=>$studentDocuments]);
        // }
        // else
        // {
        //     return response()->json(['status' => 'error','message'=>'Something went wrong','data'=>'']);
        // }  
    }

    public function getStudentCustomeNotes($id)
    {
        $studentDocuments = StudentCustomeNote::where('id',$id)->first();
        return response()->json(['status' => 'suceess','message'=>'','data'=>$studentDocuments]);
    }

    public function showDeleteDocument($id,$document_for=0)
    {
        return view('int_student.documents.delete_document', compact('id','document_for'));
    }

    public function deleteDocument(Request $request)
    {
        
        $student_id = 0;
        if($request->document_for != 0)
        {
            $intStudent =  IntStudent::where('id',$request->id)->first();
            $student_id = $intStudent->id;
            switch($request->document_for)
            {   
                case 1:
                    if($intStudent->cv != null) 
                    {
                        $path = public_path($intStudent->cv);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cv = null;
                        }

                    }
                break;
                case 2:
                    if($intStudent->cp_passport != null) 
                    {
                        $path = public_path($intStudent->cp_passport);
                      
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cp_passport = null;
                        }
                    }
                break;
                case 3:
                    if($intStudent->cer_1 != null) 
                    {
                        $path = public_path($intStudent->cer_1);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_1 = null;
                        }
                    }
                break;
                case 4:
                    if($intStudent->cer_2 != null) 
                    {
                        $path = public_path($intStudent->cer_2);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_2 = null;
                        }
                    }
                break;
                case 5:
                    if($intStudent->cer_3 != null) 
                    {
                        $path = public_path($intStudent->cer_3);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_3 = null;
                        }
                    }
                break;
                case 6:
                    if($intStudent->cer_4 != null) 
                    {
                        $path = public_path($intStudent->cer_4);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_4 = null;
                        }
                    }
                break;
                case 7:
                    if($intStudent->cer_5 != null) 
                    {
                        $path = public_path($intStudent->cer_5);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_5 = null;
                        }
                    }
                break;
                case 8:
                    if($intStudent->cer_6 != null) 
                    {
                        $path = public_path($intStudent->cer_6);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_6 = null;
                        }
                    }
                break;
                case 9:
                    if($intStudent->cer_7 != null) 
                    {
                        $path = public_path($intStudent->cer_7);
                        if(file_exists($path)){
                            unlink($path);
                            $intStudent->cer_7 = null;
                        }
                    }
                break;
            }
            $result = $intStudent->save();
        }
        else
        {
            $studentDocument = StudentDocument::where('student_id',$request->id)->first();
            $student_id = $studentDocument->id;
            $path = public_path('/uploads/'.$studentDocument->doc_path);

            if(file_exists($path)){
                unlink($path);
            }
            $result = $studentDocument->delete();
        }
       
        $editData = IntStudent::find($request->id);
      
        $studentDocuments = StudentDocument::where('student_id', $student_id)->get();
        DtbActivityLog::updateActivityLog('Delete a', 'Student Document');
 
        return view('int_student.documents.inner_div_data', compact('editData','studentDocuments'));
    }

    public function showDeleteNote($id)
    {
        return view('int_student.notes.delete_note', compact('id'));
    }

    public function deleteNote(Request $request)
    {
        $studentNote = StudentNote::find($request->id);
        $student_id = $studentNote->student_id;
        $result = $studentNote->delete();

        if($result){
            DtbActivityLog::updateActivityLog('Delete a ', 'Student note');

            $studentNotes = StudentNote::where('student_id', $student_id)->latest()->get();
            return view('int_student.notes.inner_div_data', compact('studentNotes'));
        }
    }

    
}
