@extends('layouts.app')

@section('content')

<div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Submit Access Key</h3>
            </div>
            <?php 

            if (isset($_GET['err'])) {
                echo $_GET['err'];
            }
            ?>
                    <form method="post" action="/submitaccess" role="form">

                        <div class="form-group"><input type="password" name="ack" placeholder="Password" class="form-control"></div>

                        {{ csrf_field() }}
                        </div>
                        <div class="box-footer"><button type="submit" class="btn btn-primary" name="">Submit</button></div>
                    </form>
                    </div>

@endsection
