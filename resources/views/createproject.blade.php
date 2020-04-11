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

.glyphicon:before 
{
  margin-right: 10px;
}


</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>






<div class="box box-primary">


            <div class="box-header with-border">
              <h3 class="box-title">Create Project Group</h3>
            </div>




                        <!-- error messages -->
                        <div >              
                          <div class="btn btn-danger btn-lg btn-block" align="left" id="errors" style = "display: none;"> 
                          </div>
                        </div>




                        
                    <form method="post" role="form" id="form1"  onkeydown = " return event.key != 'Enter' ; " >
                    <div class="box-body">
                        <div class="form-group"><input type="text" id="pt" oninput="javascript:pt_onfocusout(); " onfocusout="pt_onfocusout()" name="pt" placeholder="Enter Project Title" class="form-control"required></div>
                        
                        <div class="form-group" id="guidebranch" style="display: none">
                        <select id="b" name="b" class="form-control" onchange="guidebranch()" required>
                            <option value="" selected>Select Project Guide Branch</option>
                            <option value="Computer">Computer</option>
                            <option value="IT">IT</option>
                            <option value="Civil">Civil</option>
                            <option value="EXTC">EXTC</option>
                            <option value="ETRX">ETRX</option>
                        </select>
                        </div>  

                        <div class="form-group" id="projectguide" style="display: none">
                        <select id="pg" name="pg" class="form-control" onchange="projectguide()" required>
                                <option value="" selected>Select Project Guide</option>
                        </select>
                        </div>

                        <div id="ngmid" class="form-group" style="display: none">
                            <select id="ngm" name="ngm" class="form-control" onchange="ngm_onchange()" required>
                            <option >Select Number Of Group Members</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select></div>

                        <div class="row" id="datar" style="display: none">
                            <div class="col-md-4">
                                <div class="form-group"><input type="text" name="ng1" id="ng1" placeholder="Name of Group Member 1" class="form-control 1"></div>
                                <div class="form-group"><input type="text" name="ng2" id="ng2" placeholder="Name of Group Member 2" class="form-control 2"></div>
                                <div class="form-group"><input type="text" name="ng3" id="ng3" placeholder="Name of Group Member 3" class="form-control 3"></div>
                                <div class="form-group"><input type="text" name="ng4" id="ng4" placeholder="Name of Group Member 4" class="form-control 4"></div>
                            </div>
                           
                            <div class="col-md-4">
                                <div class="form-group"><input type="email" name="eg1" id="eg1" placeholder="Email of Group Member 1" class="form-control 1"></div>
                                <div class="form-group"><input type="email" name="eg2" id="eg2" placeholder="Email of Group Member 2" class="form-control 2"></div>
                                <div class="form-group"><input type="email" name="eg3" id="eg3" placeholder="Email of Group Member 3" class="form-control 3"></div>
                                <div class="form-group"><input type="email" name="eg4" id="eg4" placeholder="Email of Group Member 4" class="form-control 4"></div>
                            </div>
                        </div>

                        
                        <div class="form-group"><input type="password" name="pass" id="pass" placeholder="Password" class="form-control" required ></div>
                        <div class="form-group"><input type="password" name="rpass" id="rpass" placeholder="Confirm Password" class="form-control" required ></div>
                        
                        
                        
                        {{ csrf_field() }}



                        </div>
                            <div class="box-footer"><button type="button" id="create_project" class="btn btn-primary" onclick="verify()"><span class="glyphicon glyphicon-plus" ></span>Create Project</button>
                        </div>


                    </form>

            </div>

                   

@endsection

<script type="text/javascript">


var branch = '<?php echo $user; ?>';
var branchs = JSON.parse(branch);


function pt_onfocusout() 
{

    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();

    if( $("#pt").val()!="" )
    {
        $('#guidebranch').show();
    }
    else
    {
        $('#guidebranch').hide();
        $('#projectguide').hide();
        $('#ngmid').hide();
        $('#datar').hide();

        $("#ngm").empty(); //check
    }
    
}


