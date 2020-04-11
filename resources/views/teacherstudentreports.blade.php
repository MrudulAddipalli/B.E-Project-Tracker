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
  
.glyphicon:before 
{
  margin-right: 10px;
}

table {
  border-collapse:collapse; table-layout:fixed; width:310px;
}


table td{
  border:solid 1px #fab; width:100px; word-wrap:break-word;
} 

</style>



<div class="row">

<div class="box">
<div class="box-header with-border">

</div>
<!-- /.box-header -->
<div class="box-body">

<button id="printbtn" onclick="myFunction()" class="btn btn-success"><span class="glyphicon glyphicon-print"></span>Print Report</button>
<br><br>
       
       <br>

        <button class="btn btn-info btn-lg btn-block">{{ $project_name }}</button>

        <button class="btn btn-light btn-lg btn-block" style="background-color: #FFFFFF;">
            
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


  <table class="table table-bordered">
    <tbody>


      <colgroup width="30"></colgroup>
      <colgroup width="345"></colgroup>
      <colgroup width="100"></colgroup>
      <colgroup width="100"></colgroup>


      <tr>
      <th >Task ID</th>
      <th>Task Details</th>
      <th>Remark</th>
      <th>Marks</th>
     

    </tr>

    @foreach($task as $t)
    <tr>
      <td>{{ $t->id }}</td>

      <td>{{ $t->detail }}</td>

      <td>{{ $t->remark }}</td>

      <td>

         @if($t->marks!=0)
            <button class="btn btn-info">  {{ $t->marks }} </button>
            <br>
            @for($i=1; $i<=$t->marks;$i++)
            <i style="color:#ff9404;" class="fa fa-star"></i>
            @endfor
         @elseif($t->marks==0)
          <button class="btn btn-info">Not Reviewed </button>
         @endif

      </td>
      
    
    </tr>
    @endforeach
  </tbody></table>

<hr>

</div>

<br>

<!-- /.box-body -->

</div>

@endsection


<script>
function myFunction() {
  $("#printbtn").hide();
  window.print();
  $("#printbtn").show();
}
</script>
