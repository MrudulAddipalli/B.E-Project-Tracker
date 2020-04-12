<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

//ctrl+k and ctrl+1 for fold all
//ctrl+k and ctrl+j for unfolding all

//  ::find is for update and delete 
// App\TableName   ::select  ::where is for select 
// New App\TabelName  is for insert

//   /login and  /register view are present in View\Auth\ and controlls are present in BEPT\app\Http\Controllers\Auth\

// project guide rejection is based upon project_guide == null in db and act tells if project is 


Route::get('/', function () {
    return view('welcome');
});

//for student and teacher both
Route::get('/reset', function () {
    return view('reset');
});

//for student and teacher both
Route::post('/reset', function(Request $req){

	$email = strip_tags($req['email']);

	if(isset( $req['email'] ) )
	{
		//uid student
		if( is_numeric($email) )
		{			
			//find  and send otp to all group members
			$result = DB::table('users')->select('id')->where('email','=',$email)->first();
			if($result==null){ return redirect('/reset?err=Entered UID Not Found'); }
			$user  = App\User::find($result->id);   // this find  only works for primary keys only so $id is found first
			$otp = rand(1000,9999) ;
			$user->ackey = X_ENCRYPT($otp) ; //otp
			sendmail($user->email_gm1 , "Password Change Request" , "Password Change OTP Is ".$otp);
			sendmail($user->email_gm2 , "Password Change Request" , "Password Change OTP Is ".$otp);
			sendmail($user->email_gm3 , "Password Change Request" , "Password Change OTP Is ".$otp);
			sendmail($user->email_gm4 , "Password Change Request" , "Password Change OTP Is ".$otp);
			$user->save();
			$data = array('email' => $email);
			return view('reset2',$data);
		}
		else
		{
			//email id guide
			if( !isValidEmail( $email )  && $email!="" ) {  return redirect('/reset?err=Entered Email Id Is Not Valid');   }
			//send otp directly to $email
			$result = DB::table('users')->select('id')->where('email','=',$email)->first();
			if($result==null){ return redirect('/reset?err=Entered Email Id Not Found'); }
			$user  = App\User::find($result->id);   // this find  only works for primary keys only so $id is found first
			$otp = rand(1000,9000) ;
			$user->ackey = X_ENCRYPT($otp) ; //otp
			$user->act = 0; // again ask for submit access // why if submit access is entered and forgot password is done then?
			sendmail( $email , "Password Change Request" , "Password Change OTP Is ".$otp);
			$user->save();
			$data = array('email' => $email);
			return view('reset2',$data);
		}
	}

});

//for student and teacher both
Route::post('/reset2', function(Request $req){

	$email = strip_tags($req['email']);

	if(isset($req))
	{
		//here can be a UID
		//for email id which is hidden
		if( ! is_numeric($email) ) 
		{   
			if( !isValidEmail( $email )  && $email!="" ) 
				{  return Response::json(array('status'=>'error', 'errors'=>['Email Id Invalid.']),422); }   
		}

		$result = DB::table('users')->select('id')->where('email','=',$email)->first();
		if($result==null)
		{ 
			return Response::json(array('status'=>'error', 'errors'=>['Incorrect Attempt.']),422); // 'Incorrect Attempt.' becaue this email id is hidden
		}
		if(strip_tags($req['password'])==strip_tags($req['password_confirmation']))
		{	
			$id = $result->id;
			$user  = App\User::find( $id);   // this find  only works for primary keys only so $id is found first
			//check otp 
			$decrypted_ackey = X_DECRYPT( $user->ackey );
			if( $decrypted_ackey  == strip_tags($req['otp']) )
			{
				//change password	
				if( strlen( strip_tags( $req['password'] ) )  <  8 )
				{ return Response::json(array('status'=>'error', 'errors'=>['Password Must Be Of At Least 8 Charaters.']),422);  }
				else
				{ $user->password = bcrypt(strip_tags($req['password']));  }
				$user->save();
				return (array( 'status'=>'success' , 'url'=> '/login'));
			} 
			else { return Response::json(array('status'=>'error', 'errors'=>['Incorrect OTP.']),422);  }
		}		
		else { return Response::json(array('status'=>'error', 'errors'=>['Mismatch In Password And Confirm Password.']),422); }
	

	}

});

Route::get('/mail', function () {
    sendmail("mruduladdipalli@gmail.com","Not");
    //return view('welcome');
});

Route::get('/project', function () {
	$max = DB::table('users')->max('id');
    echo $max;
});


//teacher
Route::get('/task/{id}', function ($id,Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }

	//only for teacher if student found , illegal
	if(Auth::user()->type==1){ return redirect('/illegal'); }

		//checcking if guide is activated or not
		$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
		if( $userx->act == 0 ) {  return redirect('/submitaccess'); }
	
		if ( isset($req['filter']) ) 
		{
			$task = App\Task::where('project','=', strip_tags( $id ) )->where('status','=',strip_tags($req['filter']))->orderBy('id','DESC')->get();
			if(!$task){ return redirect('/illegal'); }
		}
		else
		{
			$task = App\Task::where('project','=',  strip_tags( $id ) )->orderBy('id','DESC')->get();
			if(!$task){ return redirect('/illegal'); }
		}

        $project = App\User::where('id','=',  strip_tags( $id ) )->where('project_guide','=',Auth::user()->id)->where('act','=',1)->first();		
		if(!$project){ return redirect('/illegal'); }

		$data = array('task' => $task,'pid'=> strip_tags( $id ) , 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );
    	return view('teachertask',$data);
});

//teacher chart
Route::get('/stat/{id}',function($id){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }
	//student - if student tries to access this page
	if(Auth::user()->type==1) {  return redirect('/illegal'); }
	//for guide
    if(Auth::user()->type==0)
	{
		$project = App\User::where('id','=',  strip_tags( $id ) )->where('project_guide','=',Auth::user()->id)->where('act','=',1)->first();
		if(!$project){ return redirect('/illegal'); }
	}

	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }

	$task = App\Task::where('project','=', strip_tags( $id ) )->get();
	if(!$task){ return redirect('/illegal'); }

		$data = array('task' => $task);
		return view('studentchart',$data);

});

//report same for teacher and student
Route::get('/report/{id}', function ($id,Request $req) {

		if( ! Auth::check() )  {   return redirect('/login');  }
		
		if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }

			//for student
		    // this is to check if logged in project group is been rejected from project guide or not
			if(Auth::user()->type==1)
			{
				if( strip_tags( $id ) != Auth::user()->id )  {  return redirect('/illegal'); }
				
				$users = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();
				$findguide = App\User::find($users->project_guide);
			    if( !$findguide ) {  return redirect('/editprofile'); }



				$task = App\Task::where('project','=',Auth::user()->id )->get();
				if(!$task){ return redirect('/illegal'); }

				$project = App\User::where('id','=',Auth::user()->id)->where('project_guide','!=','')->first();
				if(!$project){ return redirect('/illegal'); }


				$data = array('task' => $task, 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );


	            return view('teacherstudentreports',$data);
			}


			//for guide
		    // this is to check if logged in project group is been rejected from project guide or not
			if(Auth::user()->type==0)
			{
			
				$task = App\Task::where('project','=', strip_tags( $id ) )->get();
				if(!$task){ return redirect('/illegal'); }

				//to get project name under logged in project guide
				$project = App\User::where('id','=', strip_tags( $id ) )->where('project_guide','=',Auth::user()->id)->where('act','=',1)->first();
				if(!$project){ return redirect('/illegal'); }


				//checcking if guide is activated or not
				$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
				if( $userx->act == 0 ) {  return redirect('/submitaccess'); }


				$data = array('task' => $task, 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );


	            return view('teacherstudentreports',$data);
			}
		
});

