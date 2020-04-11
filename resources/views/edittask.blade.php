@extends('layouts.app')

@section('content')




<style type="text/css">
    
.ajax-loader {
  
    visibility: hidden;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    z-index: 9999999 !important;


}

.ajax-loader img {
  position: relative;
  top:50%;
  left:50%;
}


.glyphicon:before {
  margin-right: 10px;
}


</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<div class="box box-primary">


            <div class="box-header">Edit Task

                <br><hr>


                                    



                <form action="/edittask" method="post" id="form1"  onkeydown = " return event.key != 'Enter' ; " >

                        
                        <div class="form-group col-md-9">

                            <input class="form-control col-md-9" type="text" name="detail" id="detail" value="{{ $task->detail }}" size="50"  required>
                            <br><br><br>
                            <input id="doc" class="form-control col-md-9" type="date" id="doc" name="doc" value="{{ $task->doc }}" required>
                            <br><br>
                            <input type="hidden" name="pid" value="{{ $task->project }}">
                            <input type="hidden" name="tid" value="{{ $task->id }}">
                            {{ csrf_field() }}
                            <br><br>

                            <!-- error messages -->
                                    <div >              
                                      <div class="btn btn-danger col-md-3" align="left" id="errors" style = "display: none;"> 
                                      </div>
                                    </div>

                            <br><br>

                            <button type="button" class="btn btn-primary" onclick="check()" id="edit"> <span class="glyphicon glyphicon-pencil"></span>Edit task</button>
                            <br><br>


                        </div>
                </form>

            </div>

</div>

@endsection


<script type="text/javascript">
    
    function check() 
    {

        $("#errors").hide();
        $("#errors").empty();

        if( $("#detail").val()=="")
        {
            $('#errors').append("Enter Task Details").show();
        }
        else
        {

            r=confirm("Are You Sure ?\nYou Want To Edit This Task");
            if(r===true)
            {
                document.getElementById("edit").disabled = true;
                $("#edit").html("Please Wait  .   .   .");
                $('.ajax-loader').css("visibility", "visible");
                document.getElementById("form1").submit();
            }

            
        }

    }


</script>
