<?php

$outdata = 'path=hanoi\2030to2050\gt10k\;zmax=19;zmin=11;cenlat=21.043288;cenlng=105.820312;';
$code = '';

if (isset($_GET["code"])){
	$code = $_GET["code"];
}

if ($code){
	//Optional. Set this parameter to '1' if you want to search for the file in the include_path (in php.ini) as well. http://www.w3schools.com/php/func_filesystem_file_get_contents.asp
	$getdata = file_get_contents("map.txt",true);

	$pat = '/(?<=<'.$code.'>)[^<>]+/m';
	if (preg_match($pat , $getdata , $matches)){
		$outdata =$matches[0];
		echo $outdata;
	} else {
		echo $outdata;
	}
} else {
	echo $outdata;
}

?>