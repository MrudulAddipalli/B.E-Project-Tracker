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

</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>




<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Reset Password</div>

                <div class="panel-body">




                    <form class="form-horizontal" id="form1"  method="post" action="/reset2" onkeydown = " return event.key != 'Enter' ; "   >

                        {{ csrf_field() }}

                            <div class="form-group">
                                <div class="col-md-6">
                                    <input id="email" type="hidden" class="form-control" name="email" value="{{ $email }}">
                                </div>
                            </div>


                            <div class="form-group">

                                <label for="password" class="col-md-4 control-label">Enter OTP</label>

                                <div class="col-md-6">
                                    <input id="otp" type="password" class="form-control" name="otp" oninput="javascript: if (this.value.length > 4) this.value = this.value.slice(0, 4);" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="password" class="col-md-4 control-label">New Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>


                            <div  class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm New Password</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>

                        


                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="button" onclick="OTP();" id="otpbtn" class="btn btn-primary">
                                        Reset Password
                                    </button>
                                </div>
                            </div>


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
</div>
@endsection

<script type="text/javascript">
    
    function OTP() 
    {     

        r=confirm("Are You Sure ?");

        if(r==true)
        {
              document.getElementById("otpbtn").disabled = true;
              $("#otpbtn").html("Please Wait ...");
              $('.ajax-loader').css("visibility", "visible");

              $("#errors").hide();


                 var formData = new FormData($('#form1')[0]);
                 $.ajax({
                    type: "POST",
                    url: "/reset2",
                    data: formData,
                    dataType:"json",
                    cache:false,
                    processData:false,
                    contentType:false,
                    success: function(result) 
                    {                
                      alert("Password Reset Done.");
                      $("#errors").hide();
                      $('.ajax-loader').css("visibility", "hidden");

                      var url="/login";
                      $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
                      $('#link')[0].click();
                      $('#link')[0].remove();
                      
                    },
                    error: function(json) 
                    {
                       document.getElementById("otpbtn").disabled = false;
                       $("#otpbtn").html("Reset Password");                 
                       $('.ajax-loader').css("visibility", "hidden");


                        if(json.status === 422) {
                              var errors = json.responseJSON;
                              let div_error = [];
                              $.each(errors['errors'], function (key, value) {
                                  div_error.push(value);
                              });

                              $("#errors").html(div_error.join('<br>')).show();
                              

                          } else {
                              $("#errors").hide();
                          }
                    }
                  });//end of ajax


        }
           


    }///end of otp function

</script>
