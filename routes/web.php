<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PHPMailer\PHPMailer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/mail', function () {
    sendmail("siddhesh.pangam007@gmail.com","Not");
    //return view('welcome');
});

Route::get('/project', function () {
	$max = DB::table('users')->max('id');
    echo $max;
});
Route::get('/task/{id}', function ($id,Request $req) {
	if (isset($req['filter'])) {
		$task = App\Task::where('project','=',$id)->where('status','=',$req['filter'])->orderBy('id','DESC')->get();
		$data = array('task' => $task,'pid'=>$id);
    	return view('teachertask',$data);
	}else{
		$task = App\Task::where('project','=',$id)->orderBy('id','DESC')->get();
		$data = array('task' => $task,'pid'=>$id);
	    return view('teachertask',$data);
    }
});

Route::get('/report/{id}', function ($id,Request $req) {
	if (isset($req['filter'])) {
		$task = App\Task::where('project','=',$id)->where('status','=',$req['filter'])->get();
		$data = array('task' => $task,'pid'=>$id);
    	return view('teacherremort',$data);
	}else{
		$task = App\Task::where('project','=',$id)->get();
		$data = array('task' => $task,'pid'=>$id);
	    return view('teacherremort',$data);
    }
});
Route::get('/createproject', function () {

	$user = App\User::where('type','=',0)->where('act','=',1)->get();
	$data = array('user' => $user );
	return view('createproject', $data);
});

Route::post('/createproject', function (Request $req) {

	$user = App\User::where('project_title','=',$req['pt'])->get();
	if ($user->count()>0) {
		return redirect('/createproject?err=Select Unique Name');
	}

	if ($req['eg1']!="") {
		$user = App\User::orWhere('email_gm1','=',$req['eg1'])->orWhere('email_gm2','=',$req['eg1'])->orWhere('email_gm3','=',$req['eg1'])->orWhere('email_gm4','=',$req['eg1'])->get();
		if ($user->count()>0) {
			return redirect('/createproject?err=Select Unique Email For Member 1');
		}
	}

	
	if ($req['eg2']!="") {

		$user = App\User::orWhere('email_gm1','=',$req['eg2'])->orWhere('email_gm2','=',$req['eg2'])->orWhere('email_gm3','=',$req['eg2'])->orWhere('email_gm4','=',$req['eg2'])->get();
		if ($user->count()>0) {
			return redirect('/createproject?err=Select Unique Email  For Member 2');
		}
	}

	if ($req['eg3']!="") {
		$user = App\User::orWhere('email_gm1','=',$req['eg3'])->orWhere('email_gm2','=',$req['eg3'])->orWhere('email_gm3','=',$req['eg3'])->orWhere('email_gm4','=',$req['eg3'])->get();
		if ($user->count()>0) {
			return redirect('/createproject?err=Select Unique Email  For Member 3');
		}
	}

	if ($req['eg4']!="") {
		$user = App\User::orWhere('email_gm1','=',$req['eg4'])->orWhere('email_gm2','=',$req['eg4'])->orWhere('email_gm3','=',$req['eg4'])->orWhere('email_gm4','=',$req['eg4'])->get();
		if ($user->count()>0) {
			return redirect('/createproject?err=Select Unique Email  For Member 4');
		}
	}

	if ($req['nog']==2) {
		if ($req['eg1']==$req['eg2']) {
			return redirect('/createproject?err=Select Unique Email');
		}
	}
	if ($req['nog']==3) {
		if ($req['eg1']==$req['eg2'] || $req['eg2']==$req['eg3'] || $req['eg1']==$req['eg1']) {
			return redirect('/createproject?err=Select Unique Email');
		}
	}

	if ($req['nog']==4) {
		if ($req['eg1']==$req['eg2'] || $req['eg1']==$req['eg3'] || $req['eg1']==$req['eg4'] || $req['eg2']==$req['eg3'] || $req['eg2']==$req['eg4'] || $req['eg3']==$req['eg4']) {
			return redirect('/createproject?err=Select Unique Email');
		}
	}

	
	



	if ($req['pass'] == $req['rpass']) {
	
	$max = DB::table('users')->max('id');
	$max=$max+1;	
	$user = new App\User;
	$user->id=$max;
	$user->project_title = $req['pt'];
	$user->project_guide = $req['pg'];
	$user->branch = $req['b'];
	$user->nog = $req['ngm'];
	$user->name_gm1 = $req['ng1'];
	$user->name_gm2 = $req['ng2'];
	$user->name_gm3 = $req['ng3'];
	$user->name_gm4 = $req['ng4'];
	$user->email_gm1 = $req['eg1'];
	$user->email_gm2 = $req['eg2'];
	$user->email_gm3 = $req['eg3'];
	$user->email_gm4 = $req['eg4'];
	$user->type = 1;
	$user->email = $max;
	$user->name = $max;
	$user->password = bcrypt($req['pass']);
	$user->save();
	$data = array('groupid' =>$max );

	sendmail($user->email_gm1,"Project Group created With UID :".$max);
	sendmail($user->email_gm2,"Project Group created With UID :".$max);
	sendmail($user->email_gm3,"Project Group created With UID :".$max);
	sendmail($user->email_gm4,"Project Group created With UID :".$max);

	return view('gid',$data);
	}else{
		return redirect('/createproject?err=Password Match Failed');
	}

	

});

