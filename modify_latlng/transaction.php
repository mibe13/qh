<?php
require ('./lib/MySQLcon.php');

$host = "localhost";
$username = "root";
$password = "";
$db = 'transaction';
$tb = 'giaodich';
$bOK = true;

$con =  new connectMySQL();

$squery = "SELECT id, latlng, checked FROM " . $tb 
        . " WHERE checked is null and latlng is not null"  . " LIMIT 200";
//ini_set('max_execution_time', 300); //300 seconds = 5 minutes

$con->database = $db;
$con->table = $tb;
while ($bOK == true){
    //$result = null;
    $con->sqlquery($squery);
    $result = $con->result;
    
    if(!$result || $result == null){	
        $bOK = false;
	goto skip2;
    } 
    
    while ($row = mysql_fetch_array($result)) {
        //echo "ID:".$row{'item'}."; Lat:".$row{'lat'}."; lng:".$row{'lng'}."<br>";
        if (!$row){
            goto skip1;
        }
	if (!$row{'id'} || !$row{'latlng'}){
            goto skip1;
        }
        $id = $row{'id'};
        $str = $row{'latlng'};

        $pat = '/[0-9\.]+/i';
        if(!preg_match($pat, $str, $matches)){
	    goto skip1;	     
	} else {
	    $lat = $matches[0];
	}	 

        $pat = '/(?<=[,;])[0-9\.]+/i';
        if(!preg_match($pat, $str, $matches)){
	    goto skip1;	    
	} else {
	    $lng = $matches[0];
	}
	
        if (!$lat || !$lng || $lat == 0 || $lng == 0){
            goto skip1;
        }
	
        $sql = "UPDATE " . $tb . " SET lat=". $lat .", lng=" . $lng 
                . ", checked=1". " WHERE id=" . $id;    
	echo $sql . '<br>';
	$con->sqlquery($sql);
	usleep(5000);
        skip1:
    }
    skip2:
   
}

echo 'Done';

?>


