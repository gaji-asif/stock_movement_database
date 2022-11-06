<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use App\DtbIssueCategory;
use App\DtbActivityLog;
use App\DtbProject;
use DB;

class DtbDeveloperCategoryController extends Controller
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
        $dtbissuecategory = DtbIssueCategory::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();
        return view('settings.developerSettings.categoriesSettings.index',compact('dtbissuecategory', 'common_array'));
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
            'content_heading' => 'Create Category'
        );


        return view('settings.developerSettings.categoriesSettings.create',compact('common_array'));
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
            'name'=>'required'
           
        ]);

        DB::table('dtb_issue_categories')->insert(
        [
        
        'developer_id' => $developer_id, 
        'project_id' => 0,
        'category_name' => $request->get('name'), 
        'points' => $request->get('points'), 
        'details' => $request->get('note')
       ]);

        

         return redirect('category')->with('message', "Category has been added.");

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
    public function edit($catid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Edit Category'
        );

        $Catdetails = DtbIssueCategory::where('id',$catid)->first();

        return view('settings.developerSettings.categoriesSettings.edit',compact('common_array','catid','Catdetails'));
    } 


     public function Catorder(Request $request){

        //echo "ok";
        //exit;

        $loggedindeveloper = Session::get('developer_id');
        $newslist = DtbIssueCategory::where('developer_id',$loggedindeveloper)->get();

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
    public function update($catid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        
        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'category_name'=>'required',
            
        ]);

        DB::table('dtb_issue_categories')->where('id',$catid)->update(
        [

        'developer_id' => $developer_id, 
        'project_id' => 0,
        'category_name' => $request->get('category_name'), 
        'points' => $request->get('points'), 
        'details' => $request->get('details')

        ]);

        return redirect('category')->with('message', "Category has been updated.");

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
