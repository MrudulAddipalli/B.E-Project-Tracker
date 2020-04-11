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

table {
  border-collapse:collapse; table-layout:fixed; width:310px;
}


table td{
  border:solid 1px #fab; width:100px; word-wrap:break-word;
} 

</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<div class="box">

<div class="box-header with-border">
  <br>

  <button type="button" class="btn btn-info pull-right hide1" data-toggle="modal" data-target="#myModal"> <span class="glyphicon glyphicon-plus"></span> Add New Notification</button>


<button type="button" class="btn btn-success pull-left hide1 " onclick="myFunction()"><span class="glyphicon glyphicon-print" ></span>Print </button>

<br><br>


      <br>

        <button class="btn btn-warning btn-lg btn-block">{{ $project_name }}</button>

        <button class="btn btn-light btn-lg btn-block">
            
                @if($name_gm1!="")
                <span class="btn btn-primary"> {{ $name_gm1 }} - [ {{ $email_gm1 }} ] </span>
                @endif
                @if($name_gm2!="")
                <span class="btn btn-primary"> {{ $name_gm2 }} - [ {{ $email_gm2 }} ] </span>
                @endif
                
                @if($name_gm3!="")
                <br><br>
                <span class="btn btn-primary"> {{ $name_gm3 }} - [ {{ $email_gm3 }} ] </span>
                @endif

                @if($name_gm4!="")
                <span class="btn btn-primary"> {{ $name_gm4 }} - [ {{ $email_gm4 }} ] </span>
                @endif
            
        </button>

        <br>


</div>

<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody>
    <tr>
      <th style="width: 10%">ID</th>
      <th style="width: 70%">Message</th>
      <th class="hide1">Delete</th>
    </tr>

    @foreach($not as $n)
    <tr>

      <td style="width: 10%">
        @php
        echo $n->id;
        @endphp
      </td>

      <td style="width: 70%">
      @php
      echo $n->message;
      @endphp
      </td>

        
      <td class="hide1">
        <button  class="btn btn-danger" id="blur" onclick="AreYouSure( {{$n->id }} )"> <span class="glyphicon glyphicon-trash"></span> Remove</button>
      </td>

    </tr>

    
    @endforeach

  </tbody></table>

  

  <hr><br>


</div>
<!-- /.box-body -->

</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Notification</h4>
      </div>
      <div class="modal-body">
        <form action="/createnotification" method="post" id="notify"  onkeydown = " return event.key != 'Enter' ; " >
            <div class="form-group">

              <textarea placeholder="Message" class="form-control" id="message" name="detail" required style="margin: 0px 1.00694px 0px 0px; width: 569px; height: 157px;"></textarea>
                <br>
                <input type="hidden" name="pid" value="{{ $pid }}">
                {{ csrf_field() }}
                <br>
                <button type="button" class="btn btn-primary" onclick="createNoty();" id="createtaskbutton"> <span class="glyphicon glyphicon-plus"></span> Create New Notification</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>




@endsection


<script type="text/javascript">


function createNoty()
{


    if( $("#message").val() == "" )
    {
      alert("Enter Some Message");
    }
    else
    {
      document.getElementById("createtaskbutton").disabled = true;
      $("#createtaskbutton").html("Please Wait  .   .   .");
      $('.ajax-loader').css("visibility", "visible");
      document.getElementById("notify").submit();
    }


}



function AreYouSure(x) 
{

    document.getElementById('blur').disabled=true;


  var r = confirm("Are You Sure , You Want To Delete Notification With ID "+x);
  if (r == true) 
  {

    $('.ajax-loader').css("visibility", "visible");

    var url="/deletenotification/"+x;

    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();

  }

  return false;

}


function myFunction() 
{

  $(".hide1").hide();

  window.print();

  $(".hide1").show();

}


</script>