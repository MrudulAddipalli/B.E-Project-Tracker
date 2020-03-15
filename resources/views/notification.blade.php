@extends('layouts.app')

@section('content')

<div class="box">

<!-- /.box-header -->
<div class="box-body">
  <table class="table table-bordered">
    <tbody>
    <tr>
      <th>Message</th>
    </tr>

    @foreach($not as $n)
    <tr>
      <td>
      @php
      echo $n->message;
      @endphp
      </td>
    </tr>

    
    @endforeach

  </tbody></table>
  <h4></h4>
</div>
<!-- /.box-body -->

</div>

@endsection
