<?php
require ('./lib_PHP/MySQLcon.php');

//Bound: ((21.017609122137678, 105.8156543440457), (21.021705221000346, 105.82234377332884)) from googlemap
//21.0282,105.825986
//21.0282,105.831168
//21.023103,105.835782
//21.02144,105.829366
//21.024645,105.824323
//x:lat Y:lng

//p=((21.017609122137678, 105.8156543440457), (21.021705221000346, 105.82234377332884))

//$b = '((21.017609122137678, 105.8156543440457), (21.021705221000346, 105.82234377332884))';
$x1 = '21.017609122137678';
$y1 = '105.8156543440457';
$x2 = '21.021705221000346';
$y2 = '105.82234377332884';

if (isset($_GET["x1"])){
	$x1 = $_GET["x1"];	
}
if (isset($_GET["y1"])){
	$y1 = $_GET["y1"];	
}
if (isset($_GET["x2"])){
	$x2 = $_GET["x2"];	
}
if (isset($_GET["y2"])){
	$y2 = $_GET["y2"];	
}

$host = "localhost";
$username = "root";
$password = "";
$db = 'dbo';
$tb = 'muabannhadatdotcomdotvn2';

$con =  new connectMySQL();
$con->database = $db;
$con->table = $tb;

$sql = "SELECT id, projectName, lat, lng FROM ".$tb
        . " WHERE (lat between ".$x1." and ".$x2.")"
        . " and (lng between ".$y1." and ".$y2.")"
        . " LIMIT 16";

$con->sqlquery($sql);
$result = $con->result;

$i = 0;
while ($row = mysql_fetch_array($result)) {
    //echo "ID:".$row{'item'}."; Lat:".$row{'lat'}."; lng:".$row{'lng'}."<br>";
    if ($i == 0){
            echo "<<1>>".$row{'id'}."<<2>>".$row{'lat'}.",".$row{'lng'}."<<3>>".$row{'projectName'}."<<4>>";
    } else {
            echo "<br><<1>>".$row{'id'}."<<2>>".$row{'lat'}.",".$row{'lng'}."<<3>>".$row{'projectName'}."<<4>>";
    }
    ++ $i;
}

?>