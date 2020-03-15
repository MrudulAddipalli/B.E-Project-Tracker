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

  <a class="btn btn-primary" href="?">All Task</a>
  <a class="btn btn-default" href="?filter=0">On Going</a>
  <a class="btn btn-default" href="?filter=1">Verfying</a>
  <a class="btn btn-default" href="?filter=2">Completed</a>
  <a class="btn btn-default" href="?filter=3">Delyed</a>
  <a class="btn btn-default" href="?filter=4">Late Completed</a>

</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th>Detail</th>
      <th>Date of Assignment</th>
      <th>Date of Completion</th>
      <th>Status</th>
      <th>Marks</th>
      <th>Action</th>
    </tr>

    @foreach($task as $t)
    <tr>
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
      @if($t->status==0 || $t->status==3)
      <a href="/verify/{{ $t->id }}" class="btn btn-primary">Submit</a>
      @endif
      </td>
    </tr>
    @endforeach
  </tbody></table>
</div>
<!-- /.box-body -->

</div>
@endsection
