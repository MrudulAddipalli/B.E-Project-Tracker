@extends('layouts.app')

@section('content')



<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/Ionicons/css/ionicons.min.css">



<style type="text/css">

table { width: 100% ; border-collapse:collapse; table-layout:fixed; align-content: center;}
table td {  border:solid 1px #D8D8D4; width:40%; word-wrap:break-word; } 
th { border:solid 1px #D8D8D4;  }


td,th,table {
  text-align: center; 
  padding: 10px;
}

td
{
  position: relative;
  font-size: 100%;
}


.score 
{
  border:solid 3px #D8D8D4; width:20%; word-wrap:break-word; text-align: center; 
  padding: 10px;
  margin: 20px;
  border-radius: 10px 10px;
}


.glyphicon:before { margin-right: 10px; }

</style>



<div class="box">

<div class="box-header">
    
<!-- 
    <button type="button" class="btn btn-warning pull-center hide1 " onclick="myFunction()"  style="align-self: left !important; "> 
      <span class="glyphicon glyphicon-print"></span>Print
    </button>


              <div align="center" >

                  <button type="button" class="btn btn-success hide1 " id="7" style="padding: 10px; margin: 10px; " onclick="view7();" > 
                    <span class="glyphicon glyphicon-open-eye"></span>SEM 7 Rubrics Format
                  </button>


                  <button type="button" class="btn btn-success hide1 " id="8" style="padding: 10px; margin: 10px; " onclick="view8();" > 
                    <span class="glyphicon glyphicon-open-eye"></span>SEM 8 Rubrics Format
                  </button>
                  
              </div> -->

</div>



<div class="box-body">

  <form action="/adminkey" method="post" id="saveform"  onkeydown="return event.key != 'Enter';"  >

    {{ csrf_field() }}

  <table >
   
    <tbody>

      <tr>
        <th> Current System Access Key - [ {{ $key }} ]</th>
      </tr>

      <tr>
        <td> 
          <label>New Access Key</label>
          <input type="number" id="new_key" name="new_key" class="score" required="true" pattern="[0-9]*" oninput="javascript: if (this.value.length > 4) this.value = this.value.slice(0, 4);" />
          <button type="submit" class="btn btn-info" > Enter System Accesss Key </button>
        </td>
      </tr>

      <tr>
        <td>
          <button type="button" class="btn btn-warning" onclick="Generate()">Generate Random Key</button>
        </td>
      </tr>

  </tbody>

</table>

</form>


<br><br>
  
</div>

</div>

@endsection

<script type="text/javascript">

function Generate() 
{
   var key = (  Math.floor( 1000 + Math.random() * 9000 )  ); 
   $('#new_key').val( key );
};



</script>