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
  top:40%;
  left:40%;
  display: block;
}

.glyphicon:before 
{
  margin-right: 10px;
}


</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">



                <div class="panel-heading">Profile Edit</div>
                <div class="panel-body">

                    



                    <form class="form-horizontal" method="POST" id="edit" action="/editprofile"   onkeydown = " return event.key != 'Enter' ; "   >
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Email</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                            </div>
                        </div>


                         <div class="form-group">
                            <label for="branch" class="col-md-4 control-label">Branch</label>
                            <div class="col-md-6">

                            <select id="branchselect" name="branch" class="form-control" >
                            <option value="{{$user->branch}}" selected>{{$user->branch}}</option>
                            <option value="Computer">Change To - Computer</option>
                            <option value="IT">Change To - IT</option>
                            <option value="Civil">Change To - Civil</option>
                            <option value="EXTC">Change To - EXTC</option>
                            <option value="ETRX">Change To - ETRX</option>
                            </select>

                            </div>
                        </div>



                         <br>

                        <center>
                            <div class="btn btn-warning">
                                <span class="glyphicon glyphicon-hand-right" ></span>  
                                If you want to change the password then use the below password fields else leave them blank .&nbsp;&nbsp;&nbsp;
                                <span class="glyphicon glyphicon-hand-left" ></span>
                            </div>
                        </center>

                        <br><br>

                        <div class="form-group">
                            <label for="password" class="col-md-4 control-label">New Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                            <div class="col-md-6">
                                <input id="password_confirmation" type="password" class="form-control" name="password_confirmation">
                            </div>
                        </div>

                        <hr>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="button" id="save" class="btn btn-primary" onclick="verify();">
                                    <span class="glyphicon glyphicon-hdd" ></span>Save Changes
                                </button>
                            </div>
                        </div>

                        <hr>

                        <!-- error messages -->
                    <div >              
                      <div class="btn btn-danger btn-lg btn-block" align="left" id="errors" style = "display: none;"> 
                      </div>
                    </div>



                    </form>
                </div>
            </div>
        </div>
    </div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

</div>
@endsection

<script type="text/javascript">

var original_email_id = '<?php echo $user->email; ?>' ; 
console.log(original_email_id);

    
    function verify() 
    {
            
            /*var str;
            if(original_email_id == $('#email').val() ) { str="Are You Sure\nYou Want To Update Your Profile ?"; }
            else{ str="Verification Key For New Email Address Will Be Sent To Your Email ID"; }
            r=confirm(str);*/


            r=confirm("Are You Sure\nYou Want To Update Your Profile ?");

            if(r==true)
            {                


                    if(  $('#password_confirmation').val() ==  $('#password').val() )
                    {


                      $("#errors").empty();
                      $("#errors").hide();

                       document.getElementById("save").disabled = true;
                       $("#save").html("Please Wait  .   .   .");
                       $('.ajax-loader').css("visibility", "visible");
                  


                         var formData = new FormData($('#edit')[0]);
                         $.ajax({
                            type: "POST",
                            url: "/editprofile",
                            data: formData,
                            dataType:"json",
                            cache:false,
                            processData:false,
                            contentType:false,
                            success: function(result) 
                            {                

                              $('.ajax-loader').css("visibility", "hidden");
                              $("#errors").hide();

                              alert("Profile Updated Successfully");

                                $('body').append('<a id="link" href="/editprofile" >&nbsp;</a>');
                                $('#link')[0].click();
                                $('#link')[0].remove();
                              
                            },
                            error: function(json) 
                            {
                               document.getElementById("save").disabled = false;
                               $("#save").html("<span class='glyphicon glyphicon-hdd' ></span>Save Changes");
                               $('.ajax-loader').css("visibility", "hidden");

                               //$("html, body").animate({ scrollTop: 0 }, "slow");

                                if(json.status === 422)
                                { $("#errors").html(json.responseJSON['errors']).show(); }
                                else 
                                { $("#errors").hide();  }
                            
                            }
                            
                          });//end of ajax


                    }
                    else
                    {
                        $("#errors").html("Incorrect Password Fields.").show();
                        $("html, body").animate({ scrollTop: 0 }, "slow");
                    }

            }


    }// end of verify

</script>