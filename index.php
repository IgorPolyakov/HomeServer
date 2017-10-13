<!DOCTYPE HTML>
<html>
    <head>
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>HomeMeteostation</title>
        <style type="text/css">
            .container {width: 960px; margin: 0 auto; overflow: hidden;}
            .clock {width:800px; margin:0 auto; padding:30px; border:1px solid #333; color:#fff; }
            #Date { font-family:'digital-7_italicitalic', Arial, Helvetica, sans-serif; font-size:36px; text-align:center; text-shadow:0 0 5px #3ADF00; }
            ul { width:800px; margin:0 auto; padding:0px; list-style:none; text-align:center; }
            ul li { display:inline; font-size:10em; text-align:center; font-family:'digital-7_italicitalic', Arial, Helvetica, sans-serif; text-shadow:0 0 5px #3ADF00; }
            #point { position:relative; -moz-animation:mymove 1s ease infinite; -webkit-animation:mymove 1s ease infinite; padding-left:10px; padding-right:10px; }
            @-webkit-keyframes mymove
            {
            0% {opacity:1.0; text-shadow:0 0 20px #3ADF00;}
            50% {opacity:0; text-shadow:none; }
            100% {opacity:1.0; text-shadow:0 0 20px #3ADF00; }
            }
            @-moz-keyframes mymove
            {
            0% {opacity:1.0; text-shadow:0 0 20px #3ADF00;}
            50% {opacity:0; text-shadow:none; }
            100% {opacity:1.0; text-shadow:0 0 20px #3ADF00; }
            }
        </style>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
            // Create two variable with the names of the months and days in an array
            var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "OCTOBER", "November", "December" ];
            var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

            // Create a newDate() object
            var newDate = new Date();
            // Extract the current date from Date object
            newDate.setDate(newDate.getDate());
            // Output the day, date, month and year
            $('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear());

            setInterval( function() {
            	// Create a newDate() object and extract the seconds of the current time on the visitor's
            	var seconds = new Date().getSeconds();
            	// Add a leading zero to seconds value
            	$("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
            	},1000);

            setInterval( function() {
            	// Create a newDate() object and extract the minutes of the current time on the visitor's
            	var minutes = new Date().getMinutes();
            	// Add a leading zero to the minutes value
            	$("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
                },1000);

            setInterval( function() {
            	// Create a newDate() object and extract the hours of the current time on the visitor's
            	var hours = new Date().getHours();
            	// Add a leading zero to the hours value
            	$("#hours").html(( hours < 10 ? "0" : "" ) + hours);
                }, 1000);

            });
        </script>
    </head>
    <body>
        <h1>Home meteostation on Arduino board
            <small>
                <br>

                    <a href="http://www.vk.com/fox_3">Author by Igor Polyakov</a>
                </br>
                <div class="hr">
                      <li><a href="index.php">MAIN </a></li>
                      <li><a href="graph_pres.php"> pressure </a></li>
                      <li><a href="graph_temp.php">temperature </a></li>
                      <li><a href="graph_humid.php">humidity </a></li>
                      <li><a href="graph_ligth.php">light </a></li>
                      <li><a href="graph_map.php">map </a></li>
                </div>
            </small>
        </h1>
        <div class="container">
            <div class="clock">
                <div id="Date"></div>
                <ul>
                    <li id="hours"> </li>
                    <li id="point">:</li>
                    <li id="min"> </li>
                    <li id="point">:</li>
                    <li id="sec"> </li>
                </ul>
            </div>
	        <h2>
	        	<?php
                    $db = new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'root', 'mys1234!@#$');
                    foreach ($db->query('SELECT * FROM inform WHERE Id=(SELECT MAX(Id) FROM inform)') as $row) {
                        echo  '    '.$row['temperature'].'&deg;C     '.$row['pressure'].'%     '.$row['humidity'].'mm     ';
                        echo $row['light'] == 1 ? 'LIGTH ON':'LIGTH OFF';
                    }
                ?>
	        </h2>
        </div>
    </body>
</html>
