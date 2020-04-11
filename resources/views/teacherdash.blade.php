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





<script src="{{ asset('js/app.js')}}"></script>


<div class="box">
<div class="box-header with-border">
  <h3 class="box-title">All Projects</h3>
  <div class="pull-right">
    <a class="btn btn-primary" data-toggle="modal" data-target="#notmodal"><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;&nbsp;Send Bulk Notification</a> 
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <a class="btn btn-primary" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;&nbsp;Create Bulk Task</a>
  </div>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 10px">UID</th>
      <th>Project Title</th>
      <th>Task List</th>
      <th>Statistics</th>
      <th>Reports</th>
      <th>Rubrics</th>
      <th>Notifications</th>
      <th>Action</th>
    </tr>

    @foreach($project as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->project_title }}</td>



      @if($p->act==0)
      <td colspan="5"> <button id="blur1" onclick="approveproject( {{ $p->id }} )" class="btn btn-success btn-lg btn-block"> <span class="glyphicon glyphicon-ok"></span>Approve Project Group  </button> </td>
      <td>  <button id="blur2" onclick="rejectproject( {{ $p->id }} )" class="btn btn-danger btn-lg btn-block ">  <span class="glyphicon glyphicon-trash"></span>Reject Project Group  </button>  </td>
      @else
      <td><a href="{{ url('/') }}/task/{{ $p->id }}" class="btn btn-warning">  <span class="glyphicon glyphicon-triangle-right"></span>Task</a></td>
      <td><a href="{{ url('/') }}/stat/{{ $p->id }}"  class="btn btn-info">  <span class="glyphicon glyphicon-hourglass"></span>Statistics</a></td>
      <td><a href="{{ url('/') }}/report/{{ $p->id }}"  class="btn btn-danger">  <span class="glyphicon glyphicon-th-list"></span>Report</a></td>
      <td><a href="{{ url('/') }}/rubrics/{{ $p->id }}"  class="btn btn-primary"> <span class="glyphicon glyphicon-star"></span> Rubrics</a></td>
      <td><a href="{{ url('/') }}/notification/{{ $p->id }}"  class="btn btn-success">  <span class="glyphicon glyphicon-comment"></span>Notification</a></td>
      <td>  <button id="blur2" onclick="rejectproject( {{ $p->id }} )" class="btn btn-danger">  <span class="glyphicon glyphicon-trash"></span>Reject Project Group  </button>  </td>
      @endif

      
    </tr>
    @endforeach
  </tbody></table>
</div>
<!-- /.box-body -->
</div>



<!-- Modal -->
<div class="modal fade" id="notmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/sendnotificationall" method="post" id="bulknot"  onkeydown = " return event.key != 'Enter' ; " >

          <textarea placeholder="Message" class="form-control" id="message" name="message" required style="margin: 0px 1.00694px 0px 0px; width: 569px; height: 157px;"></textarea>

          <br>
          <button type="button" id="bulkbutton" name="Send To All" class="btn btn-primary" onclick="bulknotbutton()" ><span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;&nbsp;Send Bulk Notificaion</button>
          {{ csrf_field() }}

          <br>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Task</h4>
      </div>
      <div class="modal-body">
        <form action="/createtaskbulk" method="post" id="bulktask"  onkeydown = " return event.key != 'Enter' ; " >
            <div class="form-group">
                <textarea placeholder="Task Details" class="form-control" type="text" id="detail" name="detail" required style="margin: 0px 1.00694px 0px 0px; width: 569px; height: 157px;"></textarea>
                <br>
                <label>Date of Submission</label>
                <input id="doc" value="2018-10-26" class="form-control" type="date" name="doc" placeholder="Date of Completion">

                {{ csrf_field() }}
                <br>
                <button type="button" id="bulkbutton2" class="btn btn-primary" class="btn btn-primary" onclick="bulknotbutton2()" > <span class="glyphicon glyphicon-send"></span>&nbsp;&nbsp;&nbsp;Create Bulk Task </button>
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


function approveproject(x) 
{
  var r = confirm("Are You Sure ?\nYou Want To Approve Project Group With ID "+x);
  if (r == true) 
  {
      document.getElementById('blur1').disabled=true;

    var url="/approveproject/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();

  }
  return false;
}


function rejectproject(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Reject Project Group With ID "+x+" \nThis Will Be Removed Under Your Projects.");
  if (r == true) 
  {
      document.getElementById('blur2').disabled=true;

    var url="/rejectproject/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();
  }
  return false;
}




function bulknotbutton() 
{

  if( $("#message").val() == "" )
  {
    alert("Enter Some Message");
  }
  else
  {
    document.getElementById("bulkbutton").disabled = true;
    $("#bulkbutton").html("Please Wait  .   .   .");
    $('.ajax-loader').css("visibility", "visible");
    document.getElementById("bulknot").submit();
  }
  
}



function bulknotbutton2() 
{


  if( $("#detail").val() == "" )
  {
    alert("Enter Some Details");
  }
  else
  {
    document.getElementById("bulkbutton2").disabled = true;
    $("#bulkbutton2").html("Please Wait  .   .   .");
    $('.ajax-loader').css("visibility", "visible");
    document.getElementById("bulktask").submit();
  }
}


</script>

 
