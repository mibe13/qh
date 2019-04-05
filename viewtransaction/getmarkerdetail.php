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
$db = 'transaction';
$tb = 'giaodich';

$con =  new connectMySQL();
$con->database = $db;
$con->table = $tb;

$sql ="SELECT detail, fulldate, price FROM ".$tb
    . " WHERE item=".$item." ORDER BY detail ASC ";

$con->sqlquery($sql);
$result = $con->result;

$i = 0;
while ($row = mysql_fetch_array($p->result)) {
    if ($i == 0){
            echo $row{'detail'};
            echo '<br>Ngày đăng tin: '.$row{'fulldate'};
            echo '<br>'.$row{'price'};
    } else {
            echo "<br>".$row{'detail'}.' - '.$row{'fulldate'};
    }
    ++ $i;
}  
skip1:

?>