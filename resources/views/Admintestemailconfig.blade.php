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



table 
{
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

input
{
  padding: 20px;
  width: 230px;
  height: 35px;
  border-radius: 15px;
  margin:10px;
  color: black;
}

button
{
  margin:5px;
}



</style>




<div class="ajax-loader">
  <img src=" {{url('/images/wave.svg')}} " class="img-responsive" />
</div>





<div class="box box-primary">


            <div class="box-header">Edit Email Configuration

                <br><hr>

                <form action="/testemailconfig/{{$id}}" method="post" id="form1"  onkeydown = " return event.key != 'Enter' ; " >

                              {{ csrf_field() }}

                              <table style="width: 100%;">

                                

                                 @if($info != "")
                                     <!-- error messages -->
                                    <div >              
                                      <div class="btn btn-info btn-lg btn-block" align="left" > 
                                        {{ strip_tags($info) }}
                                      </div>
                                    </div>

                                @endif


    <tr>
      <td> <label>Receiver Email</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" name="ReceiverEmail" type="email"  value="<?php echo isset($_POST['ReceiverEmail']) ? $_POST['ReceiverEmail'] : '' ?>"  required /> </td>
    </tr>
    <tr>
      <td> <label>Subject</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" name="Subject" type="text" value="<?php echo isset($_POST['Subject']) ? $_POST['Subject'] : '' ?>" required /></td>
    </tr>
    <tr>
      <td> <label>Message</label> </td>
      <td  style="width: 80%" > <input style="width: 80%" name="Message" type="text" value="<?php echo isset($_POST['Message']) ? $_POST['Message'] : '' ?>" required /> </td>
    </tr>

    <tr>
      <td colspan="2">
          <a  href="/adminemail" class="btn btn-warning" style="border-radius: 10px 10px;" ><span class="glyphicon glyphicon-chevron-left"></span>Go Back</a>
          
          @if($info == "Email Sent" )
             <button type="submit" class="btn btn-info" style="border-radius: 10px 10px;" ><span class="glyphicon glyphicon-repeat"></span>Re-Send Message</button>
          @else
             <button type="submit" class="btn btn-info" style="border-radius: 10px 10px;" ><span class="glyphicon glyphicon-envelope"></span>Send Message</button>
          @endif

      </td>
    </tr>

                        </table>
                   
                </form>

            </div>

</div>

@endsection


<script type="text/javascript">


</script>