//teacher
Route::post('/createtaskbulk', function(Request $req){


	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }



	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }




	$user = App\User::where('project_guide','=',Auth::user()->id )->where('act','=',1)->get();

	foreach ($user as $u) {

		$date = new DateTime();
		$now = $date->format('Y-m-d');
		$task = new App\Task;
		$task->detail = strip_tags($req['detail']);
		$task->doc = strip_tags($req['doc']);
		$task->project = $u->id;
		$task->doa  = $now;
		$task->status = 0;
		$task->rating = 0;
		$task->save();
		sendmail( $u->email_gm1 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail( $u->email_gm2 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail( $u->email_gm3 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail( $u->email_gm4 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		
		//sendnotfication("Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, $u->id);


	}
	return redirect('/home');

});

//teacher
Route::post('sendnotificationall',function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	sendnotficationall(strip_tags($req['message']));
	return redirect('/home');
});

//teacher
Route::get('/notification/{id}',function($id){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	$not  = App\Notification::where('rec','=', strip_tags( $id ) )->orderBy('id','DESC')->get();
	if(!$not){ return redirect('/illegal'); }

	//project details
	$project = App\User::where('id','=', strip_tags( $id ) )->where('project_guide','=',Auth::user()->id)->where('act','=',1)->first();
	if(!$project){ return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$data = array('not' => $not, 'pid'=> strip_tags( $id ) ,'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );


	return view('teachernotification',$data);

});

//teacher
Route::post('/createnotification',function(Request $req){


	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }


	$user  = App\User::find( strip_tags($req['pid']));
	if(!$user){ return redirect('/illegal'); }

	sendmail( $user->email_gm1 , "New Notification Received" , "Notification : ".strip_tags($req['detail']));
	sendmail( $user->email_gm2 , "New Notification Received" , "Notification : ".strip_tags($req['detail']));
	sendmail( $user->email_gm3 , "New Notification Received" , "Notification : ".strip_tags($req['detail']));
	sendmail( $user->email_gm4 , "New Notification Received" , "Notification : ".strip_tags($req['detail']));

	sendnotfication(strip_tags($req['detail']), strip_tags($req['pid']));

	$not  = App\Notification::where('rec','=',strip_tags($req['pid']))->orderBy('id','DESC')->get();
	if(!$not){ return redirect('/illegal'); }

	$data = array('not' => $not,'pid'=>strip_tags($req['pid']));
	
	return redirect('/notification/'.strip_tags($req['pid']));

});

//teacher
Route::get('/deletenotification/{nid}',function($nid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $nid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }



	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$noty = App\Notification::find( $nid );
	if(!$noty){ return redirect('/illegal'); }

	$proj = $noty->rec;
	$user  = App\User::find( $proj );
	if(!$user){ return redirect('/illegal'); }

	sendmail( $user->email_gm1 , "Notification Deleted" , "Notification Id : ".$nid." , Is Deleted <br><br>".$noty->message);
	sendmail( $user->email_gm2 , "Notification Deleted" , "Notification Id : ".$nid." , Is Deleted <br><br>".$noty->message);
	sendmail( $user->email_gm3 , "Notification Deleted" , "Notification Id : ".$nid." , Is Deleted <br><br>".$noty->message);
	sendmail( $user->email_gm4 , "Notification Deleted" , "Notification Id : ".$nid." , Is Deleted <br><br>".$noty->message);

	$noty->delete();
	return redirect('/notification/'.$proj);

});

//student
Route::get('/notification',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==0) {  return redirect('/illegal'); }



	        // this is to check if logged in project group is been rejected from project guide or not
			if(Auth::user()->type==1)
			{
				$userx = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();
				$findguide = App\User::find($userx->project_guide);
			    if( !$findguide ) {  return redirect('/editprofile'); }
			}


	$not  = App\Notification::where('rec','=',Auth::user()->id)->orderBy('id','DESC')->get();
	if(!$not){ return redirect('/illegal'); }

	$project = App\User::where('id','=',Auth::user()->id)->first();
	if(!$project){ return redirect('/illegal'); }

	$data = array('not' => $not , 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );

	return view('notification',$data);

});


//student
Route::get('/createproject', function () {

	$user = App\User::where('type','=',0)->where('act','=',1)->get();
	
															        //below data is made null coz JSOS.parse was causing problem becuase dataa format of encrypted values
																	//and also they have no use so made null
																	//we can modify select statement but it will take more time users table
																	

																	for($i=0 ; $i< count( $user ); $i++)
																	{
																		$user[$i]['name'] = $user[$i]['name'].' - '.strtoupper($user[$i]['email']);
																		$user[$i]['ackey'] = null ;
																		$user[$i]['password'] = null ;
																		$user[$i]['remember_token'] = null ;
																		$user[$i]['created_at'] = null ;
																		$user[$i]['updated_at'] = null ;
																	}

    $data = array('user' => $user );

	return view('createproject', $data);


});

