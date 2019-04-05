<?php
$path = './districtborder/kml/onlydistrictborder/';
$content = file_get_contents($path."BaDinh.KML",true); //District2.KML
//$data = 'none';
//$pat = '/<name>'.'BaDinh'.'<\/name>(?:(?!<coordinates>).)*(?:(?!,0\s*<\/coordinates>).)*/s';
$pat = '/(?<=<coordinates>)[\s\S]*(?=0\s*<\/coordinates>)/s';
if (preg_match($pat , $content , $matches)){	
	$data = $matches[0];			
} else {
	$data = '';
}

//edit data
$data = str_replace(","," ",$data);
$data = str_replace(" 0 ","||",$data);
//split data to array
$polygon = explode("||", $data);    

foreach($polygon as $key => $point) {
    echo "point " . ($key+1) . " : " . $point . "<br>";
}
//echo $content;
?>