function guidebranch() 
{
    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();
        
        $('#ngmid').hide();
        $('#datar').hide();

         $("#ngm").empty(); //check


    if( $('#guidebranch option:selected').text() == "Select Project Guide Branch" )
    {
        $('#projectguide').hide();
        $('#ngmid').hide();
        $('#datar').hide();

        $("#ngm").empty(); //check

    }
    else
    {
        $('#projectguide').show();
    }


    $('#pg').empty();
    $('#pg').append("<option value='' selected>Select Project Guide</option>");
    $check=0;

    for (let i = 0; i < branchs.length; i++) 
    {
        if( branchs[i]['branch'] == $('#guidebranch option:selected').val() )
        {
            console.log(branchs[i]['name'] + "   " + branchs[i]['id']);
            //add name to project guide select list
            var name = branchs[i]['name'];
            var id = branchs[i]['id'];
            var option = '<option value="'+id+'" >'+name+'</option>';

            $('#pg').append(option); //project guide insertiion appending

            $check++;

        }

    }
    if($check<1)
    {
        $('#pg').empty();
        $('#pg').append("<option value='' selected>No Project Guide Available Under Branch " + $('#guidebranch option:selected').val() + "</option>");

        $('#ngmid').hide();
        $('#datar').hide();

    }
    

}



function projectguide() 
{

    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();



    if($('#projectguide option:selected').text()== "Select Project Guide"  ||   $('#projectguide option:selected').text().includes("No Project")  )
    {
        $('#ngmid').hide();
        $('#datar').hide();

        $("#ngm").empty(); //check


    }
    else
    {
        $('#ngmid').show();
        
        //this is because if everything is fine but when guide branch is changed and if any guides are not available then number of group members and all data options become visible but if select no of group members and enter member details and then if i select guide branch which has no guides and then if i click correct branck then correct guide name , then number of group members remain same and all entered details remain same
        $("#ngm").empty();
        $("#ngm").append("<option value='' selected>Select Number Of Group Members</option>");
        $("#ngm").append("<option value='1' >1</option>");
        $("#ngm").append("<option value='2' >2</option>");
        $("#ngm").append("<option value='3' >3</option>");
        $("#ngm").append("<option value='4' >4</option>");

    }
}

function ngm_onchange() 
{

    // remaining hide() shoe() methods are included in app.php javascript


    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();



    if($('#ngm option:selected').text() == "Select Number Of Group Members" )
    {
        $("#ng1").val("");
        $("#ng2").val("");
        $("#ng3").val("");
        $("#ng4").val("");

        $("#eg1").val("");
        $("#eg2").val("");
        $("#eg3").val("");
        $("#eg4").val("");
    }


    if( $('#ngm option:selected').val() == 1 )
    {
        $("#ng2").val("");
        $("#ng3").val("");
        $("#ng4").val("");

        $("#eg2").val("");
        $("#eg3").val("");
        $("#eg4").val("");
    }

    if( $('#ngm option:selected').val() == 2 )
    {
        $("#ng3").val("");
        $("#ng4").val("");

        $("#eg3").val("");
        $("#eg4").val("");
    }


    if( $('#ngm option:selected').val() == 3 )
    {
        $("#ng4").val("");

        $("#eg4").val("");
    }




    if($('#ngm option:selected').text() == "Select Number Of Group Members" )
    { 
        $('#datar').hide();
    }
    else
    {
        $('#datar').show();
    }



    

    if(  $('#ngm option:selected').val() == "Select Number Of Group Members"   ) { $('.1').hide(); $('.2').hide(); $('.3').hide(); $('.4').hide(); }
    if(  $('#ngm option:selected').val() == 1   ) {  $('.2').hide(); $('.3').hide(); $('.4').hide();    $('.1').show();  }
    if(  $('#ngm option:selected').val() == 2   ) {  $('.3').hide(); $('.4').hide();    $('.1').show(); $('.2').show();  }
    if(  $('#ngm option:selected').val() == 3   ) {  $('.4').hide();    $('.1').show(); $('.2').show(); $('.3').show();  }
    if(  $('#ngm option:selected').val() == 4   ) {  $('.1').show(); $('.2').show(); $('.3').show(); $('.4').show();  }




}



