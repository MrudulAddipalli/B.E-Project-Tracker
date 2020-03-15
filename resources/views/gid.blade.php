@extends('layouts.app')

@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Your Group ID</h3>
            </div>
            <h1 class="text-center">{{ $groupid }}</h1>
            <a class="btn btn-primary text-center" href="/login">Go Back</a>

</div>

@endsection
