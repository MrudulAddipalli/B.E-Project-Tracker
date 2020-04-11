@extends('layouts.app')

@section('content')


<style type="text/css">
    
.glyphicon:before 
{
  margin-right: 10px;
}


</style>


<div class="container">
    <div class="row">
    <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail OR UID</label>

                            <div class="col-md-6">
                                <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <br>
                        <div>
                            <div >
                               
                               <center>

                                    <a href="/reset" class="btn btn-dark">
                                        Forgot Password?
                                    </a>

                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                                    <button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-log-in"></span>Login
                                    </button>

                               </center>
                                
                               
                            </div>
                        </div>

                    </form>

                    <hr>
                    <center>
                        <a class="btn btn-primary" href="{{ url('/') }}/createproject">Project Group Registration</a>
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <a class="btn btn-info" href="{{ url('/') }}/register">Project Guide Registration</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
@endsection
