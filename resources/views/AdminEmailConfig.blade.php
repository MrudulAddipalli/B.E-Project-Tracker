@extends('layouts.app')

@section('content')


<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/Ionicons/css/ionicons.min.css">




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


.password
{
  border:0px; 
  padding: 0px !important;
  word-wrap:break-word; 
  width: 50% !important; 
  margin-left: 5px !important;
}

</style>






<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<script src="{{ asset('js/app.js')}}"></script>


<div class="box">


<div class="box-header with-border" align="center">
  
  <h5 class="box-title pull-left " style="margin: 15px;" > Email Configuration </h5> 

    @if( $active == 1  )
    <span class="btn btn-info glyphicon glyphicon-ok pull-left "  style="margin: 12px;" ></span>
    @else
    <span class="btn btn-danger glyphicon glyphicon-ban-circle pull-left "  style="margin: 12px;" ></span>
    @endif
 


    @if( $active == 1  )

                <button class="btn btn-warning pull-right" onclick="deactivemail();" style="border-radius: 10px;">
                    <span class="glyphicon glyphicon-ban-circle" ></span>
                        Deactivate Email Service
                </button> 

    @else
                <button class="btn btn-info pull-right" onclick="activemail();" style="border-radius: 10px;" >
                    <span class="glyphicon glyphicon-ok" ></span>
                       Activate Email Service
                </button>

    @endif
 
</div>

                    @if($errors != "")
                         <!-- error messages -->
                        <div >              
                          <div class="btn btn-danger btn-lg btn-block" align="left" > 
                            {{ strip_tags($errors) }}
                          </div>
                        </div>
                    @endif

<!-- name branch type -->

<!-- style=" margin-top:15px; background-color: #ed9fe9;" -->
<div id="search" align="center" class="btn btn-primary btn-block">


  <form method="post" action="/adminemail" style="margin-top: 10px;">

      {{ csrf_field() }}
      <label>Sender Name</label>
       <input name="SetFrom"     value="<?php echo isset($_POST['SetFrom']) ? $_POST['SetFrom'] : '' ?>"          placeholder="Sender Name" type="text" required />
       <label>Email ID</label>
       <input name="Username"    value="<?php echo isset($_POST['Username']) ? $_POST['Username'] : '' ?>"        placeholder="Sender Email" type="email" required />
       <label>Password</label>
      <input name="Password"    value="<?php echo isset($_POST['Password']) ? $_POST['Password'] : '' ?>"        placeholder="Sender Password" type="password" required />

      <br>
 

       <label>Host Address</label>
       <input name="Host"        value="<?php echo isset($_POST['Host']) ? $_POST['Host'] : '' ?>"                placeholder="Email Host" type="text" required />
       <label>Port No.</label>
       <input name="Port"        value="<?php echo isset($_POST['Port']) ? $_POST['Port'] : '' ?>"                placeholder="Email Port No." type="text" required />
       <label>Security</label>
      <input name="SMTPSecure"  value="<?php echo isset($_POST['SMTPSecure']) ? $_POST['SMTPSecure'] : '' ?>"    placeholder="Email Security" type="text" required />

      <br>

                                 

      <button type=submit class="btn btn-info" style="height: 40px; margin-left: 50px; border-radius: 10px 10px; " >
        <span class="glyphicon glyphicon-plus" ></span>
            Add Email Configuration
      </button>

  </form>


 </div>