//student
Route::post('/createproject', function (Request $req) {	

		$errors = "";
		
		$glyphicon = "<span class='glyphicon glyphicon-remove'></span><br>";

		$user = App\User::where('project_title','=', strip_tags($req['pt']))->get();


		if ($user->count()>0) 
		{
			$errors.=$glyphicon."Select Different Project Name";
		}


		if( !isValidEmail( strip_tags($req['eg1']) )  && strip_tags( $req['eg1'] ) !="" ) 
			{     $errors.=$glyphicon."Email Id of Group Member 1 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);     }
		if( !isValidEmail( strip_tags($req['eg2']) )  && strip_tags( $req['eg2'] ) !="" ) 
			{     $errors.=$glyphicon."Email Id of Group Member 2 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);     }
		if( !isValidEmail( strip_tags($req['eg3']) )  && strip_tags( $req['eg3'] ) !="" ) 
			{     $errors.=$glyphicon."Email Id of Group Member 3 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);     }
		if( !isValidEmail( strip_tags($req['eg4']) )  && strip_tags( $req['eg4'] ) !="" ) 
			{     $errors.=$glyphicon."Email Id of Group Member 4 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);     }


		if( strip_tags($req['pt']) =="" ) {  $errors.=$glyphicon."Project Name Could Not Be BLank";  }



		if (strip_tags($req['eg1'])!="") 
		{
			    
			    $user = App\User::orWhere('email','=',strip_tags($req['eg1']))->orWhere('email_gm1','=',strip_tags($req['eg1']))->orWhere('email_gm2','=',strip_tags($req['eg1']))->orWhere('email_gm3','=',strip_tags($req['eg1']))->orWhere('email_gm4','=',strip_tags($req['eg1']))->get();

			    if ($user->count()>0) 
				{  
					$errors.=$glyphicon."Email Id of Group Member 1 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);    
				}
		}

		
		if (strip_tags($req['eg2'])!="") 
		{

				$user = App\User::orWhere('email','=',strip_tags($req['eg2']))->orWhere('email_gm1','=',strip_tags($req['eg2']))->orWhere('email_gm2','=',strip_tags($req['eg2']))->orWhere('email_gm3','=',strip_tags($req['eg2']))->orWhere('email_gm4','=',strip_tags($req['eg2']))->get();

				if ($user->count()>0) 
				{
					$errors.=$glyphicon."Email Id of Group Member 2 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
				}
		}

		if (strip_tags($req['eg3'])!="") 
		{
				$user = App\User::orWhere('email','=',strip_tags($req['eg3']))->orWhere('email_gm1','=',strip_tags($req['eg3']))->orWhere('email_gm2','=',strip_tags($req['eg3']))->orWhere('email_gm3','=',strip_tags($req['eg3']))->orWhere('email_gm4','=',strip_tags($req['eg3']))->get();

				if ($user->count()>0) 
				{
					$errors.=$glyphicon."Email Id of Group Member 3 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
				}
		}

		if (strip_tags($req['eg4'])!="") 
		{
				$user = App\User::orWhere('email','=',strip_tags($req['eg4']))->orWhere('email_gm1','=',strip_tags($req['eg4']))->orWhere('email_gm2','=',strip_tags($req['eg4']))->orWhere('email_gm3','=',strip_tags($req['eg4']))->orWhere('email_gm4','=',strip_tags($req['eg4']))->get();

				if ($user->count()>0) 
				{
					$errors.=$glyphicon."Email Id of Group Member 4 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
				}
		}


		if (strip_tags($req['pass']) == strip_tags($req['rpass']) ) 
		{
			if($errors=="")
			{

				    if( strlen( strip_tags( $req['pass'] ) )  <  8 )
					{ $errors.=$glyphicon."Password Must Be Of At Least 8 Charaters"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  }
					


					$max = DB::table('users')->max('id');
					$max=$max+1;


					$user = new App\User;
					$user->id=$max;


					$user->project_title = strip_tags($req['pt']);
					$user->project_guide = strip_tags($req['pg']);
					$user->branch = strip_tags($req['b']);

					$user->nog = strip_tags($req['ngm']);

					$user->name_gm1 = strip_tags($req['ng1']);
					$user->name_gm2 = strip_tags($req['ng2']);
					$user->name_gm3 = strip_tags($req['ng3']);
					$user->name_gm4 = strip_tags($req['ng4']);
					$user->email_gm1 = strip_tags($req['eg1']);
					$user->email_gm2 = strip_tags($req['eg2']);
					$user->email_gm3 = strip_tags($req['eg3']);
					$user->email_gm4 = strip_tags($req['eg4']);
					$user->type = 1;
					$user->email = $max;
					$user->name = $max;


					
					 $user->password = bcrypt(strip_tags($req['pass']));


					$user->save();

					sendmail($user->email_gm1 , "Project Created Successfully " , "Project Group created With UID : ".$max." , Use This UID As Login ID" );
					sendmail($user->email_gm2 , "Project Created Successfully " , "Project Group created With UID : ".$max." , Use This UID As Login ID" );
					sendmail($user->email_gm3 , "Project Created Successfully " , "Project Group created With UID : ".$max." , Use This UID As Login ID" );
					sendmail($user->email_gm4 , "Project Created Successfully " , "Project Group created With UID : ".$max." , Use This UID As Login ID" );

							//$data = array('groupid' =>$max );          or         //Route::get('/gid/{id}',function($id){   --> this i have used via js url route using 
							//return view('gid',$data);								//	$data = array('groupid' =>$id );			//$max value
																					//	return view('gid',$data);
																					// });									



					//insert project id into rubrics table
					$rubrics = new App\Rubrics;
					$rubrics->project_id=$max;
					$rubrics->save();


					//dd($rubrics);

					return (array( 'status'=>'success' , 'groupid'=>  $max ));

			}

		}
		else
		{
			//return redirect('/createproject?err=Mismatch In Password And Confirm Password');
			$errors.=$glyphicon."Mismatch In Password And Confirm Password";
		}
		
		return Response::json(array('status'=>'error', 'errors'=> $errors ),422);

});


//student only uid display
Route::get('/gid/{id}',function($id){

	$data = array('groupid' => strip_tags( $id ) );
	return view('gid',$data);
});

//teacher
Route::post('/createtask', function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$date = new DateTime();
	$now = $date->format('Y-m-d');
	
	$task = new App\Task;
	$task->detail = strip_tags($req['detail']);
	$task->doc = strip_tags($req['doc']);
	$task->project = strip_tags($req['pid']);
	$task->doa  = $now;
	$task->status = 0;
	$task->rating = 0;
	$task->save();

	$user  = App\User::find( $task->project );
	if(!$user){ return redirect('/illegal'); }

	sendmail( $user->email_gm1 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendmail( $user->email_gm2 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendmail( $user->email_gm3 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendmail( $user->email_gm4 , "New Task Has Been Assigned" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	
	//sendnotfication("Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, strip_tags($req['pid']));
	
	return redirect('/task/'.strip_tags($req['pid']));

});



//student
Route::get('/verify/{tid}',function($tid)
{

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $tid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==0) {  return redirect('/illegal'); }

	$task = App\Task::find( strip_tags( $tid) );
	if(!$task){ return redirect('/illegal'); }

	$user  = App\User::find( $task->project );
	if(!$user){ return redirect('/illegal'); }


	   // this is to check if logged in project group is been rejected from project guide or not
		if(Auth::user()->type==1)
		{
			$guidex = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();
			$findguide = App\User::find($guidex->project_guide);
	        if( !$findguide ) {  return redirect('/editprofile'); }


		}
			
	//check if project guide is active or not
	$userx = DB::table('users')->select('act','project_guide')->where('id','=',Auth::user()->id)->first();
	$guidex = DB::table('users')->select('act')->where('id','=',$userx->project_guide)->first();
    if( $userx->act == 0 ) 
	{  
		return redirect('/verifyerror?error_val=Currently Your Project Guide Has Not Approved Your Request.<br>Contact Your Project Guide Or Change Your Project Guide.' );
	}
	else if( $guidex->act == 0 )
	{
		return redirect('/verifyerror?error_val=Currently Your Project Guide Is Deactive.<br>Contact Your Project Guide Or Change Your Project Guide.' );
	}
	else
	{
	sendmail( $user->email_gm1 , "Task Submitted Successfully" , "Task ID: ".$task->id." ,<br>Task Details - ".$task->detail." , Has Been Submitted For Verification.");
	sendmail( $user->email_gm2 , "Task Submitted Successfully" , "Task ID: ".$task->id." ,<br>Task Details - ".$task->detail." , Has Been Submitted For Verification.");
	sendmail( $user->email_gm3 , "Task Submitted Successfully" , "Task ID: ".$task->id." ,<br>Task Details - ".$task->detail." , Has Been Submitted For Verification.");
	sendmail( $user->email_gm4 , "Task Submitted Successfully" , "Task ID: ".$task->id." ,<br>Task Details - ".$task->detail." , Has Been Submitted For Verification.");
	}	

	
	$task->status=1;
	$task->save();
	return redirect('/home');

});



//student - to show verify error only 
Route::get('/verifyerror',function()
{
	return view('/verifyerror');
});


//teacher
Route::get('/taskremove/{tid}',function($tid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $tid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$task = App\Task::find( strip_tags( $tid )  );
	if(!$task){ return redirect('/illegal'); }

	$proj = $task->project;

	$user  = App\User::find( $proj );
	if(!$user){ return redirect('/illegal'); }

	sendmail( $user->email_gm1 , "Assigned Task Has Been Deleted " , "Task ID: ".$task->id." , Task - ".$task->detail." , Is Deleted.");
	sendmail( $user->email_gm2 , "Assigned Task Has Been Deleted " , "Task ID: ".$task->id." , Task - ".$task->detail." , Is Deleted.");
	sendmail( $user->email_gm3 , "Assigned Task Has Been Deleted " , "Task ID: ".$task->id." , Task - ".$task->detail." , Is Deleted.");
	sendmail( $user->email_gm4 , "Assigned Task Has Been Deleted " , "Task ID: ".$task->id." , Task - ".$task->detail." , Is Deleted.");


	$task->delete();
	return redirect('/task/'.$proj);
});

//teacher
Route::get('/submitaccess',function(Request $req){


	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


		// $user = App\User::find( Auth::user()->id );
		// //$user->ackey = rand(1000,9000); //otp
		// //$user->ackey = 7935; //otp
		// $result = DB::table('access')->select('passkey')->first();
		// $user->ackey = $result->passkey ;  // store encrypted ackey rom accesss table directly , decrypt when user enters OTO.
		// $user->save();
		// //sendmail($user->email,"Your Access Key For Activation Is ". $user->ackey);


	    $user = App\User::find( Auth::user()->id );
	    if(!$user){ return redirect('/illegal'); }

	    if( $user->act != 0 ){ return redirect('/home'); } //if user tries to open this link manually

		$result = DB::table('access')->select('passkey')->first();
		if(!$result){ dd("Key Not Found , Contact Your Admin"); }

		$user->ackey = $result->passkey ;  // store encrypted ackey rom accesss table directly , decrypt when user enters OTO.
		$user->save();

       return view('submitaccess');


});

//teacher
Route::post('/submitaccess',function(Request $req){


	if( ! Auth::check() )  {   return redirect('/login');  }
	
	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	$user = App\User::find( Auth::user()->id );
	if(!$user){ return redirect('/illegal'); }

	
	if(   X_DECRYPT( $user->ackey ) == strip_tags($req['ack']) )
	{

		$email_setfrom_name = DB::table('emailconfig')->select('SetFrom')->where('in_use','=',1)->first();
		$project_name = $email_setfrom_name->SetFrom;

	    sendmail( $user->email , " Welcome To ".$project_name , "Hello ".$user->name." ,<br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Thankyou For Using Our Product , Hope You Find It Usefull.");

		$user->act = 1;
		$user->save();
		return redirect('/home');

	}
	else
	{
		return redirect('/submitaccess?err=You Have Entered Wrong Key');
	}

});

//teacher
Route::get('/taskedit/{tid}',function($tid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $tid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$task = App\Task::find( strip_tags( $tid )  );
	if(!$task){ return redirect('/illegal'); }

	$data = array('task' => $task );
	return view('/edittask',$data);
});

//teacher
Route::post('/edittask', function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }



	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }




	$task = App\Task::find( strip_tags($req['tid']));
	if(!$task){ return redirect('/illegal'); }

	$task->detail = strip_tags($req['detail']);
	$task->doc = strip_tags($req['doc']);
	$task->project = strip_tags($req['pid']);
	$task->status = 0;
	$task->marks = 0;
	$task->remark = "Not Reviewed";

	$task->save();

	$u = App\User::find( strip_tags($req['pid']));
	if(!$u){ return redirect('/illegal'); }

		sendmail($u->email_gm1 , "Task Edited" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3 , "Task Edited" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3 , "Task Edited" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm4 , "Task Edited" , "Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		//sendnotfication("Task Edited <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, $u->id);

	return redirect('/task/'.strip_tags($req['pid']));

});

//teacher
Route::post('/taskremark/{tid}' ,function($tid,Request $req){


	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $tid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	//dd($tid,strip_tags($req['pId']));	
	//here tid is project id and strip_tags($req['pId']) is task id because find() only works with primary key id so pid is task id
	$task = App\Task::find( strip_tags($req['pId']));
    if(!$task){ return redirect('/illegal'); }


	/*$date1=date_create($task->doc);
	$date2=date_create(date("Y/m/d"));
	$diff=date_diff($date1,$date2);
	if($diff->days>0){
		$task->status = 4;  // late completed
	}else{
		$task->status = 2; //completed on time
	}*/

	$task->marks = strip_tags($req['mk']);
	$task->remark = strip_tags($req['rev']);
	$task->status = 2;


	$proj = $task->project;

	
	$user  = App\User::find( $task->project );
	if(!$user){ return redirect('/illegal'); }


	sendmail( $user->email_gm1 , "Your Task Is Completed" , "Task ID: ".$task->id." , Task - ".$task->detail." , Has Been Reviewded And Marked As Completed. <br>Total Marks : ".$task->marks."<br>Remark : ".$task->remark);
	sendmail( $user->email_gm2 , "Your Task Is Completed" , "Task ID: ".$task->id." , Task - ".$task->detail." , Has Been Reviewded And Marked As Completed. <br>Total Marks : ".$task->marks."<br>Remark : ".$task->remark);
	sendmail( $user->email_gm3 , "Your Task Is Completed" , "Task ID: ".$task->id." , Task - ".$task->detail." , Has Been Reviewded And Marked As Completed. <br>Total Marks : ".$task->marks."<br>Remark : ".$task->remark);
	sendmail( $user->email_gm4 , "Your Task Is Completed" , "Task ID: ".$task->id." , Task - ".$task->detail." , Has Been Reviewded And Marked As Completed. <br>Total Marks : ".$task->marks."<br>Remark : ".$task->remark);


	$task->save();
	return redirect('/task/'.$proj);

});

//done
Auth::routes();

//teacher
Route::get('/uid', function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	elseif (Auth::user()->type==0 && Auth::user()->act==0) 
	{
		$user = App\User::find( Auth::user()->id );
		if(!$user){ return redirect('/illegal'); }

		$result = DB::table('access')->select('passkey')->first();
		$user->ackey = $result->passkey ;  // store encrypted ackey rom accesss table directly , decrypt when user enters OTO.
		$user->save();


		//checcking if guide is activated or not
		$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
		if( $userx->act == 0 ) {  return redirect('/submitaccess'); }

	}


	    $user = App\User::where('type','=',1)->where('project_guide','=',Auth::user()->id)->get();
	    if(!$user){ return redirect('/illegal'); }

		$data = array('project' => $user);
		return view('teacheruid',$data);

});


//teacher and student and admin dashboard
Route::get('/home', function(Request $req){


	if( ! Auth::check() )  {   return redirect('/login');   }

		if( $req['uid'] != "" ) { $req['uid'] = strip_tags( $req['uid'] ); }
		if( $req['name'] != "" ) { $req['name'] = strip_tags( $req['name'] ); }
		if( $req['branch'] != "" ) { $req['branch'] = strip_tags( $req['branch'] );  }
		if( $req['type'] != "" ) { $req['type'] = strip_tags( $req['type'] );     }
		if( $req['filter'] != "" ) { $req['filter'] = strip_tags( $req['filter'] );  }

	if( Auth::User()->type == 10 )
	{

		
		if(  $req['name'] !="" ||  $req['branch']!=""  ||   $req['type']!="" ||  $req['uid']!="" )
		{

					if( $req['type']== 1  )
					{
						$user = DB::table('users')
						->where( 'id','like' , '%'.$req['uid'].'%' )
						->where( 'type','=',  $req['type'] )
						->where( 'branch','like' , '%'.$req['branch'].'%' )
						->where( 'name_gm1', 'like' , '%'.$req['name'].'%' )
						->where( 'name_gm2', 'like' , '%'.$req['name'].'%' )
						->where( 'name_gm3', 'like' , '%'.$req['name'].'%' )
						->where( 'name_gm4', 'like' , '%'.$req['name'].'%' )
						->orderBy('id', 'DESC')
						->get();
					}
					else
					{
						$user = DB::table('users')
						->where( 'id','like' , '%'.$req['uid'].'%' )
						->where( 'type','=', $req['type'] )
						->where( 'branch','like' , '%'.$req['branch'].'%' )
						->where( 'name', 'like' , '%'.$req['name'].'%' )
						->orderBy('id', 'DESC')
						->get();
					}

					$data = array('project' => $user , 'search' => '1' , 'name' =>$req['name'] , 'branch'=> $req['branch'] , 'type'=> $req['type'] , 'uid' => $req['uid'] );
					return view('Admindash',$data);

		}

		else
		{
			$user = App\User::where('type','!=',10)->orderBy('id', 'DESC')->get();
			$data = array('project' => $user , 'search' => '' , 'name'=>''  , 'branch'=>'' , 'type'=>'' , 'uid' => '' );
			return view('Admindash',$data);

		}
		
	}
	
	else if (Auth::user()->type==0 && Auth::user()->act==1) 
	{
		$user = App\User::where('type','=',1)->where('project_guide','=',Auth::user()->id)->get();
		$data = array('project' => $user);
		return view('teacherdash',$data);
	}

	else if (Auth::user()->type==0 && Auth::user()->act==0) 
	{
		 return redirect('/submitaccess');
	}

	//for student Auth::user()->type = 1 // student
	else
	{


		// this is to check if logged in project group is been rejected from project guide or not
		if(Auth::user()->type==1)
		{
			$userx = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();
			$findguide = App\User::find($userx->project_guide);
			if( !$findguide ) {  return redirect('/editprofile'); }



		}

		if (  isset( $req['filter'] )  ) 
		{
			$task = App\Task::where('project','=',Auth::user()->id)->where('status','=',strip_tags($req['filter']))->orderBy('id','DESC')->get();
			if(!$task){ return redirect('/illegal'); }
		}
		else
		{
			//$task = App\Task::where('project','=',Auth::user()->id)->orderBy('id','DESC')->get();
			$task = App\Task::where('project','=',Auth::user()->id)->get();
			if(!$task){ return redirect('/illegal'); }
		}




		    $project = App\User::where('id','=',Auth::user()->id)->first();
			if(!$project){ return redirect('/illegal'); }


			$data = array( 'task' => $task , 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );
	    	return view('studentdash',$data);
	}



});

//for both student and teacher
Route::get('/editprofile', function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }


	//Admin
	if(Auth::user()->type==10)
	{
		$user = App\User::where('id','=',Auth::user()->id)->first();
		if(!$user){ return redirect('/illegal'); }

		$user->password = null;
		$user->remember_token = null;
		$user->ackey = null;
		$user->nog = null;
		$user->name_gm1 = null;
		$user->name_gm2 = null;
		$user->name_gm3 = null;
		$user->name_gm4 = null;
		$user->email_gm1 = null;
		$user->email_gm2 = null;
		$user->email_gm3 = null;
		$user->email_gm4 = null;


		$data = array('user' => $user);
		return view('Adminprofile',$data);
	}


	//teacher
	if (Auth::user()->type==0) 
	{
		if(Auth::user()->act==0) 
		{
			$user = App\User::find( Auth::user()->id );
			if(!$user){ return redirect('/illegal'); }

			$result = DB::table('access')->select('passkey')->first();
			$user->ackey = $result->passkey ;  // store encrypted ackey rom accesss table directly , decrypt when user enters OTO.
			$user->save();

			return redirect('/submitaccess');

			/*if(Auth::user()->type==0)
			{
				$usex = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
				if( $userx->act == 0 ) {  return redirect('/submitaccess'); }
			}*/


		}

		$user = App\User::where('id','=',Auth::user()->id)->first();
		if(!$user){ return redirect('/illegal'); }

		$user->password = null;
		$user->remember_token = null;
		$user->ackey = null;
		$user->nog = null;
		$user->name_gm1 = null;
		$user->name_gm2 = null;
		$user->name_gm3 = null;
		$user->name_gm4 = null;
		$user->email_gm1 = null;
		$user->email_gm2 = null;
		$user->email_gm3 = null;
		$user->email_gm4 = null;

		$data = array('user' => $user);
		return view('teacherprofile',$data);

	}

	//student
	if (Auth::user()->type==1) 
	{
		return project_status_check();
	}


});