function verify() 
{
    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();

    $glyphicon = "<br><span class='glyphicon glyphicon-remove'></span>&nbsp;&nbsp;&nbsp;";



    if( $("#pt").val() == "" )
    {  
        $("#errors").append($glyphicon+"Project Title Could Not Be Blank").show();  
    }

    else if( $('#guidebranch option:selected').text() == "Select Project Guide Branch" )
    {
        $("#errors").append($glyphicon+"Select Project Guide Branch").show();  
    }

    else if($('#projectguide option:selected').text()== "Select Project Guide"  ||   $('#projectguide option:selected').text().includes("No Project")  )
    {
        $("#errors").append($glyphicon+"Select Project Guide").show();
    }

    else if($('#ngm option:selected').text() == "Select Number Of Group Members" )
    { 
        $("#errors").append($glyphicon+"Select Number Of Group Members").show(); 
    }
    else
    {

    }


    //now validate all member names and email id's


    if( $('#ngm option:selected').text()==1 )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); }
        else{  checkpassword(); }

         $("html, body").animate({ scrollTop: 0 }, "slow");              

    }


    if( $('#ngm option:selected').text()==2 )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); }

        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() )
        {
            $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show(); 
        }
        else{  checkpassword(); }

         $("html, body").animate({ scrollTop: 0 }, "slow");
    }



    if( $('#ngm option:selected').text()==3 )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); }
        if($("#ng3").val()==""){ $("#errors").append($glyphicon+"Name Of Member 3 Should Not Be Blank").show(); }
        if($("#eg3").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 3 Should Not Be Blank").show(); }


        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() && $("#eg1").val() == $("#eg3").val() && $("#eg2").val() == $("#eg3").val() )
        {  $("#errors").append($glyphicon+"Email ID Of All 3 Group Members Should Be Unique").show();  }
        else if( $("#eg1").val() == $("#eg2").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show(); }
        else if( $("#eg1").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 3 Should Be Unique").show(); }
        else if( $("#eg2").val() == $("#eg3").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 3 Should Be Unique").show(); }

        else{  checkpassword(); }

         $("html, body").animate({ scrollTop: 0 }, "slow");

    }



    if( $('#ngm option:selected').text()==4 )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); }
        if($("#ng3").val()==""){ $("#errors").append($glyphicon+"Name Of Member 3 Should Not Be Blank").show(); }
        if($("#eg4").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 3 Should Not Be Blank").show(); }
        if($("#ng4").val()==""){ $("#errors").append($glyphicon+"Name Of Member 4 Should Not Be Blank").show(); }
        if($("#eg4").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 4 Should Not Be Blank").show(); }


        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() && $("#eg1").val() == $("#eg3").val() && $("#eg1").val() == $("#eg4").val() &&
                $("#eg2").val() == $("#eg3").val() && $("#eg2").val() == $("#eg4").val() && $("#eg3").val() == $("#eg4").val()  )
          
          {  $("#errors").append($glyphicon+"Email ID Of All 4 Group Members Should Be Unique").show();  }



        else if( $("#eg1").val() == $("#eg2").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show(); }
        else if( $("#eg1").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 3 Should Be Unique").show(); }
        else if( $("#eg1").val() == $("#eg4").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 4 Should Be Unique").show(); }

        else if( $("#eg2").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 3 Should Be Unique").show(); }
        else if( $("#eg2").val() == $("#eg4").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 4 Should Be Unique").show(); }
        
        else if( $("#eg3").val() == $("#eg4").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 3 And Member 4 Should Be Unique").show(); }

        else{  checkpassword(); }

        $("html, body").animate({ scrollTop: 0 }, "slow");

        

    }


}//end of verify()




function checkpassword() 
{
        if(   (  $('#rpass').val() == $('#pass').val() ) && ( $('#pass').val()!="" || $('#rpass').val()!="") )
        {            
                
                        document.getElementById("create_project").disabled = true;
                        $("#create_project").html("Please Wait  .   .   .");
                        $('.ajax-loader').css("visibility", "visible");

                        $("#errors").hide();


                           var formData = new FormData($('#form1')[0]);
                           $.ajax({
                              type: "POST",
                              url: "/createproject",
                              data: formData,
                              dataType:"json",
                              cache:false,
                              processData:false,
                              contentType:false,
                              success: function(result) 
                              {                
                                $("#errors").hide();
                                $('.ajax-loader').css("visibility", "hidden");


                                //model for otp 


                                var url="/gid/"+result.groupid;
                                $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
                                $('#link')[0].click();
                                $('#link')[0].remove();
                                
                              },

                              error: function(json) 
                              {

                                  document.getElementById("create_project").disabled = false;
                                  $("#create_project").html("<span class='glyphicon glyphicon-plus' ></span>Create Project");
                                  $('.ajax-loader').css("visibility", "hidden");

                                  $("html, body").animate({ scrollTop: 0 }, "slow");

                                  if(json.status === 422)
                                  { $("#errors").html(json.responseJSON['errors']).show(); }
                                  else 
                                  { $("#errors").hide();  }
                              }

                            });//end of ajax


        }
        else
        {
            $("#errors").append($glyphicon+"Enter Correct Password And Confirm Password").show();
            $("html, body").animate({ scrollTop: 0 }, "slow");
        }



}







</script>