<div class="box-body" >
  <table class="table table-bordered" style='font-size:18px; ' >
    <tbody><tr>
      <th>ID</th>
      <th>Sender Name</th>
      <th>Email</th>
      <th>Password</th>
      <th>Host Address</th>
      <th>Port Number</th>
      <th>Security</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    @foreach($email as $e)
    <tr>
      
      <td>
            <button class="btn btn-secondary">
                    {{ $e->id }}
            </button>
      </td>

       <td>
            {{ $e->SetFrom }}
      </td>

      <td>
            {{ $e->Username }}
      </td>

      <td>
        
           <input class="password" id="{{ $e->id }}" type="Password" value="{{ $e->Password }}" readonly/>
           
            <button class="btn btn-info"  onclick="Toggle( {{ $e->id }} )"  > <span class="glyphicon glyphicon-eye-open" style="margin:0px !important; "></span></button>
      
      </td>

      <td>
            {{ $e->Host }}
      </td>

      <td>
            {{ $e->Port }}
      </td>

      <td>
            {{ $e->SMTPSecure }}
      </td>

      <td>
                
                @if($e->in_use == 1)

                          <button class="btn btn-primary">
                              <span class="glyphicon glyphicon-ok"></span>
                                  In Use.
                          </button>

                           <button onclick="testemail( {{ $e->id }} )" class="btn btn-info" >
                              <span class="glyphicon glyphicon-envelope"></span>
                                  Test.
                          </button>

                  @else
                           <button onclick="testemail( {{ $e->id }} )" class="btn btn-info" >
                              <span class="glyphicon glyphicon-envelope"></span>
                                  Test.
                          </button>

                @endif

      </td>



      <td>

                    @if( $e->in_use == 1 )

                          <button onclick="deactivatemail( {{ $e->id }} )" class="btn btn-warning">
                              <span class="glyphicon glyphicon-ban-circle"></span>
                                  Deactivate
                          </button><br>

                    @else( $e->in_use == 0 )


                           <button onclick="activatemail( {{ $e->id }} )" class="btn btn-info">
                              <span class="glyphicon glyphicon-ok"></span>
                                  Activate
                          </button><br>

                    @endif


                    

                    <button onclick="editemail(  {{ $e->id }}  )" class="btn btn-secondary">
                        <span class="glyphicon glyphicon-pencil"></span>
                            Edit
                    </button>

                    <button onclick="deletemail( {{ $e->id }} )" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                            Delete
                    </button>

      </td>
    </tr>




@endforeach

   </tbody>
  </table>
</div>

<!-- /.box-body -->
</div>


@endsection



<script type="text/javascript">


function deactivemail() 
{
    var r = confirm("Are You Sure ?\nYou Want To Deactivate Email Servie?");
    if (r == true) 
    {
        $('.ajax-loader').css("visibility", "visible");
        $('body').append('<a id="link" href="/EmailToggle" >&nbsp;</a>');
        $('#link')[0].click().remove();
    }
    return false;
}


function activemail() 
{
    var r = confirm("Are You Sure ?\nYou Want To Activate Email Servie?");
    if (r == true) 
    {
        $('.ajax-loader').css("visibility", "visible");
        $('body').append('<a id="link" href="/EmailToggle" >&nbsp;</a>');
        $('#link')[0].click().remove();
    }
    return false;
}


function Toggle(x) 
{
    var current_password = document.getElementById(x); 
    if (current_password.type === "password") { current_password.type = "text"; } 
    else { current_password.type = "password"; } 
} 


function deletemail(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Delete Email Configuration With ID "+x+".");
  if (r == true) 
  {
     $('.ajax-loader').css("visibility", "visible");
    var url="/deletemail/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click().remove();
  }
  return false;
}


function activatemail(x) 
{
  var r = confirm("Are You Sure ?\nYou Want To Activate Email Configuration With ID "+x+"?");
  if (r == true) 
  {
      $('.ajax-loader').css("visibility", "visible");
      singlemailtoggle(x);
  }
  return false;
}


function deactivatemail(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Deactivate Email Configuration With ID "+x+".");
  if (r == true) 
  {
     $('.ajax-loader').css("visibility", "visible");
     singlemailtoggle(x);
  }
  return false;
}

function singlemailtoggle(x) 
{
    var url="/singlemailtoggle/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();
}

function editemail(id) 
{
  window.location = "/editemailconfig/"+id;
}

function testemail(id) 
{
  window.location = "/testemailconfig/"+id;
}

</script>

 