//for both student and teacher
Route::post('/editprofile', function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }




	//teacher
	if (Auth::user()->type==10) 
	{
		if(strip_tags($req['password'])==strip_tags($req['password_confirmation']))
		{


			$user  = App\User::find( Auth::user()->id);   // this find  only works for primary keys only so $id is found first
			if(!$user){ return redirect('/illegal'); }


			if( strip_tags( $req['name'] )=="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Please Enter Name') ,422);     }

			if( strip_tags( $req['email'] )=="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Please Enter Email Id') ,422);     }

			$user->name = strip_tags($req['name']);


			if( !isValidEmail( strip_tags($req['email']) )  && strip_tags( $req['email'] )!="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Entered Email ID is Not Valid') ,422);     }


			if( $user->email != strip_tags($req['email']) )  
			{
			    //checking if entered email id is unique or not.
				
				$email = DB::table('users')->select('project_title','id')->orwhere('email','=',strip_tags($req['email']))->orwhere('email_gm1','=',strip_tags($req['email']))->orwhere('email_gm2','=',strip_tags($req['email']))->orwhere('email_gm3','=',strip_tags($req['email']))->orwhere('email_gm4','=',strip_tags($req['email']))->get();


				if($email->count()>0)
				{
				  
						for($i=0;$i<count($email);$i++)
						{
							$matched_project_title = $email[$i]->project_title; 
							$matched_id = $email[$i]->id; 
						}

						if( $matched_project_title == "" )
						{
							return Response::json(array('status'=>'error', 'errors'=> 'Your Entered Email ID is Matching With Other Project Guide<br> Try Different Email ID') ,422);	
						}
						else
						{
							return Response::json(array('status'=>'error', 'errors'=> 'Your Entered Email ID is Matching With<br> Project Group Member [ UID - '.$matched_id.' | '.$matched_project_title.' ]<br>Try Different Email ID') ,422);			
						}

				}

			}



		    if(strip_tags($req['password'])!="")
			{ 
				if( strlen( strip_tags( $req['password'] ) )  <  8 )
				{
					return Response::json(array('status'=>'error', 'errors'=> 'Password Must Be Of At Least 8 Charaters') ,422);	
				}
				else
				{
					$user->password = bcrypt(strip_tags($req['password']));  
				}

			}


			sendmail($req['email'] , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");			
			
			
			$user->save();
			return (array( 'status'=>'success' , 'url'=> 'home'));


		}  
		else
		{
			return Response::json(array('status'=>'error', 'errors'=> 'Mismatch In Password And Confirm Password') ,422);	
		} 

	}






	//teacher
	if (Auth::user()->type==0) 
	{
		if(strip_tags($req['password'])==strip_tags($req['password_confirmation']))
		{


			$user  = App\User::find( Auth::user()->id);   // this find  only works for primary keys only so $id is found first
			if(!$user){ return redirect('/illegal'); }


			if( strip_tags( $req['name'] )=="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Please Enter Name') ,422);     }

			if( strip_tags( $req['email'] )=="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Please Enter Email Id') ,422);     }
			
			if( strip_tags( $req['branch'] )=="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Please Enter Email Id') ,422);     }


			$user->name = strip_tags($req['name']);
			$user->branch = strip_tags($req['branch']);

			if( !isValidEmail( strip_tags($req['email']) )  && strip_tags( $req['email'] )!="" ) {  return Response::json(array('status'=>'error', 'errors'=> 'Entered Email ID is Not Valid') ,422);     }


			if( $user->email != strip_tags($req['email']) )  
			{
			    //checking if entered email id is unique or not.
				
				$email = DB::table('users')->select('project_title','id')->orwhere('email','=',strip_tags($req['email']))->orwhere('email_gm1','=',strip_tags($req['email']))->orwhere('email_gm2','=',strip_tags($req['email']))->orwhere('email_gm3','=',strip_tags($req['email']))->orwhere('email_gm4','=',strip_tags($req['email']))->get();

				$matched_project_title;
				$matched_id;

				if($email->count()>0)
				{
				  
						for($i=0;$i<count($email);$i++)
						{
							$matched_project_title = $email[$i]->project_title; 
							$matched_id = $email[$i]->id; 
						}

						if( $matched_project_title == "" )
						{
							return Response::json(array('status'=>'error', 'errors'=> 'Your Entered Email ID is Matching With Other Project Guide<br> Try Different Email ID') ,422);	
						}
						else
						{

							return Response::json(array('status'=>'error', 'errors'=> 'Your Entered Email ID is Matching With<br> Project Group Member [ UID - '.$matched_id.' | '.$matched_project_title.' ]<br>Try Different Email ID') ,422);			
						}

				}

			}



		    if(strip_tags($req['password'])!="")
			{ 
				if( strlen( strip_tags( $req['password'] ) )  <  8 )
				{
					return Response::json(array('status'=>'error', 'errors'=> 'Password Must Be Of At Least 8 Charaters') ,422);	
				}
				else
				{
					$user->password = bcrypt(strip_tags($req['password']));  
				}

			}


			sendmail($req['email'] , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");			
			
			
			$user->save();
			return (array( 'status'=>'success' , 'url'=> 'home'));


		}  
		else
		{
			return Response::json(array('status'=>'error', 'errors'=> 'Mismatch In Password And Confirm Password') ,422);	
		} 

	}


	//student
	if (Auth::user()->type==1) 
	{

					//start validation and insertion same as create project
					$errors = "";
		
					$glyphicon = "<br><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;&nbsp;";

					
					if( (  strip_tags($req['real_pg']) =="x"  &&  strip_tags($req['pg']) =="" ) || strip_tags($req['pg']) =="x" ) { $errors.=$glyphicon."Please Select Your Project Guide";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);    }


					if( strip_tags($req['pt']) =="" ) {  $errors.=$glyphicon."Project Name Could Not Be BLank";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);    }


					$user = App\User::where('project_title','=',strip_tags($req['pt']))->get();


					if ($user->count()>1) 
					{
						$errors.=$glyphicon."Select Different Project Name";
					}


					if( !isValidEmail( strip_tags($req['eg1']) )  && strip_tags( $req['eg1'] ) !="" ) 
						{  $errors.=$glyphicon."Email Id of Group Member 1 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);   }
					if( !isValidEmail( strip_tags($req['eg2']) )  && strip_tags( $req['eg2'] ) !="" ) 
						{  $errors.=$glyphicon."Email Id of Group Member 2 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);   }
					if( !isValidEmail( strip_tags($req['eg3']) )  && strip_tags( $req['eg3'] ) !="" ) 
						{  $errors.=$glyphicon."Email Id of Group Member 3 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);   }
					if( !isValidEmail( strip_tags($req['eg4']) )  && strip_tags( $req['eg4'] ) !="" ) 
						{  $errors.=$glyphicon."Email Id of Group Member 4 Is Not Valid";  return Response::json(array('status'=>'error', 'errors'=> $errors ),422);   }


					if (strip_tags($req['eg1'])!="") 
					{
						    
						    $user = App\User::orWhere('email','=',strip_tags($req['eg1']))->orwhere('email','=',strip_tags($req['email']))->orWhere('email_gm1','=',strip_tags($req['eg1']))->orWhere('email_gm2','=',strip_tags($req['eg1']))->orWhere('email_gm3','=',strip_tags($req['eg1']))->orWhere('email_gm4','=',strip_tags($req['eg1']))->get();

						    if ($user->count()>1) 
							{  
								$errors.=$glyphicon."Email Id of Group Member 1 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);    
							}
					}

					
					if (strip_tags($req['eg2'])!="") 
					{

							$user = App\User::orWhere('email','=',strip_tags($req['eg2']))->orwhere('email','=',strip_tags($req['email']))->orWhere('email_gm1','=',strip_tags($req['eg2']))->orWhere('email_gm2','=',strip_tags($req['eg2']))->orWhere('email_gm3','=',strip_tags($req['eg2']))->orWhere('email_gm4','=',strip_tags($req['eg2']))->get();

							if ($user->count()>1) 
							{
								$errors.=$glyphicon."Email Id of Group Member 2 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
							}
					}

					if (strip_tags($req['eg3'])!="") 
					{
							$user = App\User::orWhere('email','=',strip_tags($req['eg3']))->orwhere('email','=',strip_tags($req['email']))->orWhere('email_gm1','=',strip_tags($req['eg3']))->orWhere('email_gm2','=',strip_tags($req['eg3']))->orWhere('email_gm3','=',strip_tags($req['eg3']))->orWhere('email_gm4','=',strip_tags($req['eg3']))->get();

							if ($user->count()>1) 
							{
								$errors.=$glyphicon."Email Id of Group Member 3 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
							}
					}

					if (strip_tags($req['eg4'])!="") 
					{
							$user = App\User::orWhere('email','=',strip_tags($req['eg4']))->orwhere('email','=',strip_tags($req['email']))->orWhere('email_gm1','=',strip_tags($req['eg4']))->orWhere('email_gm2','=',strip_tags($req['eg4']))->orWhere('email_gm3','=',strip_tags($req['eg4']))->orWhere('email_gm4','=',strip_tags($req['eg4']))->get();

							if ($user->count()>1) 
							{
								$errors.=$glyphicon."Email Id of Group Member 4 Is Matching With Other Registered User"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
							}
					}


					if (strip_tags($req['pass']) == strip_tags($req['rpass']) ) 
					{
						if($errors=="")
						{


								$user = App\User::find( Auth::user()->id);   // this find  only works for primary keys only so $id is found first;
								if(!$user){ return redirect('/illegal'); }

								$user->project_title = strip_tags($req['pt']);
								
								if(strip_tags($req['pg'])!="")  //if project details are not changed and directly saved changes than pg is not sent , so we can leave it as previous
								{
									$user->project_guide = strip_tags($req['pg']);
								    $user->branch = strip_tags($req['b']);
								}

								if(strip_tags($req['ngm'])!="") // this strip_tags($req['ngm']) will have value when we change no.of group member and member details , else it wll be blank
								{ $user->nog = strip_tags($req['ngm']); }
								else{} // else no.of group members value is not changed and if member details are changed then directly update te details
								
								$user->name_gm1 = strip_tags($req['ng1']);
								$user->name_gm2 = strip_tags($req['ng2']);
								$user->name_gm3 = strip_tags($req['ng3']);
								$user->name_gm4 = strip_tags($req['ng4']);

								//email validation is done on the top 
								$user->email_gm1 = strip_tags($req['eg1']);
								$user->email_gm2 = strip_tags($req['eg2']);
								$user->email_gm3 = strip_tags($req['eg3']);
								$user->email_gm4 = strip_tags($req['eg4']);

								
								if( strip_tags($req['pass'])!="" && strip_tags($req['rpass'])!="" ) 
								{  

									if( strlen( strip_tags( $req['pass'] ) )  <  8 )
									{ 
										$errors.=$glyphicon."Password Must Be Of At Least 8 Charaters"; return Response::json(array('status'=>'error', 'errors'=> $errors ),422);  
									}
									else {  $user->password = bcrypt(strip_tags($req['pass']));  }

								}

								$user->act = 0;

								$user->save();

								sendmail($user->email_gm1 , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");
								sendmail($user->email_gm2 , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");
								sendmail($user->email_gm3 , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");
								sendmail($user->email_gm4 , "Profile Updated Successfully" , "Your Profile Details Has Been Updated Successfully.");

								return (array( 'status'=>'success' , 'url'=> '/editprofile'));

						}
					}
					else
					{
						$errors.=$glyphicon."Mismatch In Password And Confirm Password";
					}
					
					return Response::json(array('status'=>'error', 'errors'=> $errors ) ,422);


	}//end of second if

});

//student chart
Route::get('/chart',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==0) {  return redirect('/illegal'); }


			// this is to check if logged in project group is been rejected from project guide or not
			if(Auth::user()->type==1)
			{
				$userx = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();
				$findguide = App\User::find($userx->project_guide);
				if( !$findguide ) {  return redirect('/editprofile'); }
			}


	$task = App\Task::where('project','=',Auth::user()->id)->get();
	if(!$task){ return redirect('/illegal'); }

		$data = array('task' => $task);
		return view('studentchart',$data);
});

//teacher
Route::get('/approveproject/{pid}',function($pid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $pid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }


	$user  = App\User::find( strip_tags( $pid ) ) ;   // this find  only works for primary keys only so $id is found first
	if(!$user){ return redirect('/illegal'); }

	$user->act = 1 ;

	sendmail( $user->email_gm1 , "Project Guide Allocation Approved" , "Your Project Guide Has Appected Project Guide Allocation Request.");
	sendmail( $user->email_gm2 , "Project Guide Allocation Approved" , "Your Project Guide Has Appected Project Guide Allocation Request.");
	sendmail( $user->email_gm3 , "Project Guide Allocation Approved" , "Your Project Guide Has Appected Project Guide Allocation Request.");
	sendmail( $user->email_gm4 , "Project Guide Allocation Approved" , "Your Project Guide Has Appected Project Guide Allocation Request.");


	$user->save();
	return redirect('/home');
});

//teacher
Route::get('/rejectproject/{pid}',function($pid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $pid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }


	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }



	$user  = App\User::find( strip_tags( $pid ) ) ;   // this find  only works for primary keys only so $id is found first
	if(!$user){ return redirect('/illegal'); }
	
	//for re-approval
	$user->act = 0 ;
	
	$user->project_guide = null ; //removing project guide to not show again under this project guide , so we will ahow them edit profile directly

	sendmail( $user->email_gm1 , "Project Guide Allocation Rejected" , "Your Project Guide Has Rejected Your Project Guide Allocation Request , You Can Change Your Project Guide Details From [ Profile ] Section.");
	sendmail( $user->email_gm2 , "Project Guide Allocation Rejected" , "Your Project Guide Has Rejected Your Project Guide Allocation Request , You Can Change Your Project Guide Details From [ Profile ] Section.");
	sendmail( $user->email_gm3 , "Project Guide Allocation Rejected" , "Your Project Guide Has Rejected Your Project Guide Allocation Request , You Can Change Your Project Guide Details From [ Profile ] Section.");
	sendmail( $user->email_gm4 , "Project Guide Allocation Rejected" , "Your Project Guide Has Rejected Your Project Guide Allocation Request , You Can Change Your Project Guide Details From [ Profile ] Section.");


	
	$user->save();
	return redirect('/home');
});



//Admin
Route::get('/deletemember/{pid}',function($pid){


	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $pid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	$user=App\User::find( strip_tags( $pid ) );	
	if(!$user) { return redirect('/illegal'); }

	if( $user->type == 1 )
	{

		$user->delete();

		$x = DB::table('task')->where('project', strip_tags( $pid ) )->delete();
		$x = DB::table('rubrics')->where('project_id', strip_tags( $pid ) )->delete();
		$x = DB::table('notification')->where('rec', strip_tags( $pid ) )->delete();

	}

	if( $user->type == 0 )
	{

		//before this update all group members with project guide = ""
		$user->delete();
	}
	
	

	return redirect('/home');

});


//Admin
Route::get('/guidetoggle/{pid}',function($pid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $pid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	$user=App\User::find( strip_tags( $pid ) );
	if(!$user) { return redirect('/illegal'); }

	if( $user->act == '1' ) { $user->act = 0;  }
	else { $user->act = 1;  }

	$user->save();

	return redirect('/home');

});



//Admin
Route::get('/activateall',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }


	$all_guides = App\User::select('id')->where('type','=',0)->where('act','=',0)->get()->toArray();
	if(!$all_guides){  return redirect('/nodatafound');	}


	$x = DB::table('users')->whereIn('id', $all_guides)->update(['act' => 1]);

	return redirect('/home');

});



//Admin
Route::get('/deactivateall',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }


	$all_guides = App\User::select('id')->where('type','=',0)->where('act','=',1)->get()->toArray();
	if(!$all_guides){  return redirect('/nodatafound');	}


	$x =DB::table('users')->whereIn('id', $all_guides)->update(['act' => 0]);

	return redirect('/home');

});


//Admin
Route::get('/adminkey',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	$key = DB::table('access')->select('passkey')->first();
	if(!$key) { return redirect('/nodatafound'); }

	$data = array('key' => X_DECRYPT($key->passkey) );
	return view('Adminkey',$data);
});


