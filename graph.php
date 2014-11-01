<!DOCTYPE HTML>
<html>
    <head>
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="main.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>HomeMeteostation v0.66</title>
        <script type="text/javascript" src="dygraph-combined.js"></script> 
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
		<script src="http://code.highcharts.com/highcharts.js"></script>
		<script src="http://code.highcharts.com/modules/exporting.js"></script>
    </head>
    <body>
        <h1>Home meteostation on Arduino board v0.65
        	<small>
        		<a href="graph.php">Graph</a>
        		 | Author by Igor Polyakov| 
        		<a href="http://www.vk.com/fox_3">Contact</a>
        	</small>
        </h1>

	<div id="graphdiv">
		<script type="text/javascript">
		  g = new Dygraph(

		    // containing div
		    document.getElementById("graphdiv"),"output.cvs", {
				  legend: 'always',
				  title: 'LOG',
				  showRoller: true,
				  rollPeriod: 14,
				  customBars: true,
				  ylabel: 'Temperature (F)',
				});
		</script>
	</div>
    </body>
</html>