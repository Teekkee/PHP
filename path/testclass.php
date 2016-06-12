<?php

	include_once 'classes/connection.class.php';


	// Connection::$dbh = null ;
	// $mycon = new Connection();
	Connection::mysql_connect();
	if (Connection::$conn !== null) {
		echo " SUCCESS ";
	}
	else
		echo " HELL NO ";

	var_dump(Connection::$conn);
	Connection::disconnect();
	var_dump(Connection::$conn);
?>
