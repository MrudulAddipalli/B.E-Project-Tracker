@extends('layouts.app')

@section('content')

<?php 

$x=2;

$all_guides=0;
$active_guides=0;
$all_group=0;
$active_group=0;

$smks=0;
foreach ($project as $pro ) 
{

  if ($pro->type==0)
  {
    $all_guides = $all_guides + 1;

      if ($pro->act==1)
      {
        $active_guides = $active_guides + 1;
      }

  }
  
  if ($pro->type==1)
  {
    $all_group = $all_group + 1;

      if ($pro->act==1)
      {
        $active_group = $active_group + 1;
      }

  }

}

?>


<!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/Ionicons/css/ionicons.min.css">




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



table 
{

   /*              table-layout: fixed;  to make td descendents to use max-width         , but its not working       */

   /*table-layout: fixed;*/

  /* width: 100% ;*/
   border-collapse:collapse; align-content: center;

}

th { border:solid 2px #D8D8D4 !important;}

table td 
{
  border:solid 2px #D8D8D4 !important; 
  word-wrap:break-word; 
  /*width: 40%;*/
} 

td,th,table {
   align-content: center;
  padding: 10px;
}

td
{
  text-align: center; 
  padding: 10px;
  position: relative;
  font-size: 100%;
}

select option { color: black; }
input , select{  color: black; }

.td2
{
   border-radius:10px;
   width: 100% !important ;
   /*align-content: center !important ;*/
}



button
{
  margin:5px;
  text-align: left !important;
}


</style>






<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<script src="{{ asset('js/app.js')}}"></script>




   <!--  <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-gear-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Project <br> Guides</span>
              <span class="info-box-number">{{ $all_guides }}</span>
            </div>
          </div>        
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-check"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Active <br> Project Guides</span>
              <span class="info-box-number">{{$active_guides}}</span>
            </div>
          </div>
        </div>
        <div class="clearfix visible-sm-block"></div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Project <br> Groups</span>
              <span class="info-box-number">{{$all_group}}</span>
            </div>
          </div>        
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Total Active <br> Project Groups</span>
              <span class="info-box-number">{{ $active_group }}</span>
            </div>
          </div>
        </div>
    </div> -->




<div class="box">
<div class="box-header with-border" align="center">
  
  <h5 class="box-title pull-left " style="margin: 15px;" > All Project Guides And Project Groups </h5> 



                <button class="btn btn-warning pull-right" onclick="deactivateall();" >
                    <span class="glyphicon glyphicon-ban-circle" ></span>
                        Deactivate All Guide (s)
                </button> 

                <button class="btn btn-info pull-right" onclick="activateall();" >
                    <span class="glyphicon glyphicon-ok" ></span>
                       Activate All Guide (s)
                </button>

 
</div>


<!-- name branch type -->

<!-- style=" margin-top:15px; background-color: #ed9fe9;" -->
<div id="search" align="center" class="btn btn-primary btn-block">


  <form>

      <input name="uid" type="number" pattern="[0-9]*" min="1" value="{{ $uid }}" placeholder="UID" style=" border-radius: 10px 10px;  width:6%; padding: 10px;" />
      
      <input name="name" type="text" value="{{ $name }}" placeholder="Search By Member Name" style=" border-radius: 10px 10px; margin: 10px; width:30%; padding: 10px;" />

      <select name ="branch" id="branch" style="width: 140px; height: 40px; background-color: #FFFFFF; border-radius: 10px 10px; ">

          <option value="" >Select By Branch</option>
          <option value="IT" <?php if ($branch == 'IT' ) echo 'selected' ; ?>                >IT</option>
          <option value="Computer" <?php if ($branch == 'Computer' ) echo 'selected' ; ?>    >Computer</option>
          <option value="Civil"  <?php if ($branch == 'Civil' ) echo 'selected' ; ?>         >Civil</option>
          <option value="EXTC"   <?php if ($branch == 'EXTC' ) echo 'selected' ; ?>          >EXTC</option>
          <option value="ETRX"  <?php if ($branch == 'ETRX' ) echo 'selected' ; ?>           >ETRX</option>

      </select>

      <select name ="type" id="type" style="width: 180px; height: 40px; background-color: #FFFFFF; border-radius: 10px 10px; margin-left: 10px;  margin-left: 10px; " required>

          <option value="" > Select By Member Type</option>
          <option value="0"  <?php if ($type == '0' ) echo 'selected' ; ?>    >Project Guide</option>
          <option value="1"  <?php if ($type == '1' ) echo 'selected' ; ?>    >Project Group</option>

      </select> 

      <button type=submit class="btn btn-info" style="width: 150px; height: 40px; margin-left: 50px; border-radius: 10px 10px; " ><span class="glyphicon glyphicon-search" ></span>Search</button>
      
          @if($search!="")
              <button type=button class="btn btn-warning" onclick="home();"><span class="glyphicon glyphicon-remove" ></span></button>
          @endif
  

  </form>



 </div>



<div class="box-body" >
  <table class="table table-bordered" style='font-size:18px; ' >
    <tbody><tr>
      <th>UID</th>
      <th>Name / Email</th>
      <th>Branch</th>
      <th>Member Type</th>
      <th>Status</th>
      <th>Action</th>
    </tr>

    @foreach($project as $p)
    <tr>
      
      <td>

              @if($p->type == 0)

                          <button class="btn btn-secondary">
                                  {{ $p->id }}
                          </button>

                  
              @elseif($p->type == 1)

                          <button class="btn btn-secondary">
                                  {{ $p->id }} 
                          </button>

              <br><br>
              [ 
                    

                        @foreach($project as $pp )


                                 @if( $p->project_guide == "" )
                                            
                                      Currently Rejected.

                                      @break;

                                 @elseif ( $p->project_guide == $pp->id )
                                      
                                      Under - {{ $pp->name }} ( {{ $pp->id }} )

                                      @break;

                                 @endif
                                
                          
                        @endforeach

                        

               ] 
              @endif


      </td>



      <td>

            @if( $p->type == 0 )
            {{ $p->name }}<hr>{{ $p->email }}
            @elseif( $p->type == 1 )

                    <table  style="border-collapse: separate;border-spacing: 5px; word-wrap:break-word;">
                      

                        @if($p->name_gm1!="")
                            <tr >
                                <td class="td2" >
                                    {{ $p->name_gm1 }} /{{ $p->email_gm1 }}
                                </td>
                            </tr>
                        @endif

                        @if($p->name_gm2!="")
                            <tr>
                                <td class="td2">
                                     {{ $p->name_gm2}} / {{ $p->email_gm2 }}
                                </td>
                            </tr>
                        @endif

                        @if($p->name_gm3!="")
                            <tr>
                                <td class="td2">
                                    {{ $p->name_gm3 }} / {{ $p->email_gm3 }}
                                </td>
                            </tr>
                        @endif


                        @if($p->name_gm4!="")
                            <tr>
                                <td class="td2">
                                     {{ $p->name_gm4 }} / {{ $p->email_gm4 }}
                                </td>
                            </tr>
                        @endif

                  </table>


            @endif


      </td>



      <!-- <td>


            @if( $p->type == 0 )
            {{ $p->email }}
            @elseif( $p->type == 1 )

                @if($p->email_gm1!="")
                {{ $p->email_gm1 }}<hr><hr>
                @endif

                @if($p->email_gm2!="")
                {{ $p->email_gm2 }}<hr>
                @endif

                @if($p->email_gm3!="")
                {{ $p->email_gm3 }}<hr>
                @endif

                @if($p->email_gm4!="")
                {{ $p->email_gm4 }}
                @endif

           @endif

      </td> -->


      <td>

            @if( $p->type == 1 || $p->type == 0 )
              {{ $p->branch }}
            @endif

      </td>




      <td>

            @if($p->type == 0)

                          <button class="btn btn-primary" >
                              <i class="fa fa-user-circle"></i> 
                                  Project Guide 
                          </button>



            @elseif($p->type == 1)

                          <button class="btn">
                              <i class="fa fa-users"></i> 
                                   Project Group 
                          </button>
             
            @endif

      </td>



      <td>


<!-- Do not give activation option for admin to activate project group ,  activation of project group is only done by selected project guide during project creation or edit profile  -->

            @if($p->type == 0)

                @if($p->act == 1)


                          <button class="btn btn-info">
                              <span class="glyphicon glyphicon-ok"></span>
                                  Activated
                          </button>

                  

                @else

                          <button class="btn btn-warning">
                              <span class="glyphicon glyphicon-ban-circle"></span>
                                  Access Key<br>Not Submitted.
                          </button>
                  

                @endif
              
            @elseif($p->type == 1)
              
                @if($p->act == 1)

                          <button class="btn btn-info">
                              <span class="glyphicon glyphicon-ok"></span>
                                  Activated
                          </button>

                @else

                          <button class="btn btn-warning">
                              <span class="glyphicon glyphicon-remove"></span>
                                  Request <br>Approval Pending<br> From Guide.
                          </button>

                  

                @endif

            @endif

      </td>



      <td>

          @if( $p->type == 0 )

                    @if( $p->act == 1 )

                          <button onclick="deactivateguide( {{ $p->id }} )" class="btn btn-warning">
                              <span class="glyphicon glyphicon-ban-circle"></span>
                                  Deactivate Guide
                          </button><br>

                    @elseif( $p->act == 0 )


                           <button onclick="activateguide( {{ $p->id }} )" class="btn btn-info">
                              <span class="glyphicon glyphicon-ok"></span>
                                  Activate Guide
                          </button><br>

                    @endif

                    <button onclick="deletemember( {{ $p->id }} )" class="btn btn-danger">
                        <span class="glyphicon glyphicon-trash"></span>
                            Delete Guide
                    </button>


          @elseif( $p->type == 1 )

                  <button onclick="deletemember( {{ $p->id }} )" class="btn btn-danger">
                      <span class="glyphicon glyphicon-trash"></span>
                          Delete Group
                  </button>

          @endif 


          


      </td>



    </tr>


@endforeach

   </tbody>
  </table>
</div>

<!-- /.box-body -->
</div>


@endsection



<script type="text/javascript">



function home() 
{
   var r = confirm("Are You Sure ?\nYou Want To Clear Search");
    if (r == true) 
    {
        //$('.ajax-loader').css("visibility", "visible");
        var url="/home";
        $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
        $('#link')[0].click();
        $('#link')[0].remove();
    }
    return false;
}

function activateguide(x) 
{
  var r = confirm("Are You Sure ?\nYou Want To Activate Project Guide With ID "+x+".");
  if (r == true) 
  {
      $('.ajax-loader').css("visibility", "visible");
      guidetoggle(x);
  }
  return false;
}


function deactivateguide(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Deactive Project Guide With ID "+x+".");
  if (r == true) 
  {
     $('.ajax-loader').css("visibility", "visible");
     guidetoggle(x);
  }
  return false;
}

function guidetoggle(x) 
{
    var url="/guidetoggle/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();
}


function deletemember(x) 
{

  var r = confirm("Are You Sure ?\nYou Want To Delete User With ID "+x+".");
  if (r == true) 
  {
     $('.ajax-loader').css("visibility", "visible");

    var url="/deletemember/"+x;
    $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
    $('#link')[0].click();
    $('#link')[0].remove();
  }
  return false;
}


function activateall() 
{
    var r = confirm("Are You Sure ?\nYou Want To Activate All Project Guide (s).");
    if (r == true) 
    {
       $('.ajax-loader').css("visibility", "visible");

      var url="/activateall";
      $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
      $('#link')[0].click();
      $('#link')[0].remove();
    }
    return false;
}


function deactivateall() 
{
    var r = confirm("Are You Sure ?\nYou Want To Deactivate All Project Guide (s).");
    if (r == true) 
    {
       $('.ajax-loader').css("visibility", "visible");

      var url="/deactivateall";
      $('body').append('<a id="link" href='+url+' >&nbsp;</a>');
      $('#link')[0].click();
      $('#link')[0].remove();
    }
    return false;
}





</script>

 
