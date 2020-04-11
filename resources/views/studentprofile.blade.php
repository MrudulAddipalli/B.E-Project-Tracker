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
  top:40%;
  left:40%;
  display: block;
}


.glyphicon:before {
  margin-right: 10px;
}


</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>






<div class="box box-primary">


            <div class="box-header with-border">
              <h3 class="box-title">Project Edit</h3>
            </div>

                        

                        <div >              
                          <div class="btn btn-danger btn-lg btn-block" align="left" id="errors" style = "display: none;"> 
                          </div>
                        </div>



                    <form method="post" role="form" id="edit"  onkeydown="return event.key != 'Enter';" >
                    <div class="box-body">

                    
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Project Title</label>
                             <div class="col-md-8">
                                <input type="text" id="pt" name="pt" value="{{ $user['project_title'] }}" class="form-control" required focus>
                            </div>
                        </div>


                        {{ csrf_field() }}


                        <br><br>
                        
                        <div class="form-group" id="guidebranch" >
                            <label for="name" class="col-md-4 control-label">Project Guide Branch</label>
                             <div class="col-md-4">
                                <input type="text" value="{{ $user['branch'] }}" class="form-control" id="visible_branch" readonly>
                             </div>
                            

                            <div class="col-md-4">
                                <select id="b" name="b" class="form-control" onchange="guidebranch()" >
                                    <option selected>Change Project Guide Branch</option>
                                    <option value="No Changes">No Changes</option>
                                    <option value="Computer">Change Project Guide Branch To Computer</option>
                                    <option value="IT">Change Project Guide Branch To IT</option>
                                    <option value="Civil">Change Project Guide Branch To Civil</option>
                                    <option value="EXTC">Change Project Guide Branch To EXTC</option>
                                    <option value="ETRX">Change Project Guide Branch To ETRX</option>
                                </select>
                            </div>

                        </div>  

                        <br><br>


                        <div class="form-group" id="guidename">
                            <label for="name" class="col-md-4 control-label">Project Guide Name</label>
                                
                                <div class="col-md-4">
                                    <input type="text" text="{{ $user['project_guide'] }}" value ="{{ $guide }}" class="form-control" id="visible_pg" readonly>
                                </div>
                                
                                <div class="col-md-4">
                                    <select id="pg" name="pg" class="form-control" onchange="projectguide()" style="display: none;">
                                    </select>
                                </div>
                        </div>


                         <div class="form-group">
                             <div class="col-md-8">
                                <input type="hidden" id="nog" name="nog" value="{{ $user['nog'] }}" class="form-control" required focus>
                            </div>
                         </div>

                        

                        <br class="brx"><br>


                        <!-- edit all -->

                        <button class="btn btn-primary" id="new_members_btn" onclick="members();return false;"> <span class="glyphicon glyphicon-pencil" ></span> 
                            Change Group Members</button>
                        <div class="new_member"></div>

                        <!-- end of edit all -->


                        <br>


                        <div class="row  previous_member_details" id="datar">
                            <div class="col-md-6">

                                @if($user['name_gm1'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 1 Name</label>
                                <div class="form-group"><input type="text" name="ng1" id="ng1" value="{{ $user['name_gm1'] }}" class="form-control"></div>
                                @endif
                                @if($user['name_gm2'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 2 Name</label>
                                <div class="form-group"><input type="text" name="ng2" id="ng2" value="{{ $user['name_gm2'] }}" class="form-control"></div>
                                @endif
                                @if($user['name_gm3'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 3 Name</label>
                                <div class="form-group"><input type="text" name="ng3" id="ng3" value="{{ $user['name_gm3'] }}" class="form-control"></div>
                                @endif
                                @if($user['name_gm4'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 4 Name</label>
                                <div class="form-group"><input type="text" name="ng4" id="ng4" value="{{ $user['name_gm4'] }}" class="form-control"></div>
                                @endif

                            </div>
                           
                            <div class="col-md-6">

                                @if($user['email_gm1'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 1 Email</label>
                                <div class="form-group"><input type="email" name="eg1" id="eg1" value="{{ $user['email_gm1']  }}" class="form-control"></div>
                                @endif
                                @if($user['email_gm2'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 2 Email</label>
                                <div class="form-group"><input type="email" name="eg2" id="eg2" value="{{ $user['email_gm2']  }}" class="form-control"></div>
                                @endif
                                @if($user['email_gm3'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 3 Email</label>
                                <div class="form-group"><input type="email" name="eg3" id="eg3" value="{{ $user['email_gm3']  }}" class="form-control"></div>
                                @endif
                                @if($user['email_gm4'] !="")
                                <label for="name" class="col-md-6 control-label">Group Member 4 Email</label>
                                <div class="form-group"><input type="email" name="eg4" id="eg4" value="{{ $user['email_gm4']  }}" class="form-control"></div>
                                @endif

                            </div>
                        </div>



                        <hr>

                        <center>
                            <div class="btn btn-warning ">
                                <span class="glyphicon glyphicon-hand-right" ></span>  
                                If you want to change the password then use the below password fields else leave them blank .
                                <span class="glyphicon glyphicon-hand-left" ></span>  
                            </div>
                        </center>


                        <hr>

                         


                        <table style="width: 100%">
                            <tr>
                                <td style="width: 60%">

                                     <div class="col-md-5">
                                            <label for="name" class="col-md-8 control-label">New Password</label>
                                        </div>
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <input id="pass" type="password" class="form-control" name="pass" required>
                                        </div>
                                    </div>
                                
                                    <br><br>
                                    
                                    <div class="col-md-5">
                                        <label for="password-confirm" class="col-md-8 control-label">Confirm New Password</label>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-5">
                                            <input id="rpass" type="password" class="form-control" name="rpass" required>
                                        </div>
                                    </div>

                                </td>

                                <td style="width: 30%">

                                     <div>
                                        <center>
                                            <button type="button" id="create_project" class="btn btn-info btn-lg" onclick="verify()">  
                                                <h4>
                                                    <span class="glyphicon glyphicon-hdd" ></span>Save Changes
                                                </h4>
                                            </button>
                                        </center>
                                    </div>

                                </td>
                            </tr>
                        </table>

                    </form>


                    <br><br>

            </div>

                   

@endsection

<script type="text/javascript">


var branch = '<?php echo $all_guides; ?>';
console.log(branchs);
var branchs = JSON.parse(branch);
console.log(branchs);

var nop = '<?php echo $user->nog; ?>';

var original_guide_branch = '<?php echo $user->branch; ?>'; 
var original_guide_name = '<?php echo $guide; ?>'; 
var original_guide_id = '<?php echo $user->project_guide; ?>'; 

console.log("1 "+original_guide_branch+" 2 "+original_guide_name+" 3 "+original_guide_id);


members_click=0;

error_found=false;


$glyphicon = "<br><span class='glyphicon glyphicon-remove'></span>";


function guidebranch() 
{
    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();

    if( $('#guidebranch option:selected').text() == "Change Project Guide Branch" ||  $('#guidebranch option:selected').text() == "No Changes" )
    {  
        $('#pg').empty();
        $('#pg').hide();  
    } 
    else 
    {  
        $('#pg').show();    
    }


    $('#pg').empty();
    $('#pg').append("<option selected='true'>Change Project Guide</option> ");

    $check=0;

    for (let i = 0; i < branchs.length; i++) 
    {
        if( branchs[i]['branch'] == $('#guidebranch option:selected').val() )
        {
            var name = branchs[i]['name'];
            var id = branchs[i]['id'];
            var option = '<option value="'+id+'" >'+name+'</option>';
            $('#pg').append(option);
            $check++;
        }
    }

    if($check<1)
    {
        $('#pg').empty();
        $('#pg').append("<option selected>No Project Guide Available Under Branch " + $('#guidebranch option:selected').val() + "</option>");
    }
    

}



function projectguide() 
{
    //errors should not be visible if something is changed
    $("#errors").empty();
    $("#errors").hide();

    
    if(  ( $('#b option:selected').text().includes("Change Project Guide Branch") ||  $('#b option:selected').text() == "No Changes" ) && ( $('#pg option:selected').text() == "Change Project Guide"  || $('#pg option:selected').text().includes("No Project Guid") ) )
    { 
        
    }
    else
    {
        alert(" You Will Be Tagged To Guide : "+$('#pg option:selected').text()+"  Guide Branch : "+$('#guidebranch option:selected').val());
    }

}



function verify() 
{
    

    error_found=false;


    $("#errors").empty(); $("#errors").hide();

    

    if( $("#ngm").val() == "")
    {  
        if( members_click!=0 ) {  $("#errors").append($glyphicon+"Select Number Of Group Members. ").show(); error_found=true; }

    }
    else
    {
        nop = $("#ngm").val();
    }


    if( nop==1 &&  $("#ngm").val()!=""  )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); error_found=true; }

    }


    if( nop==2 &&  $("#ngm").val()!=""  )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); error_found=true; }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); error_found=true; }

        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() )
        {
            $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show();  error_found=true;
        }

    }




    if( nop==3 &&  $("#ngm").val()!=""  )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); error_found=true; }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); error_found=true; }
        if($("#ng3").val()==""){ $("#errors").append($glyphicon+"Name Of Member 3 Should Not Be Blank").show(); error_found=true; }
        if($("#eg3").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 3 Should Not Be Blank").show(); error_found=true; }


        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() && $("#eg1").val() == $("#eg3").val() && $("#eg2").val() == $("#eg3").val() )
        {  $("#errors").append($glyphicon+"Email ID Of All 3 Group Members Should Be Unique").show(); error_found=true;  }

        else if( $("#eg1").val() == $("#eg2").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show(); error_found=true; }
        else if( $("#eg1").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 3 Should Be Unique").show(); error_found=true; }
        else if( $("#eg2").val() == $("#eg3").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 3 Should Be Unique").show(); error_found=true; }

    }



    if( nop==4 &&  $("#ngm").val()!=""  )
    {

        if($("#ng1").val()==""){ $("#errors").append($glyphicon+"Name Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#eg1").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 1 Should Not Be Blank").show(); error_found=true; }
        if($("#ng2").val()==""){ $("#errors").append($glyphicon+"Name Of Member 2 Should Not Be Blank").show(); error_found=true; }
        if($("#eg2").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 2 Should Not Be Blank").show(); error_found=true; }
        if($("#ng3").val()==""){ $("#errors").append($glyphicon+"Name Of Member 3 Should Not Be Blank").show(); error_found=true; }
        if($("#eg4").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 3 Should Not Be Blank").show(); error_found=true; }
        if($("#ng4").val()==""){ $("#errors").append($glyphicon+"Name Of Member 4 Should Not Be Blank").show(); error_found=true; }
        if($("#eg4").val()==""){ $("#errors").append($glyphicon+"Email ID Of Member 4 Should Not Be Blank").show(); error_found=true; }


        //till here all empty fields validations are done

        if( $("#eg1").val() == $("#eg2").val() && $("#eg1").val() == $("#eg3").val() && $("#eg1").val() == $("#eg4").val() &&
                $("#eg2").val() == $("#eg3").val() && $("#eg2").val() == $("#eg4").val() && $("#eg3").val() == $("#eg4").val()  )
          
          {  $("#errors").append($glyphicon+"Email ID Of All 4 Group Members Should Be Unique").show(); error_found=true;  }



        else if( $("#eg1").val() == $("#eg2").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 2 Should Be Unique").show(); error_found=true; }
        else if( $("#eg1").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 3 Should Be Unique").show(); error_found=true; }
        else if( $("#eg1").val() == $("#eg4").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 1 And Member 4 Should Be Unique").show(); error_found=true; }

        else if( $("#eg2").val() == $("#eg3").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 3 Should Be Unique").show(); error_found=true; }
        else if( $("#eg2").val() == $("#eg4").val() ) { $("#errors").append($glyphicon+"Email ID Of Group Member 2 And Member 4 Should Be Unique").show(); error_found=true; }
        
        else if( $("#eg3").val() == $("#eg4").val() ) {  $("#errors").append($glyphicon+"Email ID Of Group Member 3 And Member 4 Should Be Unique").show();error_found=true; }


    }


    if( $('#rpass').val() != $('#pass').val() ) 
    { 
        $("#errors").append($glyphicon+"Password And Confirm Password Does Not Match").show(); error_found=true; 
    } 



    verify2(error_found);


}//end of verify()



$real_pg=0 ;  //for project guide id [pg] passing 





function verify2(error_found) 
{

    /*else
    {
        r=confirm
    }

    r // r is accessable here but

    else
    {
        if() { r=confirm }
    }

    r // r is not accessable here but    so for ajax call if(r==true)  we are declaring r outside*/

    r=false;
    r2=false;

           
           if(  ( $('#b option:selected').text().includes("Change Project Guide Branch") ||  $('#b option:selected').text() == "No Changes" ) &&  ( $('#pg option:selected').text() == "Change Project Guide"  || $('#pg option:selected').text().includes("No Project Guid") ) )
            { 
                r=confirm("Do you want to proceed without changing guide details");
                if(r==true)
                {
                    $real_b = original_guide_branch;
                    $real_pg = original_guide_id;

                    //append to and hide
                    $('#b').append("<option selected>"+original_guide_branch+"</option> ");
                    $('#pg').append("<option selected>"+original_guide_id+"</option> ");


                    //after submission hiding selectors
                    $('#b').hide();
                    $('#pg').hide();

                }
                else
                {
                    $("#errors").append($glyphicon+"Select Correct Project Guide And Branch").show();
                }

            }

            else
            {
                //means here everything is good
                    
                    $real_b = original_guide_branch;
                    $real_pg = original_guide_id;
                    if(error_found==false) { r2=confirm("Are You Sure\nYou Want To Update Your Profile? "); r=r2; }  //"error_found" is used because all errors of emailid and name are shown after the confirm statement , so to avoid that we are using "error_found" , and without "error_found" , if user presses ok for confirm than it will post null data , if member details are altered
                    else
                    {
                        // alert("after confirm value of r is "+r+" and r2 confirm is "+r2);
                    }


                    /*else
                    {
                        r=confirm
                    }

                    r // r is accessable here but

                    else
                    {
                        if() { r=confirm }
                    }

                    r // r is not accessable here but    so for ajax call if(r==true)  we are declaring r outside*/
                    
            }




          if(r==true)
          {


                            if( $('#rpass').val() != $('#pass').val() ){$("#errors").append($glyphicon+"Password And Confirm Password Does Not Match").show();}
                            else
                            {
                                       $("#errors").hide();

                                       var formData = new FormData($('#edit')[0]);
                                       formData.append('real_pg', $real_pg );  // this is used because we cannot show id to user for project guide hence guide is inserted as selected for option , so when when user clicks save button he will see he has been tagged to the selected options , but we need onlu id , so for that we seperatly created $real_pg for id sendind
                                       formData.append('real_b', $real_b );
                                       document.getElementById("create_project").disabled = true;
                                       $("#create_project").html("Please Wait  .   .   .");
                                       $('.ajax-loader').css("visibility", "visible");



                                       $.ajax({
                                          type: "POST",
                                          url: "/editprofile",
                                          data: formData,
                                          dataType:"json",
                                          cache:false,
                                          processData:false,
                                          contentType:false,
                                          success: function(result) 
                                          {                
                                            

                                            $('.ajax-loader').css("visibility", "hidden");

                                            alert("Profile Edited Successfully.");

                                            $("#errors").hide();

                                                
                                                $('body').append('<a id="link" href="/editprofile" >&nbsp;</a>');
                                                $('#link')[0].click();
                                                $('#link')[0].remove();

                                          },
                                          error: function(json) 
                                          {

                                              $('#refresh').show();

                                              //generate();

                                              $('.hrx').hide(); // this hr comes to visible when some error are show , coz of that extra hr is visible 
                                              //single hr are visible until 2nd hr's is used , but 2nd hr is only visible first  error comes 
                                              //and with single hr , line is not coming


                                              document.getElementById("create_project").disabled = false;
                                              $("#create_project").html("<span class='glyphicon glyphicon-hdd' ></span>Save Changes");
                                              $('.ajax-loader').css("visibility", "hidden");

                                              $("html, body").animate({ scrollTop: 0 }, "slow");

                                              if(json.status === 422)
                                              { $("#errors").html(json.responseJSON['errors']).show(); }
                                              else 
                                              { 
                                                $("#errors").hide(); 
                                              }

                                          }
                                          
                                        });//end of ajax

                            }

            }
            else
            {
                $("html, body").animate({ scrollTop: 0 }, "slow");
            }



}



function members()
{
    members_click=1;


    var r5=confirm("All members details will be deleted and atleat one new member need to be added");

    if(r5==true)
    {

        $('.previous_member_details').empty();

        $('#new_members_btn').hide();

        $('#new_members_btn').empty(); // to make space , i am emptying entire div


            //var str = '<div class="form-group"><select id="ngm" name="ngm" class="form-control" onchange="ngm_onchange()" required><option value="" selected>Select Number Of Group Members</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><div  id="datar" class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="ng1" id="ng1" placeholder="Name of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="text" name="ng2" id="ng2" placeholder="Name of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="text" name="ng3" id="ng3" placeholder="Name of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="text" name="ng4" id="ng4" placeholder="Name of Group Member 4" class="form-control 4"></div></div><div class="col-md-4"><div class="form-group"><input type="email" name="eg1" id="eg1" placeholder="Email of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="email" name="eg2" id="eg2" placeholder="Email of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="email" name="eg3" id="eg3" placeholder="Email of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="email" name="eg4" id="eg4" placeholder="Email of Group Member 4" class="form-control 4"></div></div></div>'; 


            //var str = '<div class="form-group" style="width:20%;" ><select id="ngm" name="ngm" class="form-control" onchange="ngm_onchange()" required><option value="" selected>Select Number Of Group Members</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><div  id="datar" class="row"><div class="col-md-4"><div class="form-group"><input type="text" name="ng1" id="ng1" placeholder="Name of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="text" name="ng2" id="ng2" placeholder="Name of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="text" name="ng3" id="ng3" placeholder="Name of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="text" name="ng4" id="ng4" placeholder="Name of Group Member 4" class="form-control 4"></div></div><div class="col-md-4"><div class="form-group"><input type="email" name="eg1" id="eg1" placeholder="Email of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="email" name="eg2" id="eg2" placeholder="Email of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="email" name="eg3" id="eg3" placeholder="Email of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="email" name="eg4" id="eg4" placeholder="Email of Group Member 4" class="form-control 4"></div></div></div>'; 

            var str = '<br><br><div class="text-center" > <div class="form-group" style="width:40%;" ><select id="ngm" name="ngm" class="form-control" onchange="ngm_onchange()" required><option value="" selected>Select Number Of Group Members</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option></select></div><div  id="datar" class="row"><div class="col-md-5"><div class="form-group"><input type="text" name="ng1" id="ng1" placeholder="Name of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="text" name="ng2" id="ng2" placeholder="Name of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="text" name="ng3" id="ng3" placeholder="Name of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="text" name="ng4" id="ng4" placeholder="Name of Group Member 4" class="form-control 4"></div></div><div class="col-md-5"><div class="form-group"><input type="email" name="eg1" id="eg1" placeholder="Email of Group Member 1" class="form-control 1"></div><div class="form-group"><input type="email" name="eg2" id="eg2" placeholder="Email of Group Member 2" class="form-control 2"></div><div class="form-group"><input type="email" name="eg3" id="eg3" placeholder="Email of Group Member 3" class="form-control 3"></div><div class="form-group"><input type="email" name="eg4" id="eg4" placeholder="Email of Group Member 4" class="form-control 4"></div></div></div>  </div>'; 


        $('.new_member').append(str); 

        $('.brx').hide();
        $('.hrx').hide();


        $('.1').hide(); $('.2').hide(); $('.3').hide(); $('.4').hide();

        return false;


    }

} // end of members function


function ngm_onchange() //after appending var [str html to [new_member][div] on [Change Group Members][button] click
{

    


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


    if(  $('#ngm option:selected').text() == "Select Number Of Group Members"   ) { $('.1').hide(); $('.2').hide(); $('.3').hide(); $('.4').hide(); }
    
    if(  $('#ngm option:selected').val() == 1   ) {  $('.2').hide(); $('.3').hide(); $('.4').hide();    $('.1').show();  }
    if(  $('#ngm option:selected').val() == 2   ) {  $('.3').hide(); $('.4').hide();    $('.1').show(); $('.2').show();  }
    if(  $('#ngm option:selected').val() == 3   ) {  $('.4').hide();    $('.1').show(); $('.2').show(); $('.3').show();  }
    if(  $('#ngm option:selected').val() == 4   ) {  $('.1').show(); $('.2').show(); $('.3').show(); $('.4').show();  }

}


/*function refresh() 
{
    location.reload();   
}*/


/*function generate() 
{
    var guidebranch_str = '<label for="name" class="col-md-4 control-label">Project Guide Branch</label> <div class="col-md-4"> <input type="text" value="{{ $user['branch'] }}" class="form-control" id="visible_branch" readonly> </div> <div class="col-md-4"> <select id="b" name="b" class="form-control" onchange="guidebranch()" > <option selected>Change Project Guide Branch</option> <option value="No Changes">No Changes</option> <option value="Computer">Change Project Guide Branch To Computer</option> <option value="IT">Change Project Guide Branch To IT</option> <option value="Civil">Change Project Guide Branch To Civil</option> <option value="EXTC">Change Project Guide Branch To EXTC</option> <option value="ETRX">Change Project Guide Branch To ETRX</option> </select> </div>' ;
    

    var guidename_str = '<label for="name" class="col-md-4 control-label">Project Guide Name</label> <div class="col-md-4"> <input type="text" text="{{ $user['project_guide'] }}" value ="{{ $guide }}" class="form-control" id="visible_pg" readonly> </div> <div class="col-md-4"> <select id="pg" name="pg" class="form-control" onchange="projectguide()" style="display: none;"> </select> </div>' ;              


    $('#guidebranch').append(guidebranch_str); 
    $('#guidename').append(guidename_str); 


}
*/
</script>
