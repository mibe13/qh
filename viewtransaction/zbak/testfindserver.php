<?php

		if ( file_exists('server1.txt') ) {		 
			echo "tim thay";
		} else {
			echo "ko tim thay";
		}
		
		$content = file_get_contents('server.txt');
		$pat = '/(?<=\$servername=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$servername = $match[0];
		}

		$pat = '/(?<=\$username=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$username = $match[0];
		}	

		$pat = '/(?<=\$password=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$password = $match[0];
		}			

		$pat = '/(?<=\$database=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$database = $match[0];
		}	
		echo "<br>".$servername.$username.$password.$database;

?>