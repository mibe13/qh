<?php
require ('./lib/MySQLcon.php');

$host = "localhost";
$username = "root";
$password = "";
$db = 'dbo';
$tb = 'muabannhadatdotcomdotvn2';
$bOK = true;

$con =  new connectMySQL();

$squery = "SELECT ID, LatLng, DetailChecked FROM ".$tb 
        . " WHERE DetailChecked is null and LatLng is not null"  . " LIMIT 200";
ini_set('max_execution_time', 60); //300 seconds = 5 minutes
while ($bOK = true){
    //$result = null;
    $con->conn();
    $con->sqlquery($squery);
    $result = $con->result;

    if(!$result){
        $bOK = false;
    } 

    while ($row = mysql_fetch_array($result)) {
        //echo "ID:".$row{'item'}."; Lat:".$row{'lat'}."; lng:".$row{'lng'}."<br>";
        if (!$row{'ID'} || !$row{'LatLng'}){
            goto skip1;
        }
        $id = $row{'ID'};
        $str = $row{'LatLng'};

        $pat = '/[0-9,\.]+/i';
        if(!preg_match($pat, $str, $matches)){
	    goto skip1;	     
	} else {
	    $lat = $matches[0];
	}	 

        $pat = '/(?<=;)[0-9\.,]+/i';
        if(!preg_match($pat, $str, $matches)){
	    goto skip1;	    
	} else {
	    $lng = $matches[0];
	}
	
        if (!$lat || !$lng || $lat = 0 || $lng = 0){
            goto skip1;
        }
	
        //UPDATE muabannhadatdotcomdotvn2 SET Lat=[value-16],Lng=[value-17] WHERE 1
        $sql = "UPDATE " . $tb . " SET Lat=". $lat .", Lng=" . $lng 
                . ", DetailChecked=1". " WHERE ID=" . $id;    
        $con->sqlquery($sql);
        skip1:
    }  
    $con->close();    
}

echo 'Done';

?>


