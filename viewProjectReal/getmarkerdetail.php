<?php

require ('./lib_PHP/MySQLcon.php');

$item = '';

if (isset($_GET["item"])){
    $item = $_GET["item"];	
}

if(!$item || $item == ''){
    goto skip1;
}

$host = "localhost";
$username = "root";
$password = "";
$db = 'dbo';
$tb = 'muabannhadatdotcomdotvn2';

$con =  new connectMySQL();
$con->database = $db;
$con->table = $tb;

$sql = "SELECT detail, projectName FROM ".$tb
        . " WHERE id=".$item." ORDER BY detail ASC ";

$con->sqlquery($sql);
$result = $con->result;

$i = 0;
while ($row = mysql_fetch_array($result)) {
    if ($i == 0){
            echo $row{'detail'};
    } else {
            echo "<br>".$row{'detail'};
    }
    ++ $i;
}  

skip1:

?>