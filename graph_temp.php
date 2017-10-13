<!DOCTYPE HTML>
<html>
    <head>
        <link href="favicon.ico" rel="icon" type="image/x-icon" />
        <link rel="stylesheet" href="css/app.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>HomeMeteostation <?php include("version.php"); ?> </title>

    </head>
    <body>
        <h1>Home meteostation on Arduino board
            <small>
                <br>
                    <?php include("version.php"); ?>
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
        <center>
            <A href="draw.php"  onclick="click('')"><img src="draw.php?ImageMap=get&w=680&h=320&query_png=temperature" id="testPicture" alt="" class="pChartPicture"/>
        </center>
    </body>
</html>
