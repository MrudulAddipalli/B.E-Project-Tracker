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


.glyphicon:before 
{
  margin-right: 10px;
}


</style>



<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="with-border" align="center">Enter Key To Continue.</h3>
            </div>



                @if(isset($_GET['err']))
                <br><br>
                <div class='btn btn-danger btn-lg btn-block' align='center'> <?php Print($_GET['err']); ?>  </div>
                @endif

                    <form method="post" action="/submitaccess" role="form" class="md"   onkeydown = " return event.key != 'Enter' ; "  >
                        <br><br>
                        <div class="form-group " align='center'>
                            {{ csrf_field() }}
                            <input type="password" name="ack" placeholder="Password" pattern="[0-9]*" style="width: 30%;padding: 10px;" class="form-control with-border" required="true"  oninput="javascript: if (this.value.length > 4) this.value = this.value.slice(0, 4);">
                            <br><br>
                            <button type="button" class="btn btn-primary with-border" id="x" onclick="javascript: this.disabled=true; $('form').submit();" > <span class="glyphicon glyphicon-send" ></span> Submit </button>
                        </div>
                        <br><br>
                        </div>
                    </form>

                        <!-- error messages -->
                        <div >              
                          <div class="btn btn-danger btn-lg btn-block" align="left" id="errors" style = "display: none;"> 
                          </div>
                        </div>


                    </div>

@endsection