@extends('layouts.app')

@section('content')

<?php 
$comp=0;
$ver=0;
$ong=0;
$all=0;

$smks=0;
foreach ($task as $t) {

  if ($t->status==1) {
    $ver=$ver+1;
  }
  if ($t->status==2) {
    $comp=$comp+1;
    $smks= $smks+$t->marks;
  }
  if ($t->status==4) {
    $comp=$comp+1;
    $smks= $smks+$t->marks;
  }
  if ($t->status==0) {
    $ong=$ong+1;
  }
  $all = $all+1;
}
$pr=0;
if($comp!=0){
$pr = $smks/$comp;
$pr = $pr*10;
$pr = round($pr,4);
}
?>


<style type="text/css">

@page { size: landscape; }

    
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

table {
   width: 100% ;
   border-collapse:collapse; align-content: center;
   word-wrap:break-word;
}

th { border:solid 2px #D8D8D4 !important;}

table td {
  border:solid 2px #D8D8D4 !important; 
  width: 40%;
} 

td,th,table {
  text-align: center; 
  padding: 10px;
}

td
{
  position: relative;
  font-size: 100%;
}

td:nth-of-type(1) { width: 20px !important;   }
td:nth-of-type(2) { max-width: 420px !important;  word-wrap:break-word; }
td:nth-of-type(3) { width: 40px !important;   }
td:nth-of-type(4) { width: 40px !important;   }
td:nth-of-type(5) { width: 30px !important;   }
td:nth-of-type(6) { max-width: 80px !important;  word-wrap:break-word; }
td:nth-of-type(7) { width: 40px !important;   }


/*tr:nth-child(even){background-color: #f2f2f2}
*/

.glyphicon:before 
{
  margin-right: 10px;
}



</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>






<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Task</span>
              <span class="info-box-number">{{ $all }}</span>
            </div>
          </div>        
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Completed</span>
              <span class="info-box-number">{{$comp}}</span>
            </div>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Verfying</span>
              <span class="info-box-number">{{$ver}}</span>
            </div>
          </div>        
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">OnGoing</span>
              <span class="info-box-number">{{ $ong }}</span>
            </div>
          </div>
        </div>
  </div>




       <br>

        <button class="btn btn-info btn-lg btn-block">{{ $project_name }}</button>

        <button class="btn btn-light btn-lg btn-block" style="background-color: #FFFFFF;" >
            
                @if($name_gm1!="")
                <span class="btn btn-info"> {{ $name_gm1 }} - [ {{ $email_gm1 }} ] </span>
                @endif
                @if($name_gm2!="")
                <span class="btn btn-info"> {{ $name_gm2 }} - [ {{ $email_gm2 }} ] </span>
                @endif
                
                @if($name_gm3!="")
                <br><br>
                <span class="btn btn-info"> {{ $name_gm3 }} - [ {{ $email_gm3 }} ] </span>
                @endif

                @if($name_gm4!="")
                <span class="btn btn-info"> {{ $name_gm4 }} - [ {{ $email_gm4 }} ] </span>
                @endif
            
        </button>

        <button class="btn btn-warning btn-lg btn-block"  style="background-color: #FFA500;" > Performance Rate: {{ $pr }}% </button>



        <br>

        



<div class="box">
<div class="box-header with-border">

  <!-- Trigger the modal with a button -->
  <a class="btn btn-primary hide1 " href="?">All Task</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1 " href="?filter=0">On Going</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1 " href="?filter=1">Verfying</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1 " href="?filter=2">Completed</a> &nbsp; &nbsp; &nbsp;

<button type="button" class="btn btn-success pull-center hide1" onclick="myFunction()"> <span class="glyphicon glyphicon-print" ></span>Print</button>
  

<button type="button" class="btn btn-info pull-right hide1" data-toggle="modal" data-target="#myModal">  <h5>  <span class="glyphicon glyphicon-plus"></span>Add New Task </h5> </button> 



</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody>

          <tr>
            <th>Task ID</th>
            <th>Detail</th>
            <th>Date of <br>Assignment</th>
            <th>Date of <br>Submission</th>
            <th>Status</th>
            <th>Remark</th>
            <th class=" hide1"  >Action</th>
          </tr>
    

    @foreach($task as $t)

    <tr>
  
      <td> {{ $t->id }}</td>
      <td>{{ $t->detail }}</td>
      <td>{{ $t->doa }}</td>
      <td>{{ $t->doc }}</td>
      <td> 

      @if($t->status==0)
      <button class="btn btn-warning"><span class="glyphicon glyphicon-refresh"></span>On Going</button>
      @elseif($t->status==1)
      <button class="btn btn-primary"><span class="glyphicon glyphicon-eye-open"></span>Verifying</button>
      @elseif($t->status==2)
      <button class="btn btn-success"><span class="glyphicon glyphicon-ok"></span>Completed</button>
      @elseif($t->status==3)
      <button class="btn btn-danger"><span class="glyphicon glyphicon-eye-open"></span>Delayed</button>
      @elseif($t->status==4)
      <button class="btn btn-success"><span class="glyphicon glyphicon-ok-circle"></span>Late Completed</button>
      @endif

      </td>


      <td  >
      @if($t->marks!=0)
      <center class="btn btn-warning">{{ $t->marks }} </center> <br> {{ $t->remark }}
      @elseif($t->marks==0)
      <center class="btn btn-info">Not Reviewed</center>
      @endif
      </td>




      <td class="hide1"  >
          
          <a class="btn btn-primary" href="/taskedit/{{ $t->id }}"  style="margin:5px;"> <span class="glyphicon glyphicon-pencil"></span> Edit</a>
          <!-- <a class="btn btn-danger" href="/taskremove/{{ $t->id }}">Remove</a> -->
          <button class="btn btn-danger" id="blur" onclick="AreYouSure( {{$t->id }} )" style="margin:5px;" > <span class="glyphicon glyphicon-trash"></span> Remove</button>


          <!-- verify -->
          @if($t->status==1)
          <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-book-id="{{ $t->id }}" style="margin:5px;" > <span class="glyphicon glyphicon-eye-open"></span> Remark</a>
          @endif

          <!-- again verify -->
          @if($t->status==2)
          <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-book-id="{{ $t->id }}" style="margin:5px;" > <span class="glyphicon glyphicon-eye-open"></span>Edit Remark</a>
          @endif

      </td>


    </tr>

    
    @endforeach

  </tbody></table>

  <hr>

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
        <h4 class="modal-title">Create New Task</h4>
      </div>
      <div class="modal-body">
        <form action="/createtask" method="post" id="taskdetailsform"  onkeydown="return event.key != 'Enter';"  >
            <div class="form-group">
              <textarea placeholder="Task Details" class="form-control" type="text" id="detail" name="detail" required style="margin: 0px 1.00694px 0px 0px; width: 569px; height: 157px;"></textarea>

              <br>
                <label>Date of Submission</label>
                <input id="doc" class="form-control" type="date" name="doc" placeholder="Date of Completion">
                <input type="hidden" name="pid" value="{{ $pid }}">
                {{ csrf_field() }}
                <br>
                <button type="button" class="btn btn-primary" onclick="createtask();" id="createtaskbutton" > <span class="glyphicon glyphicon-plus"></span> Create New Task</button>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Remark</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/taskremark/{{ $pid }}" method="post" id="remarkform" onkeydown="return event.key != 'Enter';" >
        <br>
          <input type="number" id="mk" min="1" max="10" class="form-control" name="mk" placeholder="Enter Marks Out of 10" pattern="[0-9]*" >
          <input type="hidden" value="" name="pId" id="ppid">
          <br>
          <input type="text" id="rev" class="form-control" placeholder="Good,Bad [Max Length 100 Character] " name="rev" maxlength="100"  >
          <br>
          <br>
                <button type="button" onclick ="remarkfunc()" id="remark" class="btn btn-primary">
                  <span class="glyphicon glyphicon-hdd" ></span>Save</button>
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
@endsection



<script type="text/javascript">


  // for modal data passing check javascript under views \ layouts \ app.blade.php




function createtask()
{

  if( $("#detail").val() == "" )
  {
    alert("Enter Some Details");
  } 
  else
  {     
     document.getElementById("createtaskbutton").disabled = true;
     $("#createtaskbutton").html("Please Wait  .   .   .");
     $('.ajax-loader').css("visibility", "visible");
     document.getElementById("taskdetailsform").submit();
  }
}

function remarkfunc() 
{

    if( $("#mk").val() == "" )
    {
      alert("Enter Marks");
    }
    else if( $("#mk").val() > 10 || $("#mk").val() < 1 )
    {
      alert("Mark Should Be Between 1 And 10");
    }
    else if($("#rev").val() == "" )
    {
      alert("Enter Remark");
    }
    else
    { 
      document.getElementById("remark").disabled = true;
      $("#remark").html("Please Wait  .   .   .");
      $('.ajax-loader').css("visibility", "visible");
      document.getElementById('remarkform').submit();
    }

}


function AreYouSure(x) 
{

  document.getElementById('blur').disabled=true;

  var r = confirm("Are You Sure ?\nYou Want To Delete Task With ID "+x);
  if (r == true) 
  {

    var url="/taskremove/"+x;

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

