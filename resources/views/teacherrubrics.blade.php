@extends('layouts.app')

@section('content')

<?php 
$comp=0;
$ver=0;
$ong=0;
$all=0;

$smks=0;
foreach ($task as $t) 
{

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

table { width: 100% ; border-collapse:collapse; table-layout:fixed; align-content: center;}
table td {  border:solid 1px #609; width:40%; word-wrap:break-word; } 
th { border:solid 1px #609;  }


td,th,table {
  text-align: center; 
  padding: 10px;
}

td
{
  position: relative;
  font-size: 120%;
}


.score 
{
  border:solid 3px #609; width:80%; word-wrap:break-word; text-align: center; 
  padding: 10px;
  border-radius: 15px 50px;
}

.score2
{
  width: 50px; height:30px ;  border-radius: 15px; border:2px solid #609; text-align: center; 
}


.glyphicon:before { margin-right: 10px; }

</style>


<div class="row"></div>




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

<div class="box-header">
    

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
                  
              </div>

</div>



<div class="box-body">

  <form action="/rubrics/ {{$rubrics->id }} " method="post" id="saveform"  onkeydown="return event.key != 'Enter';"  >

    {{ csrf_field() }}


  <table >
    <tbody>

      <tr>
        <th colspan="4" style="font-size: 35px;">Rubrics</th>
      </tr>

    <tr>
      <td>SEM 7    <input name="id" value=" {{ $rubrics->id }} "  style="display: none;"/>  </td>
      <td>         <input type="text" id="sem7_marks" class="score" readonly="true"  value="{{ $sem7 }} / 50 ">  </input>   </td>
      <td>SEM 8    <input name="project_id" value=" {{ $rubrics->project_id }} "  style="display: none;"/>     </td>
      <td>         <input type="text" id="sem8_marks"  class="score" readonly="true" value="{{ $sem8 }} / 50 ">  </input>   </td>
    </tr>

    <tr>

      <td>Punctuality</td>
      <td><input class="score2" onchange="javascript:change();" id="sem7_P1" name="sem7_P1" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem7_P1 }}"   value= "{{ $rubrics->sem7_P1 }}" required></input></td>

      <td>Punctuality</td>
      <td><input class="score2" onchange="javascript:change();" id="sem8_P1" name="sem8_P1" type="number" min="0" max="10"  placeholder = "{{ $rubrics->sem8_P1 }}"   value= "{{ $rubrics->sem8_P1 }}" required></input></td>

      
    </tr>

    <tr>

      <td>Contribution in Project work</td>
      <td><input class="score2" onchange="javascript:change();" id="sem7_P2" name="sem7_P2" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem7_P2 }}"   value= "{{ $rubrics->sem7_P2 }}" required></input></td>

      <td>Contribution in Project work</td>
      <td><input class="score2" onchange="javascript:change();" id="sem8_P2" name="sem8_P2" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem8_P2 }}"   value= "{{ $rubrics->sem8_P2 }}" required></input></td>

      
    </tr>

    <tr>

      <td>Responsiveness</td>
      <td><input class="score2" onchange="javascript:change();" id="sem7_P3" name="sem7_P3" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem7_P3 }}"   value= "{{ $rubrics->sem7_P3 }}" required></input></td>

      <td>Responsiveness</td>
      <td><input class="score2" onchange="javascript:change();" id="sem8_P3" name="sem8_P3" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem8_P3 }}"   value= "{{ $rubrics->sem8_P3 }}" required></input></td>

      
    </tr>

    <tr>

      <td>Project Domain Knowledge <br>And Project Understanding </td>
      <td><input class="score2" onchange="javascript:change();" id="sem7_P4" name="sem7_P4" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem7_P4 }}"   value= "{{ $rubrics->sem7_P4 }}" required></input></td>

      <td>Participation in project<br>competition and Paper<br>publication </td>
      <td><input class="score2" onchange="javascript:change();" id="sem8_P4" name="sem8_P4" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem8_P4 }}"   value= "{{ $rubrics->sem8_P4 }}" required></input></td>

      
    </tr>

    <tr>

      <td>Contribution in Team Work</td>
      <td><input class="score2" onchange="javascript:change();" id="sem7_P5" name="sem7_P5" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem7_P5 }}"   value= "{{ $rubrics->sem7_P5 }}" required></input></td>

      <td>Quality Of Thesis Writing And<br>Individual Contribution In It</td>
      <td><input class="score2" onchange="javascript:change();" id="sem8_P5" name="sem8_P5" type="number" min="0" max="10" placeholder = "{{ $rubrics->sem8_P5 }}"   value= "{{ $rubrics->sem8_P5 }}" required></input></td>

      
    </tr>


    <tr class="hide1">
      <th colspan="4"> <button type="submit" class="btn btn-success btn-lg btn-block" style="background-color: #8A2BE2;" onsubmit="save()"> Save </button>  </th>
    </tr>


  </tbody></table>

</form>


<br><br>
  
</div>

</div>

@endsection

<script type="text/javascript">



function view7() {$('body').append('<a id="link" href="/SEM7" target="_blank" >&nbsp;</a>');$('#link')[0].click();  $('#link')[0].remove();  };
function view8() {$('body').append('<a id="link" href="/SEM8" target="_blank" >&nbsp;</a>');$('#link')[0].click();  $('#link')[0].remove();   };

$Sem7=0;
$Sem8=0;

function change() 
{

 /* if( !isNaN(  $('#sem7_P1').val()  )  )  {     }
  var numberValue = Number(stringToConvert);*/

    Sem7 =(Number($('#sem7_P1').val())+Number($('#sem7_P2').val())+Number($('#sem7_P3').val())+Number($('#sem7_P4').val())+Number($('#sem7_P5').val()));
    Sem8=(Number($('#sem8_P1').val())+Number($('#sem8_P2').val())+Number($('#sem8_P3').val())+Number($('#sem8_P4').val())+Number($('#sem8_P5').val()));

    Sem7 = Sem7 + " / 50";
    Sem8 = Sem8 + " / 50";

    $('#sem7_marks').val(Sem7);
    $('#sem8_marks').val(Sem8);

};


function myFunction() 
{

  $(".hide1").hide();

  window.print();

  $(".hide1").show();

};


</script>
