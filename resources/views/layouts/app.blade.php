<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>BE Project Tracker</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/Ionicons/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{ url('/') }}/bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ url('/') }}/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{ url('/') }}/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="{{ url('/') }}/https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="{{ url('/') }}/https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <style type="text/css">
    
    .content{

      background-image: url('{{ url('/')  }}/css/back.jpg');
      background-position: center;
      background-repeat: no-repeat;
      background-size: cover;
      position: relative;

    }






  </style>

</head>
<body  class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
    <header class="main-header">
    <!-- Logo -->
    <a id="homeanchor" href="/home" class="logo">
      <span class="logo-lg">BE Project Tracker</span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
          <!-- Authentication Links -->
                        @if (Auth::guest())
                            <li><a href="/login">Login</a></li>
                        @else
                        <li>


                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class="glyphicon glyphicon-off"></span>&nbsp;&nbsp;&nbsp; Logout
                                        </a>

                                       
                        </li>
                            
                        

                        @endif
      </ul>
      </div>

    </nav>
  </header>


  <aside class="main-sidebar">

    <section class="sidebar">

      <ul class="sidebar-menu" data-widget="tree">
      @if (Auth::guest())

      <img class="img-thumbnail" src="{{ url('/') }}/logo.jpg">

      @else

          @if(Auth::user()->type==10)
            <li><a href="/home"><i class="fa fa-address-book text-aqua"></i> <span>Manage Members</span></a></li>
            <li><a href="/adminkey"><i class="fa fa-key text-aqua"></i> <span>Access Key</span></a></li>
            <li><a href="/adminemail"><i class="fa fa-envelope-o text-aqua"></i> <span>Email Configuration</span></a></li>
            <li><a href="/editprofile"><i class="fa fa-user-o text-aqua"></i> <span>Edit Profile</span></a></li>
          @elseif(Auth::user()->type==0)
            <li><a href="/home"><i class="fa fa-play text-aqua"></i> <span>Project</span></a></li>
            <li><a href="/uid"><i class="fa fa-book text-aqua"></i> <span>UID</span></a></li>
            <li><a href="/editprofile"><i class="fa fa-user-o text-aqua"></i> <span>Profile</span></a></li>
          @elseif(Auth::user()->type==1)
            <li><a href="/home"><i class="fa fa-play text-aqua"></i> <span>Task</span></a></li>
            <li><a href="/chart"><i class="fa fa-pie-chart text-aqua"></i><span>Statistics</span></a></li>
            <li><a href="/report/{{ Auth::user()->id }}"><i class="fa fa-check text-aqua"></i> <span>Report</span></a></li>
            <li><a href="/rubrics"><i class="fa fa-area-chart text-aqua"></i> <span>Rubrics</span></a></li>
            <li><a href="/notification"><i class="fa fa-comments text-aqua"></i> <span>Notifications</span></a></li>
            <li><a href="/editprofile"><i class="fa fa-user-o text-aqua"></i> <span>Profile</span></a></li>
          @endif

      @endif
      </ul>

      
    </section>
    <!-- /.sidebar -->
  </aside>
  <div class="content-wrapper">
    <section class="content">
    @yield('content')
    </section>
    </div>
    
</div>
<!-- ./wrapper -->
  <!-- jQuery 3 -->
  <script type="text/javascript" src="/js/app.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>

<!-- Bootstrap 3.3.7 -->
<script src="{{ url('/') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{ url('/') }}/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="{{ url('/') }}/dist/js/adminlte.min.js"></script>
<!-- Sparkline -->
<script src="{{ url('/') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap  -->
<script src="{{ url('/') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ url('/') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- SlimScroll -->
<script src="{{ url('/') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- ChartJS -->
<script src="{{ url('/') }}/bower_components/chart.js/Chart.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="{{ url('/') }}/dist/js/demo.js"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

 <script type="text/javascript">

$(document).ready(function() {
  
var today = new Date();
var dd = today.getDate();
var mm = today.getMonth()+1; //January is 0!
var yyyy = today.getFullYear();
 if(dd<10){
        dd='0'+dd
    } 
    if(mm<10){
        mm='0'+mm
    } 

today = yyyy+'-'+mm+'-'+dd;

document.getElementById("doc").setAttribute("min", today);
document.getElementById("doc").setAttribute("value", today);
});

</script>


<script type="text/javascript">
  
    $('#exampleModal').on('show.bs.modal', function(e) {

    //get data-id attribute of the clicked element
    var bookId = $(e.relatedTarget).data('book-id');

    $('#ppid').val(bookId);

    //populate the textbox
    //$(e.currentTarget).find('input[name="pId"]').val(bookId);
});

  
</script>
</body>
</html>
