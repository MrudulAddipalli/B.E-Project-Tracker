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
$pr = round($pr,2);
}
?>
<div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Task</span>
              <span class="info-box-number">{{ $all }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Completed</span>
              <span class="info-box-number">{{$comp}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Verfying</span>
              <span class="info-box-number">{{$ver}}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">OnGoing</span>
              <span class="info-box-number">{{ $ong }}</span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>



<div class="box">
<div class="box-header with-border">

  <!-- Trigger the modal with a button -->
  <a class="btn btn-primary" href="?">All Task</a>
  <a class="btn btn-default" href="?filter=0">On Going</a>
  <a class="btn btn-default" href="?filter=1">Verfying</a>
  <a class="btn btn-default" href="?filter=2">Completed</a>
  <a class="btn btn-default" href="?filter=3">Delyed</a>
  <a class="btn btn-default" href="?filter=4">Late Completed</a>
<button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target="#myModal">Add New Task</button>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 50px">Task ID</th>
      <th>Detail</th>
      <th>Date of Assignment</th>
      <th>Date of Submission</th>
      <th>Status</th>
      <th>Remark</th>
      <th>Action</th>
    </tr>

    @foreach($task as $t)
    <tr>
      <td>{{ $t->id }}</td>
      <td>{{ $t->detail }}</td>
      <td>{{ $t->doa }}</td>
      <td>{{ $t->doc }}</td>
      <td>
      @if($t->status==0)
      On Going
      @elseif($t->status==1)
      Verifying
      @elseif($t->status==2)
      Completed
      @elseif($t->status==3)
      Delyed
      @elseif($t->status==4)
      Late Completed
      @endif
      </td>
      <td>{{ $t->marks }}</td>

      <td>
          <a class="btn btn-warning" href="/taskedit/{{ $t->id }}">Edit</a>
          @if($t->status==1)
          <a class="btn btn-success" data-toggle="modal" data-target="#exampleModal" data-book-id="{{ $t->id }}">Remark</a>
          @endif
          <a class="btn btn-danger" href="/taskremove/{{ $t->id }}">Remove</a>
      </td>
    </tr>

    
    @endforeach

  </tbody></table>
  <h4>Performance Rate: {{ $pr }}%</h4>
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
                <br>
                <label>Date of Submission</label>
                <input id="doc" value="2018-10-26" class="form-control" type="date" name="doc" placeholder="Date of Completion">

                <input type="hidden" name="pid" value="{{ $pid }}">
                {{ csrf_field() }}
                <br>
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
        <form action="/taskremark/{{ $pid }}" method="post">

        <br>

          <input type="number" min="1" max="10" class="form-control" name="mk" placeholder="Enter Marks Out of 10">
          <input type="hidden" value="" name="pId" id="ppid">
          <br>
          <input type="text" placeholder="Good,Bad" class="form-control" name="rev">
          <br>
          <input type="submit" name="" value="Save changes" class="btn btn-primary" >
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
