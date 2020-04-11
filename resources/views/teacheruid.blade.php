@extends('layouts.app')

@section('content')



<style type="text/css">
.glyphicon:before 
{
  margin-right: 10px;
}
</style>


<div class="box">
<div class="box-header with-border">
  <h3 class="box-title">All Projects</h3>
</div>
<!-- /.box-header -->



<div class="box-body">
  <table class="table table-bordered" style='font-size:18px' >
    <tbody><tr>
      <th style="width: 10px">UID</th>
      <th>Project Title</th>
      <th>Group Member(s) Name</th>
      <th>Group Member(s) Email</th>
      <th>Status</th>
    </tr>

    @foreach($project as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td> {{ $p->project_title }} </td>
      <td>

                @if($p->name_gm1!="")
                {{ $p->name_gm1 }}<br>
                @endif

                @if($p->name_gm2!="")
                {{ $p->name_gm2}}<br>
                @endif

                @if($p->name_gm3!="")
                {{ $p->name_gm3 }}<br>
                @endif

                @if($p->name_gm4!="")
                {{ $p->name_gm4 }}
                @endif

      </td>



      <td>

                @if($p->email_gm1!="")
                {{ $p->email_gm1 }}<br>
                @endif

                @if($p->email_gm2!="")
                {{ $p->email_gm2 }}<br>
                @endif

                @if($p->email_gm3!="")
                {{ $p->email_gm3 }}<br>
                @endif
                
                @if($p->email_gm4!="")
                {{ $p->email_gm4 }}
                @endif

      </td>



      <td>
          @if($p->act == 0)
          <button onclick="approveproject( {{ $p->id }} )" class="btn btn-success"> <span class="glyphicon glyphicon-ok"></span>Approve Project Group </button>
          @else
          <button onclick="rejectproject( {{ $p->id }} )" class="btn btn-danger"> <span class="glyphicon glyphicon-trash"></span>Reject Project Group </button>
          @endif
      </td>



    </tr>
    @endforeach
   </tbody>
  </table>
</div>
<!-- /.box-body -->
</div>
@endsection


<script type="text/javascript">



function approveproject(x) 
{
  var r = confirm("Are You Sure ?\nYou Want To Approve Project Group With ID "+x);
  if (r == true) 
  {
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
    var url="/rejectproject/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();
  }
  return false;
}



</script>