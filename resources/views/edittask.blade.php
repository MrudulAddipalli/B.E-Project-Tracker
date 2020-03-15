@extends('layouts.app')

@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Edit Task</h3>
            </div>
            <form action="/edittask" method="post" role="form">
            <div class="form-group">
                <input class="form-control" type="text" name="detail" placeholder="Details" value="{{ $task->detail }}">
                <input id="doc" value="2017-06-01" class="form-control" type="date" name="doc" placeholder="Date of Completion">
                <input type="hidden" name="pid" value="{{ $task->project }}">
                <input type="hidden" name="tid" value="{{ $task->id }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-primary" value="Edit Task">
            </div>
        </form>
</div>

@endsection
