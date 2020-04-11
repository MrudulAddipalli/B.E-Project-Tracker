@extends('layouts.app')

@section('content')

<div class="box box-primary">

	
            <div class="box-header with-border">
              <h3 class="box-title">Your Project UID For Login</h3>
            </div>
            <h1 class="text-center">{{ $groupid }}</h1>
            <center><a class="btn btn-primary text-center" href="/login">Login</a></center>
            <br><br>

</div>

@endsection
