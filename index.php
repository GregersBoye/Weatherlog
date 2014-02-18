<?php


function __autoload($class){
	include($class.".php");
}

$db = new DB();

$rs = $db->query("SELECT time, temp, wind_speed FROM weather_log ");
$resultArray = array();
while($result = $rs->fetch_assoc()){
	$resultArray[] = $result;
}



?>


<html>
  <head>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
        	['time', 'Temperature', 'Windspeed'],
        	<?php
        	foreach($resultArray AS $point){
        		echo "['".date("d-m H:i", $point["time"])."', ".$point["temp"].", ".$point["wind_speed"]."],\n";
        	}
        	?>
        	]);
         var options = {
          title: 'wind_speed and date',
          hAxis: {title: "Dato"},
          vAxis: {title: "temp/wind_speed"}
        };

        var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
    <title>Weather-data</title>
  </head>
  <body>
  	<h1>Weather-data gathered through raspberry PI and weatherbug</h1>
    <div id="chart_div" style="width: 900px; height: 500px;"></div>
  </body>
</html>