//Admin
Route::post('/adminkey',function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }
	if( ! is_numeric( strip_tags( $req['new_key'] )  )  ) {  return redirect('/illegal'); }

	  $x = DB::table('access')->where('id', 1 )->update( ['passkey' => X_ENCRYPT ( $req['new_key'] ) ] ); //$x receives 1 as update succesful

	  return redirect('/adminkey');
});


//Admin
Route::get('/adminemail',function(){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	$email_config = DB::table('emailconfig')->orderBy('id','DESC')->get();
	if(!$email_config) { return redirect('/nodatafound'); }

	$data = array('email' => $email_config , 'active' => $email_config[0]->active , 'errors' => '' );  //active is by default 1 , when email service is de activated then all values of email configuration are changed , so used first one[0] 
	

	for($i=0 ; $i< count( $data['email'] ); $i++)
	{
		$data['email'][$i]->Password = X_DECRYPT ( $data['email'][$i]->Password ) ;
	}

	return view('AdminEmailConfig',$data);
});



//Admin
Route::post('/adminemail',function(Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }


	$SetFrom = strip_tags($req['SetFrom']);
	$Username = strip_tags($req['Username']);
	$Password = strip_tags($req['Password']);
	$Host  = strip_tags($req['Host']); //v20
	$Port = strip_tags($req['Port']);  //number 11
	$SMTPSecure = strip_tags($req['SMTPSecure']); //var 10


	$errors = "";	
	$glyphicon = "<span class='glyphicon glyphicon-remove'></span><br>";

	if( !isValidEmail($Username) )
	{
		$errors.="Invalid User Name , ";
	}
	if( !is_numeric($Port) || (int)($Port) >1000 )
	{		
		$errors.="Invalid Port Number , "; 
	}
	if( strlen($Host) > 20 )
	{
		$errors.="Invalid Host [Max 20], ";
	}
	if( strlen($SMTPSecure) > 8 )
	{
		$errors.="Invalid Security [Max 8] , ";
	}

	if(!$errors)
	{

		$task = new App\EmailConfig;
		$task->SetFrom = $SetFrom;
		$task->Username = $Username;
		$task->Password = X_ENCRYPT($Password);
		$task->Host  = $Host; //v20
		$task->Port = $Port;  //number 11
		$task->SMTPSecure = $SMTPSecure; //var 10
		$task->save();
		return redirect('/adminemail');
	}

	$email_config = DB::table('emailconfig')->orderBy('id','DESC')->get();
	if(!$email_config) { return redirect('/nodatafound'); }


	$data = array('email' => $email_config , 'active' => $email_config[0]->active , 'errors' => $errors );
    for($i=0 ; $i< count( $data['email'] ); $i++) {  $data['email'][$i]->Password = X_DECRYPT ( $data['email'][$i]->Password ) ;  }
	return view('AdminEmailConfig',$data);

});


