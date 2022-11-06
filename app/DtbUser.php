<?php

namespace App;
use Session;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class DtbUser extends Model
{

	public function getCreated_timestampAttribute()
	{
	    return $this->created_at->timestamp();
	}

    public function verifyUser()
	{
    	  return $this->hasOne('App\VerifyUser', 'user_id');
	}   

	public function dtbissue()
	{
	  return $this->hasOne('App\DtbIssue', 'user_id');
	}	

	public function teamuser()
	{
	  return $this->hasOne('App\DtbDevelopTeamUser', 'user_id');
	}	

	public function usersproject()
	{
	  return $this->hasOne('App\DtbUsersProject', 'user_id');
	}

	public function roles(){
		return $this->belongsTo('App\MtbRole', 'role', 'id');
	}

	public function language(){
		return $this->belongsTo('App\MtbLanguage', 'language_id', 'id');
	}

	public function timezone(){
		return $this->belongsTo('App\MtbTimezone', 'timezone_id', 'id');
	}

	public static function registration($request){

		if($request){
			$user = new DtbUser;
	        $user->name = $request->name;
			$user->email = $request->email;
			$user->password = md5($request->password);
			$user->developer_id = 0;
			$user->role = 3;   
			$result = $user->save();
			$LastInsertId = $user->id;

			if($result){
				$verifyusers = new VerifyUser;
				$verifyusers->user_id = $LastInsertId;
				$verifyusers->token = sha1(time());
				$result = $verifyusers->save();
				// saving to int_student
				// $int_student = new IntStudent; 
				// $int_student->email = $request->email ;
				// $int_student->field_5 = $request->name;
				// $int_student->user_id = $LastInsertId;
				// $int_student->save();
			}

			return $user;
		}
    }

    public static function addUser($request){

// 		$cloud_front_path="";
// 		$userImageFile = "";
// 		if ($request->hasFile('userImage')) {
// // 		    $url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
// 		    $cloud_front_path = 'https://'.env('AWS_URL') . '/';
// 			$userImageFile = Storage::disk('s3')->put('users', $request->userImage);
// 		}

		$password = '123456';
		$developer_id = Session::get('developer_id');
		$user = new DtbUser;
		$user->ud_id = $request->ud_id;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = md5($password);
		$user->developer_id = $developer_id;
		$user->role = $request->role;
		//$user->icon_image_path = $cloud_front_path.$userImageFile;
		 
		$user->verified = 1;
		$result = $user->save();
		$LastInsertId = $user->id;

		return $user;
		
    }

    public static function updateUser($request, $id){

// 		$cloud_front_path = "";
// 		$userImageFile = "";
// 		if ($request->hasFile('userImage')) {
// // 			$url = 'https://s3.' . env('AWS_REGION') . '.amazonaws.com/' . env('AWS_BUCKET') . '/';
// 			$cloud_front_path = 'https://'.env('AWS_URL') . '/';
// 			$userImageFile = Storage::disk('s3')->put('users', $request->userImage);
// 		}
// 		else{
// 			$user = DtbUser::find($id);
//             $userImageFile = $user->icon_image_path;
// 		}

	    $developer_id = Session::get('developer_id');
		$user = DtbUser::find($id);
		$user->ud_id = $request->ud_id;
		$user->name = $request->name;
		$user->email = $request->email;
		$user->developer_id = $developer_id;
		$user->role = $request->role;
		$result = $user->update();
		
        return $user;
		
    }

   public function getUrlAttribute()
    {
        return Storage::disk('s3')->url($this->path);
    }
    //Update last access URL
    public static function updateUserLastAccessUrl($request){
        
        $user = DtbUser::find($request->id);
        $user->url1 = $request->url1;
        $user->update();

        return $user;
        
    }
    

}
