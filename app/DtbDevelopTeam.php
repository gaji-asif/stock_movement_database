<?php

namespace App;
use Session;

use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class DtbDevelopTeam extends Model
{

   protected $guarded = [];

    public static function addTeam($request){

        $cloud_front_path = "";
        $iconpath = "";
        if ($request->hasFile('team_icon')) {
            $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
            $cloud_front_path = env('AWS_URL') . '/';
            $iconpath = Storage::disk('s3')->put('users', $request->team_icon);
        }


    	$developer_id = Session::get('developer_id');
    	$teams = new DtbDevelopTeam;
    	$teams->team_name = $request->team_name;
    	$teams->description = $request->description;
        $teams->developer_id = $developer_id;
        $teams->icon_path = $cloud_front_path.$iconpath;
    	$results = $teams->save();
    	return $results;
    }

    public static function updateTeam($request, $id){


        $cloud_front_path = "";
        $iconpath = "";
        if ($request->hasFile('team_icon')) {
            $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
            $cloud_front_path = env('AWS_URL') . '/';
            $iconpath = Storage::disk('s3')->put('users', $request->team_icon);
        }
        else{
            $teams = DtbDevelopTeam::find($id);
            $iconpath = $teams->icon_path;
            
        }


        

    	$teams = DtbDevelopTeam::find($id);
    	$teams->team_name = $request->team_name;
        $teams->description = $request->description;
        $teams->icon_path = $cloud_front_path.$iconpath;
    	$results = $teams->update();
    	return $results;
    }


    public function devteamuser(){
        return $this->hasMany(DtbDevelopTeamUser::class,'team_id');
    }



}
