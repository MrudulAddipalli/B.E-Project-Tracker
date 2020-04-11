@extends('layouts.app')

@section('content')

<?php 
$comp=0;
$ver=0;
$ong=0;
$all=0;
$lcm=0;
$dl=0;
foreach ($task as $t) {

  if ($t->status==1) {
    $ver=$ver+1;
  }
  if ($t->status==2) {
    $comp=$comp+1;
  }
  if ($t->status==0) {
    $ong=$ong+1;
  }
  if ($t->status==3) {
    $dl=$dl+1;
  }
  if ($t->status==4) {
    $lcm=$lcm+1;
  }
  $all = $all+1;
}
// $ong = $ong/$all*100;
// $ver = $ver/$all*100;
// $comp = $comp/$all*100;
// $dl = $dl/$all*100;
// $lcm = $lcm/$all*100;
?>




<div class="box box-default">
            <div class="box-header with-border">
              <h3 class="box-title">Statistics</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="row">
                <div class="col-md-5">
                  <div class="chart-responsive">

<div id="piechart"></div>




                  </div>
                  <!-- ./chart-responsive -->
                </div>

                <div class="col-md-7">

                <div class="container" id="columnchart_values" style="width: 900px; height: 300px;"></div>

                  
                </div>
                <!-- /.col -->
            
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>

            <pre>















            </pre>
          </div>

@endsection




<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<script type="text/javascript">
// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);

// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable([
  ['Task', 'Hours per Day'],
  ['Ongoing', {{ $ong }}],
  ['Verfying', {{ $ver }}],
  ['Completed', {{ $comp }}],
  ['Delyed', {{ $dl }}],
  ['Late Completed', {{ $lcm }}]
]);

  // Optional; add a title and set the width and height of the chart
  var options = {'title':'PiChart', 'width':550, 'height':400};

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}
</script>

<script type="text/javascript">
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([

        ["Element", "Density", { role: "style" } ],

        @foreach($task as $t)

        [" {{ $t->id }} ", {{ $t->marks}} , "#7CFC00"],

        @endforeach
      
      ]);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);

      var options = {
        title: "Marks Graph",
        width: 600,
        height: 400,
        bar: {groupWidth: "40%"},
        legend: { position: "none" },
        hAxis: {
          title: 'TASK ID',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          },
          textStyle: {
            fontSize: 14,
            color: '#053061',
            bold: true,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#053061',
            bold: true,
            italic: false
          }
        },
        vAxis: {
          title: 'Marks',
          textStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: false,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: true,
            italic: false
          }
        }
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  </script>