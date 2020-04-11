@extends('layouts.app')

@section('content')



<style type="text/css">
   
.glyphicon:before 
{
  margin-right: 10px;
}


</style>


<div class="box box-primary">


				@if(isset($_GET['error_val']))
                <br><br>
                <div class='btn btn-danger btn-lg btn-block' align='center'> <?php Print($_GET['error_val']); ?>  </div>
                @endif


	            <h1 class="text-center">
		            <center>
		            	<button class="btn btn-primary text-center btn-lg" onclick="javascript: window.location.replace('/home');">   
		            		<span class="glyphicon glyphicon-home" ></span> Home
		            	</button>
		       
		            	<button class="btn btn-primary text-center btn-lg" onclick="javascript: window.location.replace('/editprofile');">   
		            		<span class="glyphicon glyphicon-pencil" ></span> Edit Profile
		            	</button>
		            </center>
	            </h1>
	            <br><br>


</div>

@endsection
