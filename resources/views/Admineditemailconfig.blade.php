@extends('layouts.app')

@section('content')




<style type="text/css">
    
.ajax-loader {
  
    visibility: hidden;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 9999999 !important;


}

.ajax-loader img {
  position: relative;
  top:50%;
  left:50%;
}


.glyphicon:before {
  margin-right: 10px;
}



table 
{
   border-collapse:collapse; align-content: center;
}

th { border:solid 2px #D8D8D4 !important;}

table td 
{
  border:solid 2px #D8D8D4 !important; 
  word-wrap:break-word; 
  /*width: 40%;*/
} 

td,th,table {
  align-content: center;
  padding: 10px;
}

td
{
  text-align: center; 
  padding: 10px;
  position: relative;
  font-size: 100%;
}

input
{
  padding: 20px;
  width: 230px;
  height: 35px;
  border-radius: 15px;
  margin:10px;
  color: black;
}

button
{
  margin:5px;
}



</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<div class="box box-primary">


            <div class="box-header">Edit Email Configuration

                <br><hr>

                <form action="/editemailconfig/{{$emailconfig->id}}" method="post" id="form1"  onkeydown = " return event.key != 'Enter' ; " >

                              {{ csrf_field() }}

                              <table style="width: 60%;">

                                <input type="hidden" id="edit_id" ></inpute>

                                 @if($errors != "")
                                     <!-- error messages -->
                                    <div >              
                                      <div class="btn btn-danger btn-lg btn-block" align="left" > 
                                        {{ strip_tags($errors) }}
                                      </div>
                                    </div>

                                @endif


    <tr>
      <td> <label>Sender Name</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" value=" <?php echo isset($_POST['SetFrom']) ? $_POST['SetFrom'] : $emailconfig->SetFrom ?> " name="SetFrom" type="text" required /> </td>
    </tr>
    <tr>
      <td> <label>Email ID</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : $emailconfig->Username  ?> " name="Username" type="email" required /></td>
    </tr>
    <tr>
      <td> <label>Password</label> </td>
      <td  style="width: 80%" > <input style="width: 70%; padding-left: 20px !important;" id="{{ $emailconfig->id }}" value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : $emailconfig->Password ?> " name="Password" type="password" required /> 

        <button class="btn btn-info"  type="button" onclick="Toggle( {{ $emailconfig->id }} )"  > <span class="glyphicon glyphicon-eye-open" style="margin:0px !important; "></span>
        </button>

      </td>
    </tr>
    <tr>
      <td> <label>Host Address</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" value="<?php echo isset($_POST['Host']) ? $_POST['Host'] :  $emailconfig->Host ?> " name="Host" type="text" required /> </td>
    </tr>
    <tr>
      <td> <label>Port No.</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" value="<?php echo isset($_POST['Port']) ? $_POST['Port'] :  $emailconfig->Port ?> " name="Port" type="text" required /> </td>
    </tr>
    <tr>
      <td> <label>Security</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" value="<?php echo isset($_POST['SMTPSecure']) ? $_POST['SMTPSecure'] :  $emailconfig->SMTPSecure ?> " name="SMTPSecure" type="text" required /> </td>
    </tr>

    <tr>
      <td colspan="2"><button type="submit" class="btn btn-info" style="border-radius: 10px 10px;" >Save Changes</button>

      </td>
    </tr>
                        </table>
                   
                </form>

            </div>

</div>

@endsection


<script type="text/javascript">


function Toggle(x) 
{
    var current_password = document.getElementById(x); 
    if (current_password.type === "password") { current_password.type = "text"; } 
    else { current_password.type = "password"; } 
}

</script>
