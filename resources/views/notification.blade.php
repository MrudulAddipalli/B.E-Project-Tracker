@extends('layouts.app')

@section('content')

<style type="text/css">
  
.glyphicon:before {
  margin-right: 5px;
}

table {
  border-collapse:collapse; table-layout:fixed; width:310px;
}


table td{
  border:solid 1px #fab; width:100px; word-wrap:break-word;
} 

</style>




<div class="box">

<div class="box-header with-border">
  <br>

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



<div class="box">

<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody>
    
    <tr>
      <th style="width: 10%">ID</th>
      <th style="width: 70%">Message</th>
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

    </tr>    

    @endforeach

  </tbody></table>

  <hr><br>

  <h4></h4>
</div>
<!-- /.box-body -->

</div>

@endsection

<script type="text/javascript">


function myFunction() 
{

  $("#per_rate").addClass("btn-lg btn-block");
  $(".hide1").hide();

  window.print();

  $(".hide1").show();
  $("#per_rate").removeClass("btn-lg btn-block");

}


</script>