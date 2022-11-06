<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DtbNewsCategory;
use Session;
use DB;
use Illuminate\Support\Facades\Storage;

class DtbNewsCategoryController extends Controller
{
 
	public function index(Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'News Category List'
        );

		$loggedindeveloper = Session::get('developer_id');
		$newsCatlist = DtbNewsCategory::where('developer_id',$loggedindeveloper)->orderBy('ordering','ASC')->get();

		return view('settings.developerSettings.news-category.index',compact('newsCatlist','common_array'));


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
            'content_heading' => 'Create News Category'
        );


        return view('settings.developerSettings.news-category.create',compact('common_array'));


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
            'name'=>'required'
           
        ]);

        DB::table('dtb_news_categories')->insert(
        ['developer_id' => $developer_id, 'name' => $request->get('name'), 'note' => $request->get('note')]);

        //return back()->with('message', 'News Category has been added!');

         return redirect('news-category')->with('message', "News Category has been added.");

        //return back()->with('message', 'News Category has been added!');


       // return view('settings.developerSettings.news.create',compact('common_array'));


    }



    public function edit($newsid,Request $request){

        //redirect to login page with running visited page url; ### statt
        $visitedpage = $request->fullUrl();
        if (!Session()->has('user_id')) {
            return redirect('login')->with('url', $visitedpage);
        }
        //redirect to login page with running visited page url; ### end

        $common_array = array(
            'content_heading' => 'Edit News Category'
        );

        $newsdetails = DtbNewsCategory::where('id',$newsid)->first();

        return view('settings.developerSettings.news-category.edit',compact('common_array','newsid','newsdetails'));
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
            'name'=>'required',
            
        ]);

        DB::table('dtb_news_categories')->where('id',$newsid)->update(
        ['developer_id' => $developer_id, 'name' => $request->get('name'), 'note' => $request->get('note')]);

        //return back()->with('message', 'Category has been updated!');

        return redirect('news-category')->with('message', "Category has been updated.");

       // return back()->with('message', 'Category has been updated!');


    }





     public function newsCatorder(Request $request){

        //echo "ok";
        //exit;

	    $loggedindeveloper = Session::get('developer_id');
	    $newslist = DtbNewsCategory::where('developer_id',$loggedindeveloper)->get();

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






}
