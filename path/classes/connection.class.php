<?php

class Connection {

		public static $conn = null;
		public static $Servername = 'localhost';
		public static $Username = 'Teekkee';
		public static $Password = 'rowpower';

	//Creating connection
	public static function mysql_connect( $Username, $Password ){

	$conn = "mysql:host=$Servername;dbname=test";
		try {

			self::$conn = new PDO($conn, self::$Username, self::$Password);
			self::$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$conn -> exec("SET CHARACTER SET utf8");

		}catch( PDOException $e ) {

			echo "Error : ".  $e -> getMessage();

		}
	}
/*	public static function sqlite_connection() {
		if(!empty(self::$defaultPath)) {
			$dsn = self::$proto. ":" . self::$defaultPath. self::$defaultPathDB;
		}else{
			$dsn = self::$proto. ":". self::$defaultPathDB;
		}
	}
*/
	//Destroying connection
	public static function disconnect( $conn) {
		self::$conn = null;
	}
}

?>
