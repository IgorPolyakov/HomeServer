<?php   
 /* CAT:Line chart */

 /* pChart library inclusions */
 include("class/pData.class.php");
 include("class/pDraw.class.php");
 include("class/pImage.class.php");

 /* Create and populate the pData object */
$db = new PDO('mysql:host=localhost;dbname=data;charset=utf8', 'root', 'mys1234!@#$');

$points_tempr = array();
$points_date = array();
foreach ($db->query('SELECT temperature, time FROM inform WHERE 1') as $row)
{
	$points_tempr[] = $row['temperature'];
	$points_date[] = $row['time'];

}


	$MyData = new pData();
	// $MyData->addPoints(array(-4,VOID,VOID,12,8,3),"Probe 1");
	// $MyData->addPoints(array(3,12,15,8,5,-5),"Probe 2");
	$MyData->addPoints($points_tempr,"Temperatures");
	// $MyData->setSerieTicks("Probe 2",4);
	$MyData->setSerieWeight("Temperatures",2);
	//$MyData->setAxisName(0,"Temperatures");
	$MyData->addPoints($points_date,"Labels");
	$MyData->setSerieDescription("Labels","Months");
	$MyData->setAbscissa("Labels");

$w = isset($_GET['w']) ? $_GET['w'] : 1024;
$h = isset($_GET['h']) ? $_GET['h'] : 520;

 /* Create the pChart object */
 $myPicture = new pImage($w,$h,$MyData);

 /* Turn of Antialiasing */
 $myPicture->Antialias = FALSE;

 /* Add a border to the picture */
 $myPicture->drawRectangle(0,0,$w,$h,array("R"=>0,"G"=>0,"B"=>0));
 
 /* Write the chart title */ 
 $myPicture->setFontProperties(array("FontName"=>"fonts/Forgotte.ttf","FontSize"=>11));
 $myPicture->drawText(150,35," Size: ".$w." x ".$h,array("FontSize"=>20,"Align"=>TEXT_ALIGN_BOTTOMMIDDLE));

 /* Set the default font */
 $myPicture->setFontProperties(array("FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

 /* Define the chart area */
 $myPicture->setGraphArea(60,40,$w,$h-20);

 /* Draw the scale */
 $scaleSettings = array("XMargin"=>10,"YMargin"=>10,"Floating"=>TRUE,"GridR"=>0,"GridG"=>0,"GridB"=>0,"DrawSubTicks"=>TRUE,"CycleBackground"=>TRUE);
 $myPicture->drawScale($scaleSettings);

 /* Turn on Antialiasing */
 $myPicture->Antialias = TRUE;

 /* Draw the line chart */
$Config = array("BreakVoid"=>0, "BreakR"=>234, "BreakG"=>55, "BreakB"=>26);
$myPicture->drawSplineChart($Config);

 /* Write the chart legend */
 //$myPicture->drawLegend(540,20,array("Style"=>LEGEND_NOBORDER,"Mode"=>LEGEND_HORIZONTAL));

 /* Render the picture (choose the best way) */
 $myPicture->autoOutput("pictures/example.drawLineChart.simple.png");