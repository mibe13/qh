<?php

class connectMySQL {
	
	public $servername = "localhost";
	public $username = "root";
	public $password = "";
	public $database = "transaction"; //'transaction';
	public $table = "giaodich";
	private $dbhandle;
	public $result; //from sql query
	//public $content = '';
	
	//do this fisrt
	function __construct()	{
		$this->conn();
		mysql_query('SET NAMES utf8');
		//close the connection
		//mysql_close($this->dbhandle); 		
	}
	
	public function conn(){
		if ( file_exists("server.txt") ) {		 
			$this->getconstring();
		}
		
		// Create connection	
 		$this->dbhandle = mysql_connect($this->servername, $this->username, $this->password);
		if (!$this->dbhandle) {
			die('Could not connect: ' . mysql_error());
		}
		//echo 'Connected successfully';
	}
	
	//get parameter for string connection
	public function getconstring(){

		$content = file_get_contents('server.txt');
		
		$pat = '/(?<=\$servername=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$this->servername = $match[0];
		}

		$pat = '/(?<=\$username=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$this->username = $match[0];
		}	

		$pat = '/(?<=\$password=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$this->password = $match[0];
		}			

		$pat = '/(?<=\$database=[\"\'])[^\"\']+/mi';
		if (preg_match($pat, $content, $match)){
			$this->database = $match[0];
		}	
		$content = null;
	}
	
	//get data from database acording boundRectang
	public function sqlquery($strQuery){
	
		//select a database to work with
		$selected = mysql_select_db($this->database,$this->dbhandle) 
		or die("Could not select examples");
		
		//execute the SQL query and return records
		if($strQuery){
                        mysql_query('SET NAMES utf8');
			$this->result = mysql_query($strQuery);
		}
	}
	
}

?>