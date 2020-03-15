@extends('layouts.app')

@section('content')

<div class="box box-primary">

<?php 

if (isset($_GET['err'])) {
    ?>

    <div class="alert alert-danger" role="alert">
  <?php echo $_GET['err']; ?>
</div>

    <?php
}

?>
            <div class="box-header with-border">
              <h3 class="box-title">Create Project Group</h3>
            </div>
                    <form method="post" action="/createproject" role="form">
                    <div class="box-body">
                        <div class="form-group"><input type="text" name="pt" placeholder="Project Title" class="form-control"></div>
                        <div class="form-group">
                        <select name="b" class="form-control" >
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select>
                        </div>                        
                        <div class="form-group">
                        <select name="pg" class="form-control">
                            @foreach($user as $u)
                                <option value="{{ $u->id }}">{{ $u->name }}</option>
                            @endforeach
                        </select></div>
                        <div id="ngm" class="form-group"><select name="ngm" class="form-control" >
                            <option>0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select></div>

                        <div class="row" id="datar">
                            <div class="col-md-4">
                                <div class="form-group"><input type="text" name="ng1" id="ng1" placeholder="Name of Group Member 1" class="form-control"></div>
                                <div class="form-group"><input type="text" name="ng2" id="ng2" placeholder="Name of Group Member 2" class="form-control"></div>
                                <div class="form-group"><input type="text" name="ng3" id="ng3" placeholder="Name of Group Member 3" class="form-control"></div>
                                <div class="form-group"><input type="text" name="ng4" id="ng4" placeholder="Name of Group Member 4" class="form-control"></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                <select name="bg1" id="bg1" class="form-control" >
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select>
                        </div>
                                <div class="form-group">
                                <select name="bg2" id="bg2" class="form-control" >
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select>
                        </div>
                                <div class="form-group"><select name="bg3" id="bg3" class="form-control" >
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select></div>
                        <div class="form-group"><select name="bg4" id="bg4" class="form-control" >
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select></div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group"><input type="email" name="eg1" id="eg1" placeholder="Email of Group Member 1" class="form-control"></div>
                                <div class="form-group"><input type="email" name="eg2" id="eg2" placeholder="Email of Group Member 2" class="form-control"></div>
                                <div class="form-group"><input type="email" name="eg3" id="eg3" placeholder="Email of Group Member 3" class="form-control"></div>
                                <div class="form-group"><input type="email" name="eg4" id="eg4" placeholder="Email of Group Member 4" class="form-control"></div>
                            </div>
                        </div>
                        <div class="form-group"><input type="password" name="pass" placeholder="Password" class="form-control"></div>
                        <div class="form-group"><input type="password" name="rpass" placeholder="Repeat Password" class="form-control"></div>
                        
                        
                        
                        {{ csrf_field() }}
                        </div>
                        <div class="box-footer"><button type="submit" class="btn btn-primary" name="">Create Project</button></div>
                    </form>
                    </div>

                   

@endsection
