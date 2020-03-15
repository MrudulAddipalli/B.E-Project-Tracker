@extends('layouts.app')

@section('content')

<?php 
$comp=0;
$ver=0;
$ong=0;
$all=0;
foreach ($task as $t) {

  if ($t->status==1) {
    $ver=$ver+1;
  }
  if ($t->status==2) {
    $comp=$comp+1;
  }
  if ($t->status==0) {
    $ong=$ong+1;
  }
  $all = $all+1;
}

?>
<div class="row">
        


<div class="box">
<div class="box-header with-border">

</div>
<!-- /.box-header -->
<div class="box-body">
<button onclick="myFunction()">Print</button>

<script>
function myFunction() {
  window.print();
}
</script>

  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 50px">Task ID</th>
      <th>Marks</th>
      <th>Remark</th>

    </tr>

    @foreach($task as $t)
    <tr>
      <td>{{ $t->id }}</td>
      <td>{{ $t->marks }}

      <br>

      @for($i=1; $i<=$t->marks;$i++)
      <i style="color:#ff9404;" class="fa fa-star"></i>
      @endfor

      </td>
      <td>{{ $t->remark }}</td>
    
    </tr>
    @endforeach
  </tbody></table>
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
        <form action="/createtask" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="detail" placeholder="Details">
                <input value="2018-10-26" class="form-control" type="date" name="doc" placeholder="Date of Completion">
                <input type="hidden" name="pid" value="{{ $pid }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="Create Task">
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
        <form action="/taskremove/{{ $t->id }}" method="get">

        <br>

          <input type="number" min="1" max="10" class="form-control" name="" placeholder="Marks">
          <br>
          <input type="text" placeholder="Remark" class="form-control" name="">
          <br>
          <input type="submit" name="" value="Save changes" class="btn btn-primary" >

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