Route::post('sendnotificationall',function(Request $req){
	sendnotficationall($req['message']);
	return redirect('/home');
});

Route::get('/notification',function(){

	$not  = App\Notification::where('rec','=',Auth::user()->id)->orderBy('id','DESC')->get();
	$data = array('not' => $not );
	return view('notification',$data);

});

Route::post('/createtask', function(Request $req){

	$date = new DateTime();
	$now = $date->format('Y-m-d');
	$task = new App\Task;
	$task->detail = $req['detail'];
	$task->doc = $req['doc'];
	$task->project = $req['pid'];
	$task->doa  = $now;
	$task->status = 0;
	$task->rating = 0;
	$task->save();

	$user  = App\User::find($task->project);

	sendmail($user->email_gm1,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendmail($user->email_gm3,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendmail($user->email_gm3,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
	sendnotfication("Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, $req['pid']);
	return redirect('/task/'.$req['pid']);

});


Route::post('/createtaskbulk', function(Request $req){

	$user = App\User::where('project_guide','=',Auth::user()->id)->get();

	foreach ($user as $u) {

		$date = new DateTime();
		$now = $date->format('Y-m-d');
		$task = new App\Task;
		$task->detail = $req['detail'];
		$task->doc = $req['doc'];
		$task->project = $u->id;
		$task->doa  = $now;
		$task->status = 0;
		$task->rating = 0;
		$task->save();
		sendmail($u->email_gm1,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3,"New Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendnotfication("Task Created <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, $u->id);
	}
	return redirect('/home');

});


Route::get('/verify/{tid}',function($tid){
	$task = App\Task::find($tid);
	$task->status=1;
	$task->save();
	return redirect('/home');
});

Route::get('/taskremove/{tid}',function($tid){
	$task = App\Task::find($tid);
	$proj = $task->project;
	$task->delete();
	return redirect('/task/'.$proj);
});

Route::post('submitaccess',function(Request $req){
	$user = App\User::find(Auth::user()->id);
	if ($req['ack'] == Auth::user()->ackey) {
		$user->act = 1;
		$user->save();
		return redirect('/home');
	}else{
		return redirect('/home?err=wrong key');
	}

});

Route::get('/taskedit/{tid}',function($tid){
	$task = App\Task::find($tid);
	$data = array('task' => $task );
	return view('/edittask',$data);
});
Route::post('/taskremark/{tid}' ,function($tid,Request $req){
	$task = App\Task::find($req['pId']);

	$date1=date_create($task->doc);
	$date2=date_create(date("Y/m/d"));
	$diff=date_diff($date1,$date2);
	if($diff->days>0){
		$task->status = 4;
	}else{
		$task->status = 2;
	}

	$task->marks = $req['mk'];
	
	$task->remark = $req['rev'];
	$proj = $task->project;
	$task->save();
	return redirect('/task/'.$proj);

});

Route::post('/edittask', function(Request $req){

	$task = App\Task::find($req['tid']);
	$task->detail = $req['detail'];
	$task->doc = $req['doc'];
	$task->project = $req['pid'];
	$task->status = 0;
	$task->rating = 0;
	$task->save();

	$u = App\User::find($req['pid']);

		sendmail($u->email_gm1,"Task Edited <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3,"Task Edited <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendmail($u->email_gm3,"Task Edited <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc);
		sendnotfication("Task Edited <br> Task ID: ".$task->id." <br> Task Details: ".$task->detail."<br> Date of Submission: ".$task->doc, $u->id);


	return redirect('/task/'.$req['pid']);

});




Auth::routes();
Route::get('/uid', function(){
	$user = App\User::where('type','=',1)->where('project_guide','=',Auth::user()->id)->get();
		$data = array('project' => $user);
		return view('teacheruid',$data);
});

Route::get('/home', function(Request $req){
	if (Auth::user()->type==0 && Auth::user()->act==1) {
		$user = App\User::where('type','=',1)->where('project_guide','=',Auth::user()->id)->get();
		$data = array('project' => $user);
		return view('teacherdash',$data);
	}elseif (Auth::user()->type==0 && Auth::user()->act==0) {
		if (Auth::user()->ackey == 0 ) {
			$user = App\User::find(Auth::user()->id);
			$user->ackey = rand(1000,9000);
			$user->save();
			sendmail($user->email,"Your Access Key For Activation Is ". $user->ackey);
		}else{
			$user = App\User::find(Auth::user()->id);
			sendmail($user->email,"Your Access Key For Activation Is ". $user->ackey);
		}
		return view('submitaccess');
	}
	else{
		if (isset($req['filter'])) {
			$task = App\Task::where('project','=',Auth::user()->id)->where('status','=',$req['filter'])->orderBy('id','DESC')->get();
			$data = array('task' => $task);
			return view('studentdash',$data);
		}else{
			$task = App\Task::where('project','=',Auth::user()->id)->orderBy('id','DESC')->get();
			$data = array('task' => $task);
			return view('studentdash',$data);
		}
	}
});
Route::get('/chart',function(){
	$task = App\Task::where('project','=',Auth::user()->id)->get();
		$data = array('task' => $task);
		return view('studentchart',$data);
});
Route::get('/stat/{id}',function($id){
	$task = App\Task::where('project','=',$id)->get();
		$data = array('task' => $task);
		return view('studentchart',$data);
});

function sendnotfication($message, $rec){
	$not  = new App\Notification;
	$not->message = $message;
	$not->rec = $rec;
	$not->save();
};
function sendnotficationall($message){

	$user = App\User::where('project_guide','=',Auth::user()->id)->get();

	foreach ($user as $u) {
		$not  = new App\Notification;
		$not->message = $message;
		$not->rec = $u->id;
		$not->save();
	}
	
};
function sendmail($mailadd,$sub)
{
	$text = 'Hello Mail';
    $mail = new PHPMailer\PHPMailer(); // create a n
    $mail->IsSMTP();
    $mail->SMTPDebug  = 0; // debugging: 1 = errors and messages, 2 = messages only
    $mail->SMTPAuth   = true; // authentication enabled
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 465; // or 587
    $mail->IsHTML(true);
    $mail->Username = "90045as@gmail.com";
    $mail->Password = "9004511116a";
    $mail->SetFrom("90045as@gmail.com", 'BEPT Admin');
    $mail->Subject = "Notification";
    $mail->Body = $sub;
    $mail->AddAddress($mailadd,"aaaa");
    if ($mail->Send()) {
        //echo 'Email Sended Successfully';
    } else {
        //echo 'Failed to Send Email';
    }
}