//Admin
Route::get('/EmailToggle',function(){


	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }


	$email_config = DB::table('emailconfig')->orderBy('id','DESC')->get();
	if(!$email_config) { return redirect('/nodatafound'); }

	if( $email_config[0]->active == 1 )
	{
		$x = DB::table('emailconfig')->update(['active' => 0 ]);
	}
	else
	{
		$x = DB::table('emailconfig')->update(['active' => 1 ]);
	}
	
	return redirect('/adminemail');

});


//Admin
Route::get('/deletemail/{id}',function($id){


	if( ! Auth::check() )  {   return redirect('/login');  }

	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }


	$config = App\EmailConfig::find( $id );
	if(!$config) { return redirect('/nodatafound'); }

	//deleted config is active then update all active = 0
	
	//if( $config->active == 1 ){ $x = DB::table('emailconfig')->update(['active' => 0 ]); } 

	//making every congid deactivate , to show that email service is deactive
	// beacause status of email config active / deactive is found by first element only not by checking all 


    $config->delete();

	return redirect('/adminemail');

});

//Admin
Route::get('/singlemailtoggle/{id}',function($id){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }
	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }

	$id = strip_tags( $id );

	$email_config = DB::table('emailconfig')->where('id','=',$id)->orderBy('id','DESC')->get();
	if(!$email_config) { return redirect('/nodatafound'); }


	if( $email_config[0]->in_use == 1 )
	{
		//if( $email_config[0]->active == 1 ){ $x = DB::table('emailconfig')->update(['active' => 0 ]); }

        $x = DB::table('emailconfig')->where('id','=',$id)->update(['in_use' => 0 ]);
	}
	else
	{
		$x = DB::table('emailconfig')->where('id','=',$id)->update(['in_use' => 1 ]);
	}

    $x = DB::table('emailconfig')->where('id','!=',$id)->update(['in_use' => 0 ]);

	
	return redirect('/adminemail');

});


