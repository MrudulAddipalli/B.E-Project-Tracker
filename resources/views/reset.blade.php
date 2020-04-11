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

</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>




<script src="{{ asset('js/jquery.min.js') }}"></script>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

              <div class="box-header with-border">
                 <h4 class="panel-heading with-border" align="center">Reset Password</h4>
              </div>

                <div class="panel-body">

                    <form class="form-horizontal" id="form1"  method="post"  onkeydown = " return event.key != 'Enter' ; " >

                        {{ csrf_field() }}
 

                        <div class="form-group">

                          @if(isset($_GET['err']))
                          <br>
                          <div class='btn btn-danger btn-lg btn-block' align='center'> <?php Print($_GET['err']); ?>  </div>
                          <br><br>
                          @endif




                            <label for="email" class="col-md-4 control-label">E-Mail or Project UID</label>

                            <div class="col-md-6">
                                
                                <input id="email" type="text" class="form-control" name="email" required>
                          
                            <div>

                            <br>
                            
                            <div class="col-md-6">
                            
                                 <button type="button" onclick="OTP();" id="otp" class="btn btn-primary btn-lg btn-block" align="center"><span class="glyphicon glyphicon-send"></span>Send OTP</button>

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

      r=false;

        if(!isNaN($("#email").val()) && $("#email").val()!="" )
        {
            r=confirm("Do You Want To Send Verification OTP To All Group Memebers Email Address With UID "+$("#email").val());
        }
        if(isNaN($("#email").val()) && $("#email").val()!="" )
        {
            r=confirm("Do You Want To Send Verification OTP "+$("#email").val());
        }
        if($("#email").val()=="")
        {
            $("#errors").html("Enter Email ID or Password").show();
        }
        else
        {
            if(r==true)
            {
                 document.getElementById("otp").disabled = true;
                 $("#otp").html("Sending OTP   .   .   .  ");
                 $('.ajax-loader').css("visibility", "visible");
                 document.getElementById("form1").submit();
            }
        }

    }

</script>
