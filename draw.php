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
$last_data = 10;
$border = 20;
$query_png = isset($_GET['query_png']) ? $_GET['query_png'] : 'temperature';
$typeGraph = isset($_GET['typeGraph']) ? $_GET['typeGraph'] : 'drawFilledSplineChart';
//typeGraph=drawFilledStepChart
foreach ($db->query('SELECT * FROM inform WHERE Id > (SELECT MAX(Id)-'.$last_data.' FROM inform)') as $row)
{
	$points_tempr[] = $row[$query_png];
	$points_date[] = $row['time'];

}


$MyData = new pData();
// $MyData->addPoints(array(-4,VOID,VOID,12,8,3),"Probe 1");
// $MyData->addPoints(array(3,12,15,8,5,-5),"Probe 2");
$MyData->addPoints($points_tempr,$query_png);
// $MyData->setSerieTicks("Probe 2",4);
$MyData->setSerieWeight("Temperatures",1);
//$MyData->setAxisName(0,"Temperatures");
$MyData->addPoints($points_date,"Labels");
$MyData->setSerieDescription("Labels","Months");
$MyData->setAbscissa("Labels");

$w = isset($_GET['w']) ? $_GET['w'] : 1250;
$h = isset($_GET['h']) ? $_GET['h'] : 550;

 /* Create the pChart object */
 $myPicture = new pImage($w,$h,$MyData);
$Settings = array("R"=>32, "G"=>32, "B"=>32, "Dash"=>1, "DashR"=>22, "DashG"=>22, "DashB"=>22);
$myPicture->drawFilledRectangle(0,0,$w,$h,$Settings);

$Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>0);
$myPicture->drawGradientArea(0,0,$w,$h,DIRECTION_VERTICAL,$Settings);

$myPicture->drawRectangle(0,0,$w-1,$h-1,array("R"=>0,"G"=>0,"B"=>0));

$myPicture->setGraphArea($border,$border,$w-$border,$h-$border);
$myPicture->setFontProperties(array("R"=>255,"G"=>255,"B"=>255,"FontName"=>"fonts/pf_arma_five.ttf","FontSize"=>6));

$Settings = array("Pos"=>SCALE_POS_LEFTRIGHT
//, "Mode"=>SCALE_MODE_ADDALL
, "Mode"=>SCALE_MODE_FLOATING
, "LabelingMethod"=>LABELING_ALL
, "GridR"=>255, "GridG"=>255, "GridB"=>255, "GridAlpha"=>100, "TickR"=>0, "TickG"=>0, "TickB"=>0, "TickAlpha"=>50, "LabelRotation"=>0, "LabelSkip"=>$last_data/5, "CycleBackground"=>1, "DrawXLines"=>1, "DrawSubTicks"=>1, "SubTickR"=>0, "SubTickG"=>0, "SubTickB"=>0, "SubTickAlpha"=>50, "DrawYLines"=>ALL);
$myPicture->drawScale($Settings);

$Config = array("FontR"=>0, "FontG"=>0, "FontB"=>0, "FontName"=>"fonts/pf_arma_five.ttf", "FontSize"=>6, "Margin"=>6, "Alpha"=>30, "BoxSize"=>5, "Style"=>LEGEND_BOX
, "Mode"=>LEGEND_HORIZONTAL
);
$myPicture->drawLegend($border*2,$border*1.5,$Config);

$Config = array("DisplayValues"=>1, "ForceTransparency"=>50, "AroundZero"=>1);
$myPicture->$typeGraph($Config);
 $myPicture->autoOutput("pictures/example.drawLineChart.simple.png");