//Admin
Route::get('/editemailconfig/{id}',function($id){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }
	$id = strip_tags( $id );

	$emailconfig = App\EmailConfig::find($id);
	$emailconfig->Password = X_DECRYPT( $emailconfig->Password );
	
    $data = array( 'emailconfig' =>  $emailconfig , 'errors' => '' );

	return view('Admineditemailconfig',$data);

});



Route::post('/editemailconfig/{id}',function($id,Request $req)
{
	
	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }
	
	$id = strip_tags( $id );  // or $req['edit_id'];

	$SetFrom = strip_tags($req['SetFrom']);
	$Username = strip_tags($req['Username']);
	$Password = strip_tags($req['Password']);
	$Host  = strip_tags($req['Host']); //v20
	$Port = strip_tags($req['Port']);  //number 11
	$SMTPSecure = strip_tags($req['SMTPSecure']); //var 10


	$errors = "";	
	if( !isValidEmail($Username) )
	{
		$errors.="Invalid User Name , ";
	}
	if( !is_numeric($Port) || (int)($Port) >1000 )
	{		
		$errors.="Invalid Port Number , "; 
	}
	if( strlen($Host) > 20 )
	{
		$errors.="Invalid Host [Max 20], ";
	}
	if( strlen($SMTPSecure) > 8 )
	{
		$errors.="Invalid Security [Max 8] , ";
	}

	if(!$errors)
	{

		$email_config = App\EmailConfig::find($id);
		$email_config->SetFrom = $SetFrom;
		$email_config->Username = $Username;
		$email_config->Password = X_ENCRYPT($Password);
		$email_config->Host  = $Host;
		$email_config->Port = $Port;
		$email_config->SMTPSecure = $SMTPSecure;
		$email_config->in_use = 0;

		$email_configx = DB::table('emailconfig')->orderBy('id','DESC')->get();
		if(!$email_configx) { $email_config->active = 0; }
		elseif( $email_configx[0]->active == 1 ){ $email_config->active = 1;}
		
		$email_config->save();
		return redirect('/adminemail');

	}

	$emailconfig = App\EmailConfig::find($id);
	$emailconfig->Password = X_DECRYPT( $emailconfig->Password );
    $data = array( 'emailconfig' =>  $emailconfig  , 'errors' => $errors );

	return view('Admineditemailconfig',$data);

});


//Admin
Route::get('/testemailconfig/{id}',function($id){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }
	$id = strip_tags( $id );

    $data = array( 'id' => $id , 'info' => 'Make Email Configuration Is Proper And Password Is Correct' );
	return view('Admintestemailconfig',$data);

});


//Admin
Route::post('/testemailconfig/{id}',function($id , Request $req){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if(Auth::user()->type==1 || Auth::user()->type==0 ) {  return redirect('/illegal'); }

	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }
	$id = strip_tags( $id );



	$ReceiverEmail = trim( strip_tags($req['ReceiverEmail']) ) ;
	$Subject = trim( strip_tags($req['Subject']) ) ;
	$Message = trim( strip_tags($req['Message']) ) ;


			$E = DB::table('emailconfig')->where('id','=',$id)->first();
			if(!$E)
			{ 
				return redirect("/nodatafound"); 
			}
			else
			{
				$SetFrom = $E->SetFrom;
				$Username =  $E->Username;
				$Password = $E->Password; 
				$Host  = $E->Host; 
				$Port = $E->Port;
				$SMTPSecure = $E->SMTPSecure;  
			}

    testmail($ReceiverEmail,$Subject,$Message,$SetFrom,$Username,$Password, $Host,$Port,$SMTPSecure);

    $data = array( 'id' => $id , 'info' => 'Email Sent' );
	return view('Admintestemailconfig',$data);

});








//student
Route::get('/rubrics',function(){


	if( ! Auth::check() )  {   return redirect('/login');  }

	//no teacher allowed
	if(Auth::user()->type==0) {  return redirect('/illegal'); }


	$userx = DB::table('users')->select('project_guide')->where('id','=',Auth::user()->id)->first();

	$findguide = App\User::find($userx->project_guide);
	if( !$findguide ) {  return redirect('/editprofile'); }


	$rubrics = DB::table('rubrics')->where('project_id','=',Auth::user()->id)->first();
	if(!$rubrics){ return redirect('/illegal'); }

	$task = App\Task::where('project','=',Auth::user()->id)->orderBy('id','DESC')->get();
	if(!$task){ return redirect('/illegal'); }

	$project = App\User::where('id','=',Auth::user()->id)->first();
	if(!$project){ return redirect('/illegal'); }

	$sem7 = ( $rubrics->sem7_P1 + $rubrics->sem7_P2 + $rubrics->sem7_P3 + $rubrics->sem7_P4 + $rubrics->sem7_P5 ) ;
	$sem8 = ( $rubrics->sem8_P1 + $rubrics->sem8_P2 + $rubrics->sem8_P3 + $rubrics->sem8_P4 + $rubrics->sem8_P5 ) ;

	 $data = array( 'rubrics' =>  $rubrics , 'sem7' => $sem7 , 'sem8' => $sem8 , 'task' => $task , 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );
	    	
	 return view('studentrubrics',$data);
	
});


//teacher
Route::get('/rubrics/{pid}',function($pid){

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $pid )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }

	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }


	$rubrics = DB::table('rubrics')->where('project_id','=', strip_tags( $pid ) )->first();
	if(!$rubrics){ return redirect('/illegal'); }

	$task = App\Task::where('project','=',$pid)->orderBy('id','DESC')->get();
	if(!$task){ return redirect('/illegal'); }

	$project = App\User::where('project_guide','=',Auth::user()->id)->where('act','=',1)->first();
	if(!$project){ return redirect('/illegal'); }

	$sem7 = ( $rubrics->sem7_P1 + $rubrics->sem7_P2 + $rubrics->sem7_P3 + $rubrics->sem7_P4 + $rubrics->sem7_P5 ) ;
	$sem8 = ( $rubrics->sem8_P1 + $rubrics->sem8_P2 + $rubrics->sem8_P3 + $rubrics->sem8_P4 + $rubrics->sem8_P5 ) ;

	 $data = array( 'rubrics' =>  $rubrics , 'sem7' => $sem7 , 'sem8' => $sem8 , 'task' => $task , 'project_name'=>$project->project_title , 'name_gm1'=>$project->name_gm1 , 'name_gm2'=>$project->name_gm2 , 'name_gm3'=>$project->name_gm3 , 'name_gm4'=>$project->name_gm4 , 'email_gm1'=>$project->email_gm1 , 'email_gm2'=>$project->email_gm2 , 'email_gm3'=>$project->email_gm3 , 'email_gm4'=>$project->email_gm4   );


	 //dd($data['rubrics']->sem7_P1);
	    	
	 return view('teacherrubrics',$data);
	
});


