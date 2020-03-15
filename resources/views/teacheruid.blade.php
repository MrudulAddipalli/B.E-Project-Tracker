@extends('layouts.app')

@section('content')
<div class="box">
<div class="box-header with-border">
  <h3 class="box-title">All Projects</h3>
</div>
<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody><tr>
      <th style="width: 10px">UID</th>
      <th>Project Title</th>
      <th>Group Member</th>
      <th>Email</th>
    </tr>

    @foreach($project as $p)
    <tr>
      <td>{{ $p->id }}</td>
      <td>{{ $p->project_title }}</td>
      <td>
      {{ $p->name_gm1 }}<br>
      {{ $p->name_gm2 }}<br>
      {{ $p->name_gm3 }}
      </td>
      <td>
      {{ $p->email_gm1 }}<br>
      {{ $p->email_gm2 }}<br>
      {{ $p->email_gm3 }}
      </td>

    </tr>
    @endforeach
  </tbody></table>
</div>
<!-- /.box-body -->
</div>
@endsection
