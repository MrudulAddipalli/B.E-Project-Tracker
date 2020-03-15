@extends('layouts.app')

@section('content')

<div class="box">
<div class="box-header with-border">
  <h3 class="box-title">All Projects</h3>
  <div class="pull-right">
    <a class="btn btn-primary" data-toggle="modal" data-target="#notmodal">Bulk Send Notification</a> <a class="btn btn-primary" data-toggle="modal" data-target="#myModal">Bulk Task Create</a>
  </div>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 10px">UID</th>
      <th>Project Title</th>
      <th>Task List</th>
      <th>Statistics</th>
      <th>Reports</th>
    </tr>

    @foreach($project as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->project_title }}</td>
      <td><a href="{{ url('/') }}/task/{{ $p->id }}" >Task</a></td>
      <td><a href="{{ url('/') }}/stat/{{ $p->id }}" >Statistics</a></td>
      <td><a href="{{ url('/') }}/report/{{ $p->id }}" >Report</a></td>
    </tr>
    @endforeach
  </tbody></table>
</div>
<!-- /.box-body -->
</div>



<!-- Modal -->
<div class="modal fade" id="notmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Send Message</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="/sendnotificationall" method="post">

          <input type="text" placeholder="Message" class="form-control" name="message">
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
        <form action="/createtaskbulk" method="post">
            <div class="form-group">
                <input class="form-control" type="text" name="detail" placeholder="Details">
                <br>
                <label>Date of Submission</label>
                <input id="doc" value="2018-10-26" class="form-control" type="date" name="doc" placeholder="Date of Completion">

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



@endsection
