<?php
//lay du lieu cordinate dang long-lat
require ('pointInPolygon.php');

function districtCords($districtname = 'DongDa'){

	$content = file_get_contents("District2.KML");
	//$districtname = 'Hoang Mai';
	///<name>HoangMai<\/name>(?:(?!<coordinates>).)*(?:(?!<\/coordinates>).)*/s
	///<name>HoangMai<\/name>(?:(?!<coordinates>).)*(?:(?!,0\s*<\/coordinates>).)*/s
	$pat = '/<name>'.$districtname.'<\/name>(?:(?!<coordinates>).)*(?:(?!,0\s*<\/coordinates>).)*/s';
	if (preg_match($pat, $content, $result)){
		$data =$result[0];		
	} else {
		$data = '';
	}
	//edit data
	$data = str_replace(","," ",$data);
	$data = str_replace(" 0 ","||",$data);
	//split data to array
	$polygon = explode("||", $data);
	
	return $polygon;
}

function chekpoint($point){
 	$borderdistrict = array("DongDa",
							"HoanKiem",
							"BaDinh",
							"HaiBaTrung",
							"ThanhXuan",
							"CauGiay",
							"HaDong",
							"TuLiem",
							"HoangMai",
							"LongBien");

	$pointLocation = new pointLocation();
	$pointLocation->typeofpoint = 'longlat'; //kieu du lieu nhap vao
	
	foreach($borderdistrict as $val) {
		$polygon = districtCords($val);
		$result = $pointLocation->pointInPolygon($point, $polygon);
		if ($result = 'inside' || $result = 'boundary' ){
			return $val;
			break;
		}	
	}
	return 'no district';
}

?>