//teacher  rid is the primary key of Rubrics Table
Route::post('/rubrics/{rid}',function($rid,Request $req){


	$id = trim( strip_tags($rid) );

	if( ! Auth::check() )  {   return redirect('/login');  }
	if( ! is_numeric( strip_tags( $id )  )  ) {  return redirect('/illegal'); }

	if(Auth::user()->type==1) {  return redirect('/illegal'); }

	//checcking if guide is activated or not
	$userx = DB::table('users')->select('act')->where('id','=',Auth::user()->id)->first();
	if( $userx->act == 0 ) {  return redirect('/submitaccess'); }


	//start inserting
    $rubrics  = App\Rubrics::find($id) ;  
	if(!$rubrics){ return redirect('/illegal'); }


      if(  is_numeric( $req['sem7_P1'] )  ) {  $rubrics->sem7_P1 = $req['sem7_P1'];  }
      if(  is_numeric( $req['sem8_P1'] )  ) {  $rubrics->sem8_P1 = $req['sem8_P1'];  }
      if(  is_numeric( $req['sem7_P2'] )  ) {  $rubrics->sem7_P2 = $req['sem7_P2'];  }
      if(  is_numeric( $req['sem8_P2'] )  ) {  $rubrics->sem8_P2 = $req['sem8_P2'];  }
      if(  is_numeric( $req['sem7_P3'] )  ) {  $rubrics->sem7_P3 = $req['sem7_P3'];  }
      if(  is_numeric( $req['sem8_P3'] )  ) {  $rubrics->sem8_P3 = $req['sem8_P3'];  }
      if(  is_numeric( $req['sem7_P4'] )  ) {  $rubrics->sem7_P4 = $req['sem7_P4'];  }
      if(  is_numeric( $req['sem8_P4'] )  ) {  $rubrics->sem8_P4 = $req['sem8_P4'];  }
      if(  is_numeric( $req['sem7_P5'] )  ) {  $rubrics->sem7_P5 = $req['sem7_P5'];  }
      if(  is_numeric( $req['sem8_P5'] )  ) {  $rubrics->sem8_P5 = $req['sem8_P5'];  }

      $project_id = $rubrics->project_id;
	  
	  $rubrics->save();

	  return redirect('/rubrics/'.$project_id);
	
});


//for teacher and student
//rubrics format page view
Route::get('/SEM7',function()
{
	return view('/SEM7');
});


//for teacher and student
//rubrics format page view
Route::get('/SEM8',function()
{
	return view('/SEM8');
});



//error
Route::get('/accessdenied',function()
{
	return view('/errors/accessdenied');
});

//error
Route::get('/illegal',function()
{
	return view('/errors/illegal');
});

//error
Route::get('/nodatafound',function()
{
	return view('/errors/nodatafound');
});

//student , usefull for all places
function project_status_check (){
		//getting user details
		$user = App\User::where('id','=',Auth::user()->id)->first();

		$findguide = App\User::find($user->project_guide);

		if( $user->project_guide == "" ) // checking because , this project group must have been rejected by the self allocated project guide , so we have show user to update project guide details, we need to show message - as your project guide has rejected the group creation under him/her
		{
			$guide_name = "Select Different Project Guide.";
			$user->branch = "Your Project Guide Has Rejected Your Project Group";
			$user->project_guide = "x"; //for original_guide_id in frontend javascript and also for validation in post editprofile
		}
		elseif(!$findguide)
		{
			$guide_name = "Select Different Project Guide.";
			$user->branch = "Your Project Guide Is Deleted From The System";
			$user->project_guide = "x"; //for original_guide_id in frontend javascript and also for validation in post editprofile
		}
		else
		{
			//finding name of the project guide who has primary key - id as project guide to the student
			$result = DB::table('users')->select('name')->where('id','=',$user->project_guide)->first();
			if($result){  $guide_name = $result->name; }
			else {  $guide_name = "Your Guide Has Been Deleted";  } 
			 // taking this coz column - Project_Guide has id of project guide and not name , so we are using this above query
		}
		
		//getting all guides because user can opt to change there guide
		$all_guides = App\User::where('type','=',0)->where('act','=',1)->get();  // get(); left as it is , because js is already wriiten for json data (type)


		$data = array('user' => $user , 'guide'=>$guide_name , 'all_guides' => $all_guides );


																	//below data is made null coz JSOS.parse was causing problem becuase dataa format of encrypted values
																	//and also they have no use so made null
																	//we can modify select statement but it will take more time users table
																	$user->ackey = null;
																	$user->password = null;
																	$user->remember_token = null;

																	for($i=0 ; $i< count( $data['all_guides'] ); $i++)
																	{

																		$data['all_guides'][$i]['name'] = $data['all_guides'][$i]['name'].' - '.strtoupper($data['all_guides'][$i]['email']);

																		$data['all_guides'][$i]['ackey'] = null ;
																		$data['all_guides'][$i]['password'] = null ;
																		$data['all_guides'][$i]['remember_token'] = null ;


																		$data['all_guides'][$i]['nog'] = null ;
																		$data['all_guides'][$i]['name_gm1'] = null ;
																		$data['all_guides'][$i]['name_gm2'] = null ;
																		$data['all_guides'][$i]['name_gm3'] = null ;
																		$data['all_guides'][$i]['name_gm3'] = null ;
																		$data['all_guides'][$i]['email_gm1'] = null ;
																		$data['all_guides'][$i]['email_gm2'] = null ;
																		$data['all_guides'][$i]['email_gm3'] = null ;
																		$data['all_guides'][$i]['email_gm4'] = null ;

																	}

		/*dd($data);*/


		
		return view('studentprofile',$data);

};

            

function sendnotfication($message, $rec){

	$not  = new App\Notification;
	$not->message = $message;
	$not->rec = $rec;
	$not->save();

};

function sendnotficationall($message){

	$user = App\User::where('project_guide','=',Auth::user()->id )->where('act','=',1)->get();


	foreach ($user as $u) {
		
		$not  = new App\Notification;
		$not->message = $message;
		$not->rec = $u->id;
		$not->save();

		//newly added

		sendmail($u->email_gm1 , "New Notification Received" ,"Notification : ".$message);
		sendmail($u->email_gm2 , "New Notification Received" ,"Notification : ".$message);
		sendmail($u->email_gm3 , "New Notification Received" ,"Notification : ".$message);
		sendmail($u->email_gm4 , "New Notification Received" ,"Notification : ".$message);
	
	}

};

function sendmail($mailadd,$sub,$noty){


	if($mailadd!="")
	{

			$E = DB::table('emailconfig')->where('in_use','=',1)->where('active','=',1)->first();
			if(!$E)
			{ 
				//dd("No Active Email Found"); 
			}
			else
			{
				$mail = new PHPMailer\PHPMailer(); // create a new mail object
			    $mail->IsSMTP();
			    $mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
			    $mail->SMTPAuth   = true; // authentication enabled
			    $mail->SMTPSecure = $E->SMTPSecure ; // secure transfer enabled REQUIRED for Gmail
			    $mail->Host = $E->Host ;
			    $mail->Port = $E->Port ; // or 587
			    $mail->IsHTML(true);
			    $mail->Username = $E->Username ;


			    $mail->Password = X_DECRYPT( $E->Password ) ;
			    $mail->SetFrom( $E->Username , $E->SetFrom );
			    $mail->Subject = $sub ; //send form function
			    $mail->Body = $noty;
			    $mail->AddAddress($mailadd,"User");
			    if ($mail->Send()) {} // this returns boolean so used in if else condition

				
			}

	}


};


//Admin
function testmail($mailadd,$sub,$noty,$SetFrom,$Username,$Password, $Host,$Port,$SMTPSecure){

				$mail = new PHPMailer\PHPMailer(); // create a new mail object
			    $mail->IsSMTP();
			    $mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
			    $mail->SMTPAuth   = true; // authentication enabled
			    $mail->SMTPSecure = $SMTPSecure ; // secure transfer enabled REQUIRED for Gmail
			    $mail->Host = $Host ;
			    $mail->Port = $Port ; // or 587
			    $mail->IsHTML(true);
			    $mail->Username = $Username ;


			    $mail->Password = X_DECRYPT( $Password ) ;
			    $mail->SetFrom( $Username , $SetFrom );
			    $mail->Subject = $sub ; //send form function
			    $mail->Body = $noty;
			    $mail->AddAddress($mailadd,"User");
			    if ($mail->Send()) {} // this returns boolean so used in if else condition

};


function isValidEmail($email)
{ 
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
};

function X_ENCRYPT($text)
{ 
	$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	$encrypted = $encrypter->encrypt($text);
	return $encrypted;
};

function X_DECRYPT($text)
{ 
	$encrypter = app('Illuminate\Contracts\Encryption\Encrypter');
	$dencrypted = $encrypter->decrypt($text);
	return $dencrypted;
};

Route::get('/s',function()
{

});

