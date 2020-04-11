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


<style type="text/css" media="print">
  @page { size: landscape; }
</style>


<style type="text/css">


table {
   width: 100% ;
   border-collapse:collapse; align-content: center;
}

table td {
  word-wrap:break-word;
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


.glyphicon:before {
  margin-right: 10px;
}

</style>





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

  <a class="btn btn-primary hide1" href="?">All Task</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1" href="?filter=0">On Going</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1" href="?filter=1">Verfying</a> &nbsp; &nbsp; &nbsp;
  <a class="btn btn-default hide1" href="?filter=2">Completed</a> &nbsp; &nbsp; &nbsp;


    <button type="button" class="btn btn-success pull-center hide1 " onclick="myFunction()"> <span class="glyphicon glyphicon-print" ></span>Print 
    </button>

</div>



<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th>Task ID</th>
      <th>Detail</th>
      <th>Date of Assignment</th>
      <th>Date of Submission</th>
      <th>Status</th>
      <th>Remark</th>
      <th class="hide1" >Action</th>
    </tr>

    @foreach($task as $t)
    <tr>
     <td>{{ $t->id }}</td>
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



      <td>
      @if($t->marks!=0)
      <center class="btn btn-warning">{{ $t->marks }} </center>   {{ $t->remark }}
      @elseif($t->marks==0)
      <center class="btn btn-info">Not Reviewed</center>
      @endif

      </td>



      <td  class="hide1" >
        @if($t->status==0 || $t->status==3)
          <button id="blur" class="btn btn-primary" onclick="AreYouSure( {{$t->id }} )"> <span class="glyphicon glyphicon-open"></span> Submit</button>
          <!-- <a href="/verify/{{ $t->id }}" class="btn btn-primary"> <span class="glyphicon glyphicon-open"></span> Submit</a> -->
        @endif
      </td>
    </tr>

    
    @endforeach

  </tbody></table>

  
</div>
<!-- /.box-header -->



</div>
@endsection


<script type="text/javascript">



function AreYouSure(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Submit Task With ID "+x);
  if (r == true) 
  {

      document.getElementById('blur').disabled=true;
      $('.ajax-loader').css("visibility", "visible");


    var url="/verify/"+x;

    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();

  }

  return false;

}

</script>



<script>
function myFunction() 
{

  $(".hide1").hide();

  window.print();

  $(".hide1").show();

}
</script>