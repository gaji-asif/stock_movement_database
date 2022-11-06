<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbNews;
use Session;
use DB;
use Illuminate\Support\Facades\Storage;
use App\DtbNewsCategory;

class DtbNewsController extends Controller
{
 
	public function index(Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'News List'
        );

		$loggedindeveloper = Session::get('developer_id');
		
         $newslist = DtbNews::query()
        ->from('dtb_news as n')
        ->leftjoin('dtb_news_categories as c','n.category_id', '=', 'c.id')
        ->where('n.developer_id', $loggedindeveloper)
        ->orderBy('ordering','ASC')
        ->get(['n.*', 'c.name as category_name']);

		return view('settings.developerSettings.news.index',compact('newslist','common_array'));


	}	


	public function allnews(Request $request){


        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'All Newses'
        );

		$loggedindeveloper = Session::get('developer_id');
		$newslist = DtbNews::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

		return view('settings.developerSettings.news.allnews',compact('newslist','common_array'));

	}	




    public function show($newsid,Request $request)
    {

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'News Details'
        );

        $loggedindeveloper = Session::get('developer_id');

        $newsdetails = DtbNews::where('id',$newsid)->first();
        return view('settings.developerSettings.news.show',compact('newsdetails','newsid','common_array'));


    }   



    public function create(Request $request)
    {

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Create News'
        );
         $loggedindeveloper = Session::get('developer_id');

        $newsCats = DtbNewsCategory::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();
        return view('settings.developerSettings.news.create',compact('common_array', 'newsCats'));


    }


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
            'title'=>'required',
            'detail'=>'required',
            'category_id'=>''
        ]);

        DB::table('dtb_news')->insert(
        ['developer_id' => $developer_id, 'title' => $request->get('title'), 'category_id' => $request->get('category_id'), 'detail' => $request->get('detail')]);

        //return back()->with('message', 'Data has been added!');
        return redirect('news')->with('message', "News has been added.");

 }



    public function edit($newsid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Edit News'
        );

        $newsdetails = DtbNews::where('id',$newsid)->first();
         $loggedindeveloper = Session::get('developer_id');
        $newsCats = DtbNewsCategory::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

        return view('settings.developerSettings.news.edit',compact('common_array','newsid','newsdetails', 'newsCats'));
    }   


     public function update($newsid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end
        
        $developer_id = Session::get('developer_id');

        $data = request()->validate([
            'title'=>'required',
            'detail'=>'required',
            'category_id'=>''
        ]);

        DB::table('dtb_news')->where('id',$newsid)->update(
        ['developer_id' => $developer_id, 'title' => $request->get('title'), 'category_id' => $request->get('category_id'), 'detail' => $request->get('detail')]);

        //return back()->with('message', 'Data has been updated!');
         return redirect('news')->with('message', "News has been updated");

       // return back()->with('message', 'Data has been updated!');


    }





     public function updateOrder(Request $request){

	    $loggedindeveloper = Session::get('developer_id');
	    $newslist = DtbNews::where('developer_id',$loggedindeveloper)->get();

	        foreach ($newslist as $newsitem) {

	            $newsitem->timestamps = false; // To disable update_at field updation
	            $id = $newsitem->id;

	            foreach ($request->order as $order) {
	                if ($order['id'] == $id) {
	                    $newsitem->update(['ordering' => $order['position']]);
	                }
	            }

	        }

	    return response('Update Successfully.', 200);

	 }



    // Upload isseue 
public function newsfileupload(Request $request){

    $image = $request->file('file');

    $cloud_front_path = 'https://'.env('AWS_URL') . '/';

    $userImageFile =Storage::disk('s3')->put('newsfiles', $request->file('file'));

    if ($userImageFile) {
        echo $cloud_front_path.$userImageFile;
            // echo $host = request()->getHost();
    }else{
        echo "File not uploaded,please try again";
    }
}  



public function newsItemdelete(Request $request)
  {
    
    DB::delete('delete from dtb_news where id = ?',[$request->get('newsID')]);
    //DB::delete('delete from dtb_test_cases where test_sheet_id = ?',[$request->get('testSheetId')]);
    
    //DtbActivityLog::updateActivityLogPro('deleted', 'app', $id);

    echo "Record has been deleted";
  }